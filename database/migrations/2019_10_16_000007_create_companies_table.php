<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('shortcode');

            $table->string('name');

            $table->string('street');

            $table->string('zipcode')->length(6);

            $table->string('location');

            $table->integer('phonenumber')->unique();

            $table->integer('distance');

            $table->string('email', 100)->unique();

            $table->unsignedInteger('fk_contract')->unsigned()->nullable();
            $table->foreign('fk_contract')->references('id')->on('contracts');

            $table->timestamps();

            $table->softDeletes();
        });
    }
     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }

}
