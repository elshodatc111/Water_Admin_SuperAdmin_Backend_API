<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(){
        return view('superadmin.home');
    }
    public function users(){
        $User = User::where('rol','User')->orderby('id','desc')->get();
        return view('superadmin.users',compact('User'));
    }
    public function admin(){
        return 'admin';
    }
    public function profile(){
        return 'profile';
    }
}
