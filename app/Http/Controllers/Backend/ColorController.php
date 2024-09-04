<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $title = 'Quản lý biến thể';
       $subtitle = 'Danh sách màu sắc';
       $colors = Color::query()->latest('id')->get();

       return view('backend.color.index', compact([
           'title', 'subtitle', 'colors'
       ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý biến thể';
        $subtitle = 'Thêm mới màu sắc';

        return view('backend.color.create', compact([
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
            'code' => 'required',
            'status' => 'required|in:1,0',
        ]);

        try {
            Color::create($request->all());

            \Log::info('Color created sucessfully', [
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status
            ]);

            return redirect()->route('admin.colors.index')->with('success', 'Thêm mới thành công');
        }catch (\Exception $e) {
            \Log::error('Error color:', [
                'error_exception' => $e->getMessage(),
                'request_data'=> $request->all(),
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $color = Color::query()->findOrFail($id);
        $title = 'Quản lý biến thể';
        $subtitle = 'Cập nhật màu sắc: ' . $color->name;

        return view('backend.color.edit', compact([
            'title', 'subtitle','color'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Color::query()->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'status' => 'required|in:1,0',
        ]);

        try {
            $color->update($request->all());

            \Log::info('Color update sucessfully', [
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        }catch (\Exception $e) {
            \Log::error('Error color:', [
                'error_exception' => $e->getMessage(),
                'request_data'=> $request->all(),
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
