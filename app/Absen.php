<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    use SoftDeletes;
    protected $table= "tb_absen";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];
}
