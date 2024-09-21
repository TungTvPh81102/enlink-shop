<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showListBlog()
    {
        $title = 'Bài viết';

        $blogCategories = BlogCategories::query()
            ->where('status', 1)
            ->latest('id')
            ->get();

        $posts = Post::query()
            ->with([
                'blogCategories', 'tags'
            ])
            ->where('status', 'published')
            ->latest('id')
            ->paginate('5');

        $recentPosts = Post::query()
            ->with('blogCategories')
            ->select([
                'slug', 'title', 'photo', 'blog_categories_id'
            ])
            ->whereNotIn('id', $posts->pluck('id')->toArray())
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(4)
            ->get();

        $tags = Tag::query()->latest('id')->get();

        return view('blog.index', compact([
            'title', 'blogCategories', 'posts', 'recentPosts', 'tags'
        ]));
    }

    public function showDetailBlog(string $slug)
    {
        $blogCategories = BlogCategories::query()
            ->where('status', 1)
            ->latest('id')
            ->get();

        $post = Post::query()
            ->with([
                'tags'
            ])
            ->where('slug', $slug)
            ->first();

        $title = 'Chi tiết bài viết: ' . $post->title;

        $relatedPosts = Post::query()
            ->with('blogCategories')
            ->select([
                'slug', 'title', 'photo', 'blog_categories_id'
            ])
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->limit(3)
            ->get();


        return view('blog.detail', compact([
            'title',
            'post',
            'relatedPosts',
            'blogCategories',
        ]));
    }
}
