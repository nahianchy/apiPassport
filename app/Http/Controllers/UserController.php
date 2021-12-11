<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;


class UserController extends Controller
{
    public function registration(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|email',
            'password' =>'required',
            'c_password' => 'required|same:password',
        ]);

        if($Validation->fails()){
            return response()->json($Validation->errors(), 202);
        }

        $allData = $request->all();
        $allData['password']= bcrypt($allData['password']);

        $user = User::create($allData);

        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken;
        $resArr['name'] = $user->name;

        return response()->json($resArr, 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt([
            'email' =>$request->email,
            'password'=>$request->password
        ]))
        {
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            $resArr['name'] = $user->name;
            return response()->json($resArr, 200);
        }else{
            return response()->json(['error'=>'unauthorized access'],203);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['msg'=>'you  have successfully logout!'];
        return response($response,202);
    }
}
