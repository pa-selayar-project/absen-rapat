<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pangkat extends Model
{
    use SoftDeletes;
    protected $table= "tb_pangkat";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];
}
