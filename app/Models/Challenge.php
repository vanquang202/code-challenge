<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeTest;
use App\Models\HasCod;
use App\Casts\RankPoint;

class Challenge extends Model
{
    use HasFactory;

    protected $table = "challenges";
    protected $guarded = [];
    protected $casts = [
        "rank_point" => RankPoint::class,
    ];
    public $timestamps = false;
    
    public function type_test()
    {
        return $this -> hasMany(TypeTest::class,'challenge_id');
    }
    public function has_cod()
    {
        return $this -> hasMany(HasCod::class,'challenge_id');
    }

    public function result()
    {
        return $this->hasMany(Result::class , "challenge_id");
    }
}
