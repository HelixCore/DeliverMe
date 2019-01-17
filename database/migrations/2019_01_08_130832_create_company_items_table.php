<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->float('price');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('company_items');
    }
}
