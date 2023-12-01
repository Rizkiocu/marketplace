<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function registerUser(Request $request) {
        $datauser = new User();
        //validasi
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8',
        ];

        //jika validasi gagal
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'Validation process failed',
                'data'=> $validator->errors()
            ], 400);
        }

        //jika validasi berhasil
        $datauser->name = $request->name;
        $datauser->email = $request->email;
        $datauser->password = Hash::make($request->password);
        $datauser->role = $request->role ?? 'pembeli'; // Default role 'pembeli'
        $datauser->save();

        return response()->json([
            'status' => true,
            'message' => 'successfully Register',
        ],201);
    }

    public function loginUser(Request $request){
        //validasi
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
        ];

        //untuk validasi gagal
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'login process failed',
                'data'=> $validator->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['email','password']))) {
            return response()->json([
                'status'=> false,
                'message'=>'The email and password entered are incorrect'
            ], 401);
        }

        $datauser = User::where('email', $request->email)->first();

        // Periksa peran pengguna
        if ($datauser->role != 'seller' && $datauser->role != 'buyer') {
        return response()->json([
            'status' => false,
            'message' => 'Invalid user role'
        ], 401);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Login Successful',
            'token'=>$datauser->createToken('api-product')->plainTextToken
        ]);

        
    }

    public function logoutUser(Request $request) {
        $request->User()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'Successfully Logout'
        ],200);
    }
}
