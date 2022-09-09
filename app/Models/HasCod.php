<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasCod extends Model
{
    use HasFactory;
    protected $table = "has_cod";
    protected $guarded = [];
    public $timestamps = false;
    protected $with = ["code_language"];

    public function code_language()
    {
        return $this -> belongsTo(CodeLanguage::class,"type_id");
    }
}
