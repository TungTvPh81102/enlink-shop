<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    const PATH_UPLOAD = 'brands';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý thương hiệu';
        $subtitle = 'Danh sách';
        $brands = Brand::query()->latest('id')->get();
        $trash = Brand::query()->onlyTrashed()->get();
        return view('backend.brand.index', compact([
            'title',
            'subtitle',
            'brands',
            'trash'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý thương hệu';
        $subtitle = 'Thêm mới';
        return view('backend.brand.create', compact([
            'title',
            'subtitle',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:1,0',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] =  $request->file('image')->store(self::PATH_UPLOAD);
            }

            if (!empty($data['name'])) {
                $data['slug'] = Str::slug($data['name'], '-');
            }

            Brand::create($data);

            return redirect()->route('admin.brands.index')
                ->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {

            \Log::error('Error creating brand', [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::query()->findOrFail($id);
        $title = 'Quản lý thương hệu';
        $subtitle = 'Cập nhật thương hiệu: ' . $brand->name;

        return view('backend.brand.edit', compact([
            'title',
            'subtitle',
            'brand'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:1,0',
        ]);

        try {
            $data = $request->except('image');
            if ($request->hasFile('image')) {
                $data['image'] =  $request->file('image')->store(self::PATH_UPLOAD);
                if ($brand->image && Storage::exists($brand->image)) {
                    Storage::delete($brand->image);
                }
            } else {
                $data['image'] = $brand->image;
            }

            $data['slug'] = !empty($data['name']) ? Str::slug($data['name'], '-') : $brand->slug;

            $brand->update($data);

            return redirect()->back()
                ->withErrors(['success' => 'Cập nhật dữ liệu thành công']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::query()->findOrFail($id);

        try {
            DB::transaction(function () use ($brand) {
                $brand->status = 0;
                $brand->save();
                $brand->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá dữ liệu thành công'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ]);
        }
    }

    public function trash()
    {
        $title = 'Quản lý thương hệu';
        $subtitle = 'Thùng rác';
        $brands = Brand::query()->onlyTrashed()->latest('id')->get();
        return view('backend.brand.trash', compact([
            'title',
            'subtitle',
            'brands'
        ]));
    }

    public function restore(string $id)
    {
        try {
            $brand = Brand::query()->withTrashed()->findOrFail($id);

            if ($brand->trashed()) {
                $brand->restore();
                return redirect()->route('admin.brands.index')
                    ->with('success', 'Khôi phục dữ liệu thành công');
            }
        } catch (Exception $e) {
            return redirect()->route('admin.brands.index')
                ->with('success', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }
}
