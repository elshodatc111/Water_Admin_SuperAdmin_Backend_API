<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Currer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.home');
    }
    public function currer(){
        $Currer = Currer::where('company_id',auth()->user()->company_id)->get();
        $Kurrers = array();
        foreach ($Currer as $key => $value) {
            $User = User::find($value->user_id);
            $Kurrers[$key]['id'] = $User->id;
            $Kurrers[$key]['name'] = $User->name;
            $Kurrers[$key]['phone'] = $User->phone;
            $Kurrers[$key]['reyting'] = $value->reyting;
            $Kurrers[$key]['reyting_count'] = $value->reyting_count;
            $Kurrers[$key]['status'] = $User->status;
        }
        return view('admin.currer.currer',compact('Kurrers'));
    }
    public function currer_create(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required','unique:users',
            'addres' => 'required',
            'email' => 'required','unique:users',
        ]);
        $User = User::create([
            'company_id' => auth()->user()->company_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'rol' => 'Currer',
            'addres' => $request->addres,
            'status' => 'true',
            'email' => $request->email,
            'password' => Hash::make(12345678),
        ]);
        Currer::create([
            'user_id' =>$User->id,
            'company_id' => auth()->user()->company_id,
            'reyting' =>'5',
            'reyting_count' =>0,
        ]);
        return back()->with('success', 'Yangi currer qo\'shildi.');
    }

}
