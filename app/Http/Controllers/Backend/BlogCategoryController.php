<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class BlogCategoryController extends Controller
{
    const PATH_UPLOAD = 'blogs';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý danh mục bài viết';
        $subtitle = 'Danh sách';

        $blogs = BlogCategories::query()->latest('id')->get();

        return view('backend.blog-category.index', compact([
            'title',
            'subtitle',
            'blogs'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý danh mục bài viết';
        $subtitle = 'Thêm mới';

        return view('backend.blog-category.create', compact([
            'title',
            'subtitle'
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

            if (!empty($data['name'])) {
                $data['slug'] = \Illuminate\Support\Str::slug($data['name'], '-');
            }

            BlogCategories::query()->create($data);

            return redirect()->route('admin.blog-categories.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request-data' => $request->all(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = BlogCategories::query()->findOrFail($id);

        $title = 'Quản lý danh mục bài viết';
        $subtitle = 'Cập nhật danh mục bài viết: ' . $blog->name;

        return view('backend.blog-category.edit', compact([
            'title',
            'subtitle',
            'blog'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = BlogCategories::query()->findOrFail($id);

        $this->validationRequest($request);

        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                if (!empty($blog->image) && Storage::exists($blog->image)) {
                    Storage::delete($blog->image);
                }
                $data['image'] = $request->file('image')->store(self::PATH_UPLOAD);
            }

            $data['slug'] = !empty($data['name']) ? \Illuminate\Support\Str::slug($data['name'], '-') : $blog->slug;

            $blog->update($data);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request-data' => $request->all(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = BlogCategories::query()->findOrFail($id);

        try {
            $blog->delete();

            if (!empty($blog->image) && Storage::exists($blog->image)) {
                Storage::delete($blog->image);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá dữ liệu thành công',
            ]);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function validationRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required',
        ]);
    }
}
