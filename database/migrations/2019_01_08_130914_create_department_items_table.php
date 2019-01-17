<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dep_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('department_items');
    }
}
