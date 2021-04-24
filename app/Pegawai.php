<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;
    protected $table= "tb_pegawai";

    protected $guarded= ['id','created_at','updated_at','deleted_at'];

    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat','id_pangkat');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan','id_jabatan');
    }
}
