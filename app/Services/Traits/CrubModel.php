<?php
namespace App\Services\Traits;

trait CrubModel
{
    private function manipulationCode($flagHasStore = true, $data ,$id= null)
    {
        try {
            if($flagHasStore)
            {
                $data = $this->dataModel::create($data);
            }else{
                $data = $this->dataModel::find($id)->update($data);
            }

            return response()->json(
                [
                    "status" => true,
                    "message" => "Thành công ",
                    "data" => $data
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
}
