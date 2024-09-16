<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    const PATH_UPLOAD = 'banners';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý banner';
        $subtitle = 'Danh sách';
        $banners = Banner::query()->latest('id')->get();

        return view('backend.banner.index', compact([
            'title', 'subtitle', 'banners'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý banner';
        $subtitle = 'Thêm mới';

        return view('backend.banner.create', compact([
            'title', 'subtitle'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validationRequest($request);

        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store(self::PATH_UPLOAD);
            }

            Banner::create($data);
            return redirect()->route('admin.banners.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Quản lý banner';
        $subtitle = 'Thêm mới';
        $banner = Banner::query()->findOrFail($id);

        return view('backend.banner.edit', compact([
            'title', 'subtitle',
            'banner'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::query()->findOrFail($id);

        $this->validationRequest($request);

        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                if (!empty($banner->image) && Storage::exists($banner->image)) {
                    Storage::delete($banner->image);
                }
                $data['image'] = $request->file('image')->store(self::PATH_UPLOAD);
            }

            $banner->update($data);
            return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công');
        } catch (\Exception $e) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    protected function validationRequest($request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'required|max:255',
            'btn_title' => 'required|max:255',
            'type' => 'required|in:slider,incentive,small',
            'status' => 'required|in:0,1',
        ]);
    }

}
