<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('fk_company')->unsigned()->nullable();
            $table->foreign('fk_company')->references('id')->on('companies')->onDelete('cascade');

            $table->integer('rns')->nullable();

            $table->unsignedInteger('fk_tasktype')->unsigned()->nullable();
            $table->foreign('fk_tasktype')->references('id')->on('task_type')->onDelete('cascade');

            $table->string('paid')->nullable();

            $table->char('order')->nullable();

            $table->unsignedInteger('fk_user')->unsigned()->nullable();
            $table->foreign('fk_user')->references('id')->on('users')->onDelete('cascade');

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->time("start")->nullable();

            $table->time("end")->nullable();

            $table->time("time")->nullable();

            $table->unsignedInteger('fk_typetask')->nullable();
            $table->foreign('fk_typetask')->references('id')->on('type_task')->onDelete('cascade');

            $table->text('description')->nullable();

            $table->text('comments')->nullable();

            $table->integer('value')->nullable();

            $table->bigInteger('location')->unsigned()->nullable();

            $table->unsignedInteger('fk_contract')->unsigned()->nullable();
            $table->foreign('fk_contract')->references('id')->on('contracts')->onDelete('cascade');

            $table->unsignedInteger('fk_car')->unsigned()->nullable();
            $table->time('start_car')->nullable();
            $table->time('end_car')->nullable();

            $table->text('description_goods')->nullable();
            $table->integer('fk_rep_eq')->nullable();
            $table->string('description_eq', 255)->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
