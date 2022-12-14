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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->nullable();
            $table->enum('status',['cancel','reject','unpaid','validation','payment successful','success'])->nullable();
            $table->string('total')->nullable();
            $table->json('qty')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->json('data')->nullable();
            // $table->string("nama_pengirim")->nullable();
            // $table->string("no_rek")->nullable();
            // $table->string("bukti_image")->nullable();
            // $table->string("nama_bank")->nullable();

            // $table->unsignedBigInteger('detail_id')->nullable();
            // $table->foreign('detail_id')->references('id')->on('detail_transactions')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
