<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý biến thể';
        $subtitle = 'Danh sách kích cỡ';
        $sizes = Size::query()->latest('id')->get();

        return view('backend.size.index', compact([
            'title', 'subtitle', 'sizes'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý biến thể';
        $subtitle = 'Thêm mới kích cỡ';

        return view('backend.size.create', compact([
            'title', 'subtitle'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0'
        ]);

        try {
            $data = $request->all();
            Size::create($data);

            \Log::info('Size created sucessfully', [
                'name' => $data['name'],
                'status' => $data['status']
            ]);

            return redirect()->route('admin.sizes.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            \Log::error('Error creating size', [
                'exception_message' => $e->getMessage(),
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
        $size = Size::query()->findOrFail($id);

        $title = 'Quản lý biến thể';
        $subtitle = 'Cập nhật kích cỡ: ' . $size->name;

        return view('backend.size.edit', compact([
            'title', 'subtitle', 'size'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $size = Size::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|unique:sizes,name,' . $size->id,
            'status' => 'required|in:1,0'
        ]);

        try {
            $data = $request->all();
            $size->update($data);

            \Log::info('Size update sucessfully', [
                'name' => $data['name'],
                'status' => $data['status']
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            \Log::error('Error update size', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
