<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_title')->nullable();
            $table->unsignedInteger('fk_company')->unsigned()->nullable();
            $table->unsignedInteger('fk_contract')->unsigned()->nullable();
            $table->unsignedInteger('fk_user')->unsigned()->nullable();
            $table->boolean('completed')->default(false);
            $table->date('execution_date')->nullable();
            $table->unsignedInteger('execution_user')->unsigned()->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
