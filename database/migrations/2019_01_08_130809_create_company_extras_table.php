<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('extra_id')->unsigned();
            $table->float('price')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
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
        Schema::dropIfExists('company_extras');
    }
}
