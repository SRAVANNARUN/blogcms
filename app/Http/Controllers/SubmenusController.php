<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mainmenu;
use App\Submenu;
class SubmenusController extends Controller
{

    public function __construct(){
        return $this->middleware('mainmenu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin\submenus\index')
        ->with('mainmenus',Mainmenu::all())
        ->with('submenus',Submenu::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'submenu'=>'required|unique:submenus'
        ]);

        Submenu::create([
            'mainmenu_id'=>$request->mainmenu_id,
            'submenu'=>$request->submenu
        ]);
        
        $request->session()->flash('success', 'Submenu added successfully.');

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
    public function update(Request $request, Submenu $submenu)
    {
        // dd($request->all());
        $this->validate($request, [
            // 'mainmenu_id'=>'required',
            'submenu'=>'required'
        ]);
        $submenu->mainmenu_id=$request->mainmenu_id;
        $submenu->submenu=$request->submenu;
        $submenu->save();
        $request->session()->flash('success', 'Submenu updated successfully.');
        return redirect(route('submenus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Submenu $submenu)
    {
        $submenu->delete();
        $request->session()->flash('success', 'Submenu deleted successfully.');
        return redirect(route('submenus.index'));
    }
}
