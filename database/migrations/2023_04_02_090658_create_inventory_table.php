<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('processor')->nullable();
            $table->integer('ram')->nullable();
            $table->string('hard_drive')->nullable();
            $table->string('hard_drive_capacity')->nullable();
            $table->string('hard_drive_second')->nullable();
            $table->string('hard_drive_capacity_second')->nullable();
            $table->unsignedInteger('fk_company')->unsigned()->nullable();
            $table->unsignedInteger('eq_type')->unsigned()->nullable();
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
        Schema::dropIfExists('inventory');
    }
}
