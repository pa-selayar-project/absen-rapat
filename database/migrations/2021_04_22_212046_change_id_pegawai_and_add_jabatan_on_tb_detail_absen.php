<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdPegawaiAndAddJabatanOnTbDetailAbsen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_detail_absen', function (Blueprint $table) {
            $table->string('id_pegawai')->change();
            $table->renameColumn('id_pegawai','nama_peserta');
            $table->string('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_detail_absen', function (Blueprint $table) {
            //
        });
    }
}
