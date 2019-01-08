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
            $table->increments('exit_id');
            $table->integer('coex_id')->unsigned();
            $table->integer('coit_id')->unsigned();
            $table->foreign('coex_id')->references('coex_id')->on('company_extras')->onDelete('cascade');
            $table->foreign('coit_id')->references('coit_id')->on('company_items')->onDelete('cascade');
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
