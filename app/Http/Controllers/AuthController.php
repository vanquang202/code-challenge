<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function callback()
    {
        return true;
    }

    private function getToken($user)
    {
        return $user->createToken('authToken')->plainTextToken;
    }

    private function loginApi($drive,$code)
    {
        try {
            $token = (Socialite::driver($drive))->stateless()->getAccessTokenResponse($code);
            $user = Socialite::driver($drive)->userFromToken($token['access_token']);
            $userFindLogin = User::whereEmail($user->email)->first();
            if ($userFindLogin) {
                 $userFindLogin->update(
                    [
                        'avatar' => $user->avatar,
                    ]
                );
                $userFindLogin->tokens()->delete();
                return [
                    "status" => true,
                    "token" => $this->getToken($userFindLogin),
                    "user" => $userFindLogin
                ];
            } else {
                $userCreateLogin = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                ]);
                return [
                    "status" => true,
                    "token" => $this->getToken($userCreateLogin),
                    "user" => $userCreateLogin
                ];
            }
        } catch (\Throwable $th) {
            return [
                "status" => false,
                "message" => "Không thể đăng nhập !"
            ];
        }
    }

    public function login()
    {
        $data = $this->loginApi(request()->driver,request()->code);
        return response()->json($data);
    }

    public function logout()
    {
        $user = User::whereEmail(request()->email)->first();
        $user->tokens()->delete();
        return true;
    }
}
