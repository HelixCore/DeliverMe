<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListextrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listextras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->integer('exit_id')->unsigned();
            $table->foreign('exit_id')->references('id')->on('extra_items')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
        Schema::dropIfExists('listextras');
    }
}
