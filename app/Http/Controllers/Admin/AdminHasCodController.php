<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeTest;
use App\Models\Challenge;
use App\Models\HasCod;
use App\Services\Traits\CrubModel;

class AdminHasCodController extends Controller
{
    use CrubModel;
    public $dataModel;

    public function __construct(HasCod $hasCod )
    {

        $this->dataModel = $hasCod;
    }

    public function store()
    {
        return $this->manipulationCode(true , request()->only(
            [
                'qs_code' ,
                'run_qs_code' ,
                'challenge_id' ,
                'type_id'
            ]
        ));
    }



    public function update($id)
    {
        return $this->manipulationCode(false , request()->all() , $id);
    }
}
