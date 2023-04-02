<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('mark');
            $table->string('model');
            $table->string('serial_number')->nullable();
            $table->string('processor');
            $table->integer('ram')->nullable();
            $table->string('hard_drive');
            $table->string('hard_drive_capacity');
            $table->string('hard_drive_second')->nullable();
            $table->string('hard_drive_capacity_second')->nullable();
            $table->unsignedInteger('fk_company')->unsigned()->nullable();
            $table->unsignedInteger('eq_type')->unsigned();
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
        Schema::dropIfExists('computers');
    }
}
