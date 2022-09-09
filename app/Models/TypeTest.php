<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTest extends Model
{
    use HasFactory;
    protected $table = "type_code";
    protected $guarded = [];
    public $timestamps = false;
}
