<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use SoftDeletes;
    protected $table= "tb_detail_absen";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','id_pegawai');
    }
}
