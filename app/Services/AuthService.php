<?php

namespace App\Services;

use Error;
use App\Models\User;
use App\Models\Statis;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function checkLogin($username, $password)
    {
        try {
            if(empty($username)){
                return Statis::badRequest('username', 'You must field pin field');
            }
            if(empty($password)){
                return Statis::badRequest('password', 'You must field password field');
            }

            $credential = [
                'username' => $username,
                'password' => $password,
            ];

            $token = auth()->attempt($credential);
            // return $token;
            if(!$token){
                return Statis::Unauthorized();
            }else{
                $user = User::whereUsername($username)->first();
                $data = [
                    'token' => $token,
                    'username' => $username,
                    'email' => $user->email,
                ];
                
                return Statis::Ok($data, 'Login Success');
            }
        } catch (Error $e) {
            Statis::internalServerError();
        }
    }
    public function getToken($username, $password)
    {
        try {
            if(empty($username)){
                return Statis::badRequest('username', 'You must field pin field');
            }
            if(empty($password)){
                return Statis::badRequest('password', 'You must field password field');
            }

            $user = User::where('username', $username)->first();

            if(!$user || !Hash::check($password, $user->password)){
                return response()->json([
                    'status' => 'Error',
                    'message' => 'These credential do not match our records',
                ]);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;
            // return $token;
            if(!$token){
                return Statis::Unauthorized();
            }else{
                $user = User::whereUsername($username)->first();
                $data = [
                    'token' => $token,
                    'username' => $username,
                    'email' => $user->email,
                    // 'expires_in' => auth()->factory()->getTTL() * 60,
                ];
                
                return Statis::Ok($data, 'Login Success');
            }
        } catch (Error $e) {
            Statis::internalServerError();
        }
    }
}
?>