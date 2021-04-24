<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Honorer extends Model
{
    use SoftDeletes;
    protected $table= "tb_honorer";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan','id_jabatan');
    }
}
