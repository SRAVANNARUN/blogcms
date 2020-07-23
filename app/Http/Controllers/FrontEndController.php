<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mainmenu;
use App\Submenu;
use App\Post;
class FrontEndController extends Controller
{
    public function index(){
        return view('index')->with('mainmenus',Mainmenu::all());
    }
    public function showSubmenuItem($id){
        $posts=Submenu::find($id)->posts()->paginate(24);
        return view('frontend\submenu_item')->with('mainmenus',Mainmenu::all())
                                            ->with('posts',$posts);
    }
    public function showProductDetail($slug){
         
         $post=Post::where('slug',$slug)->first();
        //  dd($post);
        return view('frontend\single_post')->with('mainmenus',Mainmenu::all())
                                            ->with('post',$post);
    }
}
