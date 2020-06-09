<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct(){
        return $this->middleware('category');
    }
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
        return view('admin.posts.create')->with('categories',Category::all())->with('tags',Tag::all());
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
        
        $image=$request->image->store('posts');

        $post=Post::create([
            'title'=>$request->title,
            'image'=>$image,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'slug'=>Str::slug($request->title)
        ]);


        $existingTags=Tag::all()->pluck('name')->toArray();
        $attchableTag=[];
        if($request->tags){
            foreach ($request->tags as $tag) {
                if(! ( in_array($tag, $existingTags) ) ) {
                    $newTag = Tag::create([
                        'name'=>$tag
                    ]);
                }
            }
            foreach($request->tags as $tag) {
                $attchableTag[] = Tag::where('name', $tag)->pluck('id')->first();
            }
            
        }
        $post->tags()->sync($attchableTag);
        $request->session()->flash('success', 'Post created successfully.');
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
    public function edit(Post $post)
    {
        return view('admin\posts\edit')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title'=>'required|max:255',
            'content'=>'required',
            'category_id'=>'required'
        ]);
        $data =$request->all();
        if ($request->hasFile('image')){
            $image=$request->image->store('posts');
            Storage::delete($post->image);
            $data['image']=$image;
        }
        $post['category_id']=$data['category_id'];
        $post->update($data);

        $existingTags=Tag::all()->pluck('name')->toArray();
        $attchableTag=[];
        if($request->tags){
            foreach ($request->tags as $tag) {
                if(! ( in_array($tag, $existingTags) ) ) {
                    $newTag = Tag::create([
                        'name'=>$tag
                    ]);
                }
            }
            foreach($request->tags as $tag) {
                $attchableTag[] = Tag::where('name', $tag)->pluck('id')->first();
            }
            
        }
        $post->tags()->sync($attchableTag);


        

        session()->flash('success', 'Post updated successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();

        if ($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Posts deleted successfully.');
        }else{
            $post->delete();
            session()->flash('success', 'Posts moved trash successfully.');
        }
        return redirect()->back();;
    }
     /**
     * Show item in trash
     */
    public function trashed(){
        $posts=Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts',$posts);
    }
    /**
     * Move item to trash
     */
    public function trash($id){
        // dd($id);
        Post::find($id)->delete();
        return redirect()->back()->with('success', 'Post moved to trash successfully.');
    }
    public function restore($id){
        Post::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Post restored successfully.');
    }
}
