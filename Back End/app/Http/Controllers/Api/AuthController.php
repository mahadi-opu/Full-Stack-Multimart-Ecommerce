<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response([
                'msg' => "Provided Email Address or Password is Incorrect",
                'status' => 422,
            ]);
        }
        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response(
            [
                'status' => 200,
                'token' => $token,
                'user' => $user,
            ]);
    }

    public function signup(SignupRequest $request)
    {
        $data = $request->validated();
        /** @var User $user */
        $emailCheck=User::where('email',$data['email'])->first();
        if($emailCheck){
            return response([
                'status' => 422,
                'msg' => "This email already exists"
            ]);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('main')->plainTextToken;
        Auth::login($user);

        $userdata=Auth::user();



        return response(
            [
                'status' => 200,
                'token' => $token,
                'user' => $userdata,
            ]);
    }

    public function logout(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }
    public function changePassword(Request $request){

        $hasPass=  Hash::make($request->newPass);
        $checkCurrentPass=Hash::check($request->currentPass,Auth::user()->password);
        if(!$checkCurrentPass){
            $data=['status'=>400,'msg'=>"The current password is incorrect" ];
              return response()->json($data);
        }
        else{
             User::where('email',Auth::user()->email)->update(['password'=>$hasPass]);
            $data=['status'=>200,'msg'=>"Password Successfully Changed" ];
            return response()->json($data);
        }

    }
}
