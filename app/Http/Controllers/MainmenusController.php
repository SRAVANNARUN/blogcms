<?php

namespace App\Http\Controllers;
use App\Mainmenu;

use Illuminate\Http\Request;

class MainmenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin\main_menus\index')->with('mainmenus',Mainmenu::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\main_menus\create');
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
            'main_menu'=>'required|unique:mainmenus'
        ]);

        Mainmenu::create([
            'main_menu'=>$request->main_menu
        ]);
        
        $request->session()->flash('success', 'Main menu added successfully.');

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
    public function edit(Mainmenu $mainmenu)
    {
        
        return view('admin\main_menus\edit')->with('mainmenus',$mainmenu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Mainmenu $main_menu)
    {
        $this->validate($request, [
            'main_menu'=>'required|unique:mainmenus'
        ]);

        // dd($main_menu);
        $main_menu->main_menu=$request->main_menu;
        $main_menu->save();
        $request->session()->flash('success', 'Main menu updated successfully.');
        return redirect(route('main_menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Mainmenu $main_menu)
    {
        $main_menu->delete();
        return redirect(route('main_menus.index'))->with('success', 'Main menu deleted successfully.');
    }
   
}
