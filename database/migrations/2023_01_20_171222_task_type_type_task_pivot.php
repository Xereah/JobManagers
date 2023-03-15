<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskTypeTypeTaskPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_type_type_task', function (Blueprint $table) {
            $table->unsignedInteger('task_type_id');

            $table->foreign('task_type_id')->references('id')->on('task_type')->onDelete('cascade');

            $table->unsignedInteger('type_task_id');

            $table->foreign('type_task_id')->references('id')->on('type_task')->onDelete('cascade');
        });
    }

      /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_type_type_task');
    }
}
