<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->string('npwp');
            $table->string('no_telp');
            $table->string('keterangan')->default('tidak ada');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('bukti_bayar')->nullable()->default(NULL);
            $table->string('bukti_denda')->nullable()->default(NULL);
            $table->string('kontrak')->nullable()->default(NULL);
            $table->unsignedBigInteger('karyawan_id')->default(1);
            $table->unsignedBigInteger('kendaraan_pengantar_id')->default(1);
            $table->boolean('disetujui')->default(false);
            $table->boolean('disetujui_tolak')->default(false);
            $table->boolean('disetujui_sewa')->default(false);
            $table->boolean('disetujui_sewa_tolak')->default(false);
            $table->boolean('pengembalian')->default(false);
            $table->boolean('pengembalian_diterima')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->foreign('kendaraan_pengantar_id')->references('id')->on('kendaraan_pengantar')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa');
    }
};
