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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->text("alamat")->nullable();
            $table->string("provinsi")->nullable();
            $table->string("no_rumah")->nullable();
            $table->string("kota")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kelurahan")->nullable();
            $table->string("kode_pos")->nullable();
            $table->string("no_hp")->nullable();
            $table->string("no_resi")->nullable();
            $table->string("jasa_expedisi")->nullable();
            $table->string("layanan_ekspedisi")->nullable();
            $table->string("harga_layanan")->nullable();

            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
};
