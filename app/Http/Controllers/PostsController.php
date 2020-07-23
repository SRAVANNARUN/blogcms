<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Submenu;
use App\Tag;
use Illuminate\Support\Str;
use Storage;
class PostsController extends Controller
{

    public function __construct(){
        return $this->middleware('submenu')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Post::paginate(20)->lastPage());
        $posts=Post::simplePaginate(20);
        // $lastPage=$post->hasMorePages();
        // dd($lastPage);
        return view('admin.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create')->with('submenus',Submenu::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd($request->all());
        // dd($request->all());
      $this->validate($request,[
          'product_name'=>'required|unique:posts|max:50',
          'price'=> 'required|numeric',
          'image'=>'required|image|max:20480',
          'product_detail'=>'required'
      ]);
        
        $image=$request->image->store('posts');

        $post=Post::create([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'image'=>$image,
            'product_detail'=>$request->product_detail,
            'submenu_id'=>$request->submenu_id,
            'slug'=>Str::slug($request->product_name)
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
        return view('admin\posts\edit')->with('post',$post)->with('submenus',Submenu::all())->with('tags',Tag::all());
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
            'product_name'=>'required|max:255',
            'price'=> 'required|numeric',
            'product_detail'=>'required',
            'submenu_id'=>'required'
        ]);
        $data =$request->all();
        if ($request->hasFile('image')){
            $image=$request->image->store('posts');
            Storage::delete($post->image);
            $data['image']=$image;
        }
        $post['submenu_id']=$data['submenu_id'];
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
        return redirect()->back();
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
