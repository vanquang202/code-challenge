<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $table = "result";
    protected $guarded = [];
    public $timestamps = false;

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function user()
    {
        return $this-> belongsTo(User::class);
    }

    public function code_language()
    {
        return $this -> belongsTo(CodeLanguage::class,"type_id");
    }
}
