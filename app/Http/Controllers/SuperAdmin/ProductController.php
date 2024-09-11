<?php

namespace App\Http\Controllers\superadmin;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $Company = Company::get();
        return view('superadmin.product',compact('Company'));
    }
    public function create(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $imageName);
        Company::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'addres' => $request->addres,
            'logo' => $imageName,
            'discriotion' => $request->discriotion,
            'price' => $request->price,
            'work_time' => $request->work_time,
            'status' => 'true'
        ]);
        return back()->with('success', 'Yangi firma ochildi.');
    }
}
