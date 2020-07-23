<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
class SettingsController extends Controller
{
    
    public function __construct(){
        return $this->middleware('admin');
    }
    public function index(){
        return view('admin\settings\settings')->with('settings', Setting::first());;
    }
    public function update(){
        $this->validate(request(),[
            'site_name'=>'required',
            'contact_number'=>'required',
            'contact_email'=>'required',
            'contact_address'=>'required'
        ]);
        $settings=Setting::first();
        $settings->site_name=request()->site_name;
        $settings->contact_number=request()->contact_number;
        $settings->contact_email=request()->contact_email;
        $settings->contact_address=request()->contact_address;
        $settings->save();
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
