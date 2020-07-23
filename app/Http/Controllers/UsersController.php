<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{

     public function __construct(){
         return $this->middleware('admin')->except(['update']);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin\users\index')->with('users',User::all());
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\users\create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'photo'=>['required', 'max:2048']
        ]);
        $image=$request->photo->store('users');
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        
            Profile::create([
                'user_id'=>$user->id,
                'image'=>$image,
            ]);
        return redirect()->back()->with('success', 'Profile added successfully.');
        // dd($request->all());
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name=$request->name;
        $user->email=$request->email;
        $user->profile->about=$request->about;
    
        if($request->password!=null){

            // dd($request->password);
            $user->password=bcrypt($request->password);
            // $user->pawword=Hash::make($request->password);
        }
        if ($request->hasFile('image')){
            $image=$request->image->store('users');
            Storage::delete($user->profile->image);
            $user->profile->image=$image;
            $user->profile->save();
        }
        $user->save();
        return redirect()->route('home')->with('success', 'User updated successfully.');
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
