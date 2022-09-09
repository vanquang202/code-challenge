<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\CodeLanguage;
use Illuminate\Http\Request;

class AdminChallengeController extends Controller
{
    public function index()
    {
        $challenge = Challenge::with(['has_cod','type_test'])->paginate(10);
        return response()->json(
            [
                "status" => true,
                "data" => $challenge
            ]
        );
    }

    public function show($id)
    {
        try {
            $codeLanguage = CodeLanguage::all();
            return response()->json(
                [
                    "status" => true ,
                    "data" => Challenge::find($id)->load(['has_cod','type_test']),
                    "codeLanguage" => $codeLanguage
                ]
            );
        }catch (\Exception $e){
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage(),
                ],404
            );
        }
    }

    public function store(Request $r)
    {
        return $this->manipulationCode();
    }

    public function edit(Request $r,$id)
    {
        return $this->manipulationCode(false, $id);
    }

    private function manipulationCode($flagHasStore = true,$id= null)
    {
        try {
            if($flagHasStore)
            {
                // Store
                $data = Challenge::create(request()->all());
                return response()->json(
                    [
                        "status" => true,
                        "message" => "Thành công ",
                        "data" => $data
                    ]
                );
            }else{
                // Update
                $challenge = Challenge::find($id);
                $challenge -> update(request()->all());
                return response()->json(
                    [
                        "status" => true,
                        "message" => "Thành công ",
                        "data" => $challenge
                    ]
                );
            }

        }catch (\Exception $e){
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage(),
                ],404
            );
        }
    }

    public function destroy($id)
    {
        if(Challenge::find($id)->delete()) return response()->json([
            "status" => true ,
            "message" => "Thành công "
        ]);
        return response()->json([
            "status" => false ,
            "message" => "Không thành công "
        ]);
    }
}
