<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(auth()->user()->status=='false'){
            return view('home');
        }
        if(auth()->user()->rol=='Admin'){
            return redirect()->route('admin');
        }
        if(auth()->user()->rol=='SuperAdmin'){
            return redirect()->route('superadmin');
        }
        return view('home');
    }
}
