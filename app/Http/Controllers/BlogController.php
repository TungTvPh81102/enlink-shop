<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use App\Models\Post;
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
            ->with('blogCategories')
            ->where('status', 'published')
            ->latest('id')
            ->paginate('5');

        return view('blog.index', compact([
            'title', 'blogCategories', 'posts'
        ]));
    }

    public function showDetailBlog()
    {

    }
}
