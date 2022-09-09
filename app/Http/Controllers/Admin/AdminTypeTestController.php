<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeTest;
use App\Models\Challenge;
use App\Models\HasCod;
use App\Services\Traits\CrubModel;

class AdminTypeTestController extends Controller
{
    use CrubModel;

    public $dataModel;

    public function __construct(TypeTest $typeTest )
    {
        $this->dataModel = $typeTest;
    }

    public function store()
    {
        return $this->manipulationCode(true , request()->only(
            [
                'challenge_id' ,
                'input' ,
                'output' ,
                'status'
            ]
        ));
    }



    public function update($id)
    {
        return $this->manipulationCode(false , request()->all() , $id);
    }
}
