<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table= "tb_menu";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];
}
