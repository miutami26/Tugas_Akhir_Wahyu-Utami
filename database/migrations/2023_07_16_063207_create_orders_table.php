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
        Schema::create('orders', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->unsignedInteger('id_user');
           $table->unsignedBigInteger('id_produk');
           $table->integer('qty');
           $table->bigInteger('total');
           $table->enum('status', ['Unpaid', 'Paid']);
           $table->timestamps();

           $table->foreign('id_user')->references('id')->on('user');
           $table->foreign('id_produk')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
