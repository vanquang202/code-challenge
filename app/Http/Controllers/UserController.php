<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth('sanctum')->user();
        if(!$user) return response()->json([
            "status" => false ,
            "payload" => "Tài khoản không tồn tại!",
        ]);
        $result = Result::where('user_id' , $user -> id )
            ->with([
                "challenge",
                "code_language"
            ])
            ->get();

        return response()->json([
            "status" => true ,
            "user" => $user,
            "result" => $result,
        ]);
    }
}
