<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJabatanToIntTbHonorer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_honorer', function (Blueprint $table) {
            $table->integer('jabatan')->change();
            $table->renameColumn('jabatan','id_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_honorer', function (Blueprint $table) {
            //
        });
    }
}
