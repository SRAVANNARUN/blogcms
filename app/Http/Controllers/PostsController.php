<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $this->validate($request,[
          'title'=>'required|unique:posts|max:255',
          'image'=>'required|image|max:20480',
          'content'=>'required',
          'category_id'=>'required'
      ]);
        
        $image=$request->image;
        $new_image_name=time().$image->getClientOriginalName();
        $image->move('uploads/posts',$new_image_name);

        // dd($request->all());

        $post=Post::create([
            'title'=>$request->title,
            'image'=>'uploads/posts/'.$new_image_name,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'slug'=>Str::slug($request->title)
        ]);

        $request->session()->flash('success', 'New post created successfully');
        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
