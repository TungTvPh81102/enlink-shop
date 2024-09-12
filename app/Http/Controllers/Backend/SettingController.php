<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    const PATH_UPLOAD = 'settings';

    public function index()
    {
        $title = 'Quản lý cài đặt';
        $subtitle = 'Danh sách';

        $settings = Setting::query()->pluck('value', 'key')->toArray();

        return view('backend.setting.index', compact([
            'title',
            'subtitle',
            'settings',
        ]));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'string|min:10|max:11',
            'address' => 'max:255',
        ]);

        try {
            $settings = Setting::query()->pluck('value', 'key')->toArray();

            $data = $request->except('logo', 'favicon', '_token', '_method');

            if ($request->hasFile('logo')) {
                if (!empty($settings['logo']) && Storage::exists($settings['logo'])) {
                    Storage::delete($settings['logo']);
                }
                $data['logo'] = $request->file('logo')->store(self::PATH_UPLOAD);
            }

            if ($request->hasFile('favicon')) {
                if (!empty($settings['favicon']) && Storage::exists($settings['favicon'])) {
                    Storage::delete($settings['favicon']);
                }
                $data['favicon'] = $request->file('favicon')->store(self::PATH_UPLOAD);
            }

            foreach ($data as $key => $value) {
                Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
            }

            $updatedSettings = Setting::query()->pluck('value', 'key')->toArray();

            $jsonFilePath = self::PATH_UPLOAD . '/settings.json';

            if (Storage::exists($jsonFilePath)) {
                Storage::delete($jsonFilePath);
            }

            Storage::put($jsonFilePath, json_encode($updatedSettings, JSON_PRETTY_PRINT));

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'exception-code' => $e->getCode(),
            ]);

            if (!empty($data['logo']) && Storage::exists($data['logo'])) {
                Storage::delete($data['logo']);
            }

            if (!empty($data['favicon']) && Storage::exists($data['favicon'])) {
                Storage::delete($data['favicon']);
            }

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }
}
