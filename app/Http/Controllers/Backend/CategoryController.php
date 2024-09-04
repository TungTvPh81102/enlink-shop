<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý danh mục';
        $subtitle = 'Danh sách';
        $categories = Category::query()->latest('id')->get();
        return view('backend.category.index', compact([
            'title',
            'subtitle',
            'categories'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý danh mục';
        $subtitle = 'Thêm mới';
        $parentCategory = Category::where('parent_id', 0)->get();
        return view('backend.category.create', compact([
            'title',
            'subtitle',
            'parentCategory'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:1,0',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();

            if (!empty($data['name'])) {
                $data['slug'] = Str::slug($data['name'], '-');
            }

            Category::create($data);

            DB::commit();
            \Log::info('Category successfully created');
            return redirect()->route('admin.categories.index')
                ->with('success', 'Thêm mới thành công');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
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
        $category = Category::query()->findOrFail($id);
        $title = 'Quản lý danh mục';
        $subtitle = 'Cập nhật danh mục: ' . $category->name;
        $parentCategory = Category::where('parent_id', 0)->get();
        return view('backend.category.edit', compact([
            'title',
            'subtitle',
            'category',
            'parentCategory'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:1,0',
        ]);

        try {
            $data = $request->all();

            $data['slug'] = empty($data['name']) ? $category->slug : Str::slug($data['name'], '-');

            $category->update($data);
            \Log::info('Category successfully updated');
            return redirect()->back()
                ->with('success', 'Cập nhật thành công');

        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::query()->findOrFail($id);

        $parentCategory = Category::where('parent_id', $category->id)->count();
        if ($parentCategory > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ]);
        }

        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Xoá dữ liệu thành công'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        try {
            Category::whereIn('id', $ids)->update(['status' => $status]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
