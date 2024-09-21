<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    const  PATH_UPLOAD = 'posts';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý bài viết';
        $subtitle = 'Danh sách';
        $posts = Post::query()
            ->with('blogCategories')
            ->latest('id')
            ->get();

        return view('backend.post.index', compact([
            'title', 'subtitle', 'posts'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý bài viết';
        $subtitle = 'Thêm mới';

        $blogCategories = BlogCategories::query()
            ->where('status', 1)
            ->latest('id')
            ->get();

        $tags = Tag::query()->latest('id')->get();

        return view('backend.post.create', compact([
            'title', 'subtitle', 'blogCategories', 'tags'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationRequest($request);
        try {
            DB::beginTransaction();

            $data = $request->except('photo');
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store(self::PATH_UPLOAD);
            }

            if ($data['title']) {
                $data['slug'] = \Illuminate\Support\Str::slug($data['title'], '-');
            }

            $post = Post::create($data);

            if ($request->has('tags')) {
                foreach ($request->input('tags') as $item) {
                    $tags = Tag::query()->firstOrCreate([
                        'name' => $item,
                        'slug' => \Illuminate\Support\Str::slug($item, '-')
                    ]);

                    $post->tags()->attach($tags->id);
                }
            }
            DB::commit();

            return redirect()->route('admin.blog-posts.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            if (!empty($data['photo']) && Storage::exists($data['photo'])) {
                Storage::delete($data['photo']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request-data' => $request->all()
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::query()
            ->with(['tags', 'blogCategories'])
            ->findOrFail($id);

        $title = 'Quản lý bài viết';
        $subtitle = 'Câp nhật bài viết: ' . $post->title;

        $blogCategories = BlogCategories::query()
            ->where('status', 1)
            ->latest('id')
            ->get();

        $tags = Tag::query()->latest('id')->get();

        return view('backend.post.edit', compact([
            'title', 'subtitle', 'blogCategories', 'post', 'tags'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::query()->findOrFail($id);

        $this->validationRequest($request);

        try {
            $data = $request->except('photo');
            if ($request->hasFile('photo')) {
                if (!empty($post->photo) && Storage::exists($post->photo)) {
                    Storage::delete($post->photo);
                }
                $data['photo'] = $request->file('photo')->store(self::PATH_UPLOAD);
            }

            $data['slug'] = !empty($data['title']) ? \Illuminate\Support\Str::slug($data['title'], '-') : $post->slug;

            $post->update($data);

            if ($request->has('tags')) {
                // Xóa các thẻ hiện tại của post

                $post->tags()->detach();
                foreach ($request->input('tags') as $item) {
                    $tags = Tag::query()->firstOrCreate([
                        'name' => $item,
                        'slug' => \Illuminate\Support\Str::slug($item, '-')
                    ]);

                    // Gắn thẻ cho bài viết
                    $post->tags()->attach($tags->id);
                }
            }

            return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công');
        } catch (\Exception $e) {
            if (!empty($data['photo']) && Storage::exists($data['photo'])) {
                Storage::delete($data['photo']);
            }

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
                'request-data' => $request->all()
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function validationRequest(Request $request)
    {

        $request->validate([
            'blog_categories_id' => 'required',
            'title' => 'required|min:3|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required',
            'status' => 'required',
            'published_at' => 'required',
            'tags' => 'nullable|array'
        ]);
    }
}
