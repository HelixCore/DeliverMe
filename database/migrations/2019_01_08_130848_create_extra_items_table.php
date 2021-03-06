<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coit_id')->unsigned();
            $table->integer('coex_id')->unsigned();
            $table->foreign('coit_id')->references('id')->on('company_items')->onDelete('cascade');
            $table->foreign('coex_id')->references('id')->on('company_extras')->onDelete('cascade');
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
        Schema::dropIfExists('extra_items');
    }
}

