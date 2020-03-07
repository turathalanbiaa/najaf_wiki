<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function show($id)
    {
        $post = Post::where('subcategory_id', $id)->first();
        $categories = Category::All();
        return view('website.comments', compact('post', 'categories'));
    }
    public function store(Request $request,$id)
    {
        $comment= new Comment;
        $comment->text=$request->get('text');
        $comment->date=Carbon::now();
        $comment->user_name=Auth::user()->name;
        $comment->post_id=$id;
        $comment->save();
        return back();
    }
}
