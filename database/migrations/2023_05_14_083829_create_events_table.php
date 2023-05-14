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
        Schema::create('events', function (Blueprint $table) {

            $table->id();
            $table->string('title')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();

            $table->unsignedInteger('fk_company')->unsigned()->nullable();
            $table->string('fk_contract')->nullable();
            $table->unsignedInteger('fk_user')->unsigned()->nullable();
            $table->boolean('completed')->default(false);
            $table->date('execution_date')->nullable();
            $table->unsignedInteger('execution_user')->unsigned()->nullable();


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
        Schema::dropIfExists('events');
    }
};
