<?php

namespace App\Http\Controllers\Api;
use App\Models\ValidatePhone;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller{
    public function login(Request $request){
        $validateUser = Validator::make($request->all(),[
            'phone' => 'required',
        ]);
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Telefon raqam kiritilmagan',
                'errors' =>$validateUser->errors()
            ],401);
        }
        $phone = $request->phone;
        $randomNumber = rand(10000, 99999);
        $lastFourCharacters = substr($phone, -13,-7)."...".substr($phone, -4);
        return response()->json([
            'status' => true,
            'phone' => $phone,
            'code' => $randomNumber,
            'message' => 'Tasdiqlash kodi '.$lastFourCharacters.' raqamiga yuborildi. Tasdiqlash kodini kiriting'
        ],200);
    }
    public function code(Request $request){
        $validateUser = Validator::make($request->all(),[
            'phone' => 'required',
            'code' => 'required',
        ]);
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Malumotlar to\'liq yuborilmadi',
                'errors' =>$validateUser->errors()
            ],401);
        }
        $ValidatePhone = ValidatePhone::where('phone',$request->phone)->where('code',$request->code)->where('status','true')->first();
        if($ValidatePhone){
            $User = User::where('phone',$request->phone)->where('rol','User')->first();
            $ValidatePhone->status = 'false';
            $ValidatePhone->save();
            if($User){
                return response()->json([
                    'status' => 'token',
                    'message' => 'Mofaqiyatli verifikatsiyadan o\'tding\'iz',
                    'token' => $User->createToken("API TOKEN")->plainTextToken
                ],200);
            }else{
                return response()->json([
                    'status' => 'new',
                    'phone' => $request->phone,
                    'message' => 'Ismingizni kiriting',
                ],200);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Tasdiqlash kodi noto\'g\'ri',
            ],401);
        }
    }
    public function nameCreate(Request $request){
        $validateUser = Validator::make($request->all(),[
            'phone' => 'required',
            'name' => 'required',
        ]);
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Malumotlar to\'liq yuborilmadi',
                'errors' =>$validateUser->errors()
            ],401);
        }
        $User = User::create([
            'company_id' => 'NULL',
            'name' => $request->name,
            'rol' => 'User',
            'phone' => $request->phone,
            'addres' => 'NULL',
            'latitude' => 'NULL',
            'longitude' => 'NULL',
            'status' => 'NULL',
            'reyting' => '5',
            'count' => 0,
            'email' => time(),
            'password' => Hash::make('12345678'),
        ]);
        return response()->json([
            'status' => 'token',
            'message' => 'Siz mofaqiyatli ro\'yhatdan o\'tdingiz',
            'token' => $User->createToken("API TOKEN")->plainTextToken
        ],201);
    }

    
}
