<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNilaiKombinasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nilai_kombinasi', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_pengujian', 100);
            $table -> char('kd_kombinasi', 200);
            $table -> char('kd_barang_a', 200);
            $table -> char('kd_barang_b', 200);
            $table -> integer('jumlah_transaksi');
            $table -> float('support');
            $table->float('confidence')->default(0);
            $table->float('expected_confidence')->default(0)->after('confidence');
            $table->float('lift_ratio')->default(0)->after('expected_confidence');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::table('tbl_nilai_kombinasi', function (Blueprint $table) {
            $table->dropColumn('expected_confidence');
            $table->dropColumn('lift_ratio');
        });
        
        Schema::dropIfExists('tbl_nilai_kombinasi');
    }
}
