<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:محرر,مدير');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        return view('dashboard.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*  $request->validate([
            'namaSiswa' => 'required',
            'alamatSiswa' => 'required'
        ]);*/

        $post= new Post;
        $post->title=$request->get('title');
        $post->description=$request->get('description');
        $post->subcategory_id=$request->get('subcategory');
       $post->save();
        return redirect('dashboard.post')->with('success', 'تمت الأضافه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('dashboard.post.detail',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::All();
        //return response()->json($post);
        return view('dashboard.post.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post= Post::find($id);
        $post->title=$request->get('title');
        $post->description=$request->get('description');
        $post->subcategory_id=$request->get('subcategory');
        $post->save();
        return redirect('dashboard/post')->with('success', 'تمت التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
        $post->delete();
        return redirect('dashboard')->with('success','تم الحذف بنجاح');

    }
    public function getSubcategory($id)
    {
        $subcategory= Subcategory::where('category_id',$id)->get();
        return response()->json( $subcategory);

    }
}
