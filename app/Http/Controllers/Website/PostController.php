<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function home()
    {
        return view('website.home');

    }
    public function post()
    {
      $post = Post::where('subcategory_id', 1)->first();
        $categories = Category::All();
        return view('website.index', compact('post', 'categories'));
    }

    public function show($id)
    {
        $post = Post::where('subcategory_id', $id)->first();
        $categories = Category::All();
        return view('website.index', compact('post', 'categories'));

    }

    public function search(Request $request)
    {
        $post = Post::search($request['search'])->first();
        $categories = Category::All();
        return view('website.index', compact('post', 'categories'));
    }


}
