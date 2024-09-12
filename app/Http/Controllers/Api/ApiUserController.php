<?php

namespace App\Http\Controllers\Api;
use App\Models\ValidatePhone;
use App\Models\User;
use App\Models\Company;
use App\Models\Product;
use App\Models\Currer;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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
        ValidatePhone::create([
            'phone' => $phone,
            'code' => $randomNumber,
            'status' => 'true'
        ]);
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
            $ValidatePhone->delete();
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
            'status' => 'true',
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

    
    public function home(Request $request){
        //return $request;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
    
        $response = Http::withHeaders([
            'User-Agent' => 'Water-demo/1.0 (elshodatc1116@gmail.com)' 
        ])->get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json',
            'addressdetails' => 1,
        ]);
    
        $data = $response->json();
        if (isset($data['address'])) {
            $address = $data['address'];
            $addres = ([
                'kocha' => $address['road'] ?? null,
                'maxalla' => $address['village'] ?? $address['residential'] ?? $address['village'] ?? $address['town'] ?? null,
                'shaxar' => $address['city'] ?? $address['county'] ?? $address['district'] ?? null,
                'viloyat' => $address['state'] ?? null,
            ]);
            $Product = Product::where('town',$addres['shaxar'])->get();
            $Products = array();
            foreach ($Product as $key => $value) {
               $company_id = $value->company_id;
               $Company = Company::where('id',$company_id)->where('status','true')->first();
               $Products[$key]['id'] = $Company['id'];
               $Products[$key]['name'] = $Company['name'];
               $Products[$key]['logo'] = $Company['logo'];
               $Products[$key]['price'] = $Company['price'];
               $Products[$key]['work_time'] = $Company['work_time'];
               $Products[$key]['reyting'] = $Company['reyting'];
               $Products[$key]['reyting_count'] = $Company['reyting_count'];
            }
            if(count($Products)==0){
                $Product = "Xizmat ko'rsatish hududidan tashqaridasiz";
            }
            return response()->json([
                'status' => 'success',
                'addres' => $addres,
                'data' => $Products,
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Xizmat ko\'rsatish hududidi emas'
            ],401);
        }
    }
    public function buyurtma(Request $request){
        $validateUser = Validator::make($request->all(),[
            'latitude' => 'required',
            'longitude' => 'required',
            'company_id' => 'required',
            'count' => 'required',
        ]);
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Malumotlar to\'liq emas',
                'errors' =>$validateUser->errors()
            ],401);
        }
        if($request->count==0){
            return response()->json([
                'status' => 'error',
                'message' => 'Buyurtmada xatolik'
            ],401);
        }
        $latitude = $request->latitude;
        $longitude = $request->longitude;
    
        $response = Http::withHeaders([
            'User-Agent' => 'Water-demo/1.0 (elshodatc1116@gmail.com)' 
        ])->get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json',
            'addressdetails' => 1,
        ]);
        $data = $response->json();
        if (isset($data['address'])) {
            $address = $data['address'];
            $addres = ([
                'kocha' => $address['road'] ?? null,
                'maxalla' => $address['village'] ?? $address['residential'] ?? $address['village'] ?? $address['town'] ?? null,
                'shaxar' => $address['city'] ?? $address['county'] ?? $address['district'] ?? null,
                'viloyat' => $address['state'] ?? null,
            ]);
            $Company = Company::find($request->company_id);
            if($Company){
                $Order = Order::create([
                    'user_id' => auth()->user()->id,
                    'company_id' => $request->company_id,
                    'currer_id' => 'null',
                    'count' => $request->count,
                    'city' => $addres['shaxar'],
                    'town' => $addres['maxalla']." ".$addres['kocha'],
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'status' => 'Yangi',
                    'addres' => $addres['kocha'],
                ]);
                return response()->json([
                    'status' => 'success',
                    'data' => $Order,
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Buyurtmada xatolik'
                ],401);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Xizmat ko\'rsatish hududidan tashqarida'
            ],401);
        }
    }
}
