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
        Schema::create('kontrahenci_miasta', function (Blueprint $table) {
            $table->id();
            $table->string('kontrahent_miasto',40)->nullable();    
            $table->string('kontrahent_kodpocztowy', 10)->nullable();
            $table->string('kontrahent_odleglosc',100)->nullable();
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
        Schema::dropIfExists('kontrahenci_miasta');
    }
};
