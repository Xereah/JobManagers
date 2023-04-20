<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rep_equipment', function (Blueprint $table) {
            $table->id();
            $table->char('eq_number');
            $table->string('eq_name');
            $table->char('serial_number')->nullable();
            $table->date('entry_date');
            $table->string('comments')->nullable();
            $table->unsignedInteger('company_place')->unsigned()->nullable();
            $table->foreign('company_place')->references('kontrahent_id')->on('kontrahenci')->onDelete('cascade');
            $table->unsignedInteger('eq_category')->unsigned()->nullable();
            $table->boolean('is_loan')->unsigned()->nullable();
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
        Schema::dropIfExists('rep_equipment');
    }
}
