<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.home');

    }

    public function posts()
    {
       $posts =   $posts = Post::where('subcategory_id', 1)->paginate(5);
        $categories = Category::All();
        return view('website.index', compact('posts', 'categories'));
    }

    public function comments()
    {
        $posts =   $posts = Post::where('subcategory_id', 1)->paginate(5);
        $categories = Category::All();
        return view('website.comments', compact('posts', 'categories'));
    }
    public function search(Request $request)
    {
        $posts =   $posts = Post::search($request['search'])->paginate(5);
        $categories = Category::All();
        return view('website.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $posts = Post::where('subcategory_id', $id)->paginate(5);
        $categories = Category::All();
        return view('website.index', compact('posts', 'categories'));

    }
}
