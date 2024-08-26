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
        Schema::create('sewa_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sewa_id');
            $table->unsignedBigInteger('alat_berat_id');
            $table->integer('jumlah');
            $table->timestamps();
    
            $table->foreign('sewa_id')->references('id')->on('sewa')->onDelete('cascade');
            $table->foreign('alat_berat_id')->references('id')->on('alat_berat')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa_detail');
    }
};
