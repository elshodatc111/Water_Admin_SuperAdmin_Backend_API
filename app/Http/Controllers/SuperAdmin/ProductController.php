<?php

namespace App\Http\Controllers\superadmin;
use App\Models\Company;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{
    
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

    public function show($id){
        $User = User::where('company_id',$id)->where('rol','Admin')->get();
        $Company = Company::find($id);
        $Product = Product::where('company_id',$id)->get();
        return view('superadmin.product.show',compact('Company','Product','User'));
    }

    public function imageUpdate(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $imageName);
        $Company = Company::find($request->id);
        $Company->logo = $imageName;
        $Company->save();
        return back()->with('success', 'Firma rasmi yangilandi.');
    }

    public function formUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'addres' => 'required',
            'price' => 'required',
            'work_time' => 'required',
            'discriotion' => 'required',
            'id' => 'required',
        ]);
        $Company = Company::find($request->id);
        $Company->name = $request->name;
        $Company->status = $request->status;
        $Company->phone = $request->phone;
        $Company->addres = $request->addres;
        $Company->price = $request->price;
        $Company->work_time = $request->work_time;
        $Company->discriotion = $request->discriotion;
        $Company->save();
        return back()->with('success', 'Firma yangilandi.');
    }

    public function newAddres(Request $request){
        $request->validate([
            'company_id' => 'required',
            'town' => 'required',
        ]);
        $Product1 = Product::where('company_id',$request->company_id)->where('town',$request->town)->first();
        if($Product1){
            return back()->with('success', 'Siz tanlagan hudod oldin kiritilgan.');
        }
        Product::create([
            'company_id'=>$request->company_id,
            'town'=>$request->town,
        ]);
        return back()->with('success', 'Yangi hudud qo\'shildi.');
    }

    public function Delete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $Product = Product::find($request->id);
        $Product->delete();
        return back()->with('success', 'Hudud o\'chirildi.');
    }

    public function createAdmin(Request $request){
        $request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'addres' => 'required',
            'email' => 'required',
        ]);
        User::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'addres' => $request->addres,
            'email' => $request->email,
            'rol' => "Admin",
            'status' => "true",
            'password' => Hash::make(12345678),
        ]);
        return back()->with('success', 'Yangi admin qo\'shildi.');
    }

    public function deleteAdmin(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $User = User::find($request->id);
        $User->delete();
        return back()->with('success', 'Admin o\'chirildi.');
    }

}
