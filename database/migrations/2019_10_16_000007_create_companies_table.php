<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('kontrahenci', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kontrahent_kod', )->nullable();   
            $table->string('kontrahent_nazwa1',50)->nullable();
            $table->string('kontrahent_nazwa2',50)->nullable();
            $table->string('kontrahent_nazwa3',50)->nullable();    
            $table->string('kontrahent_ulica',40)->nullable();
            $table->string('kontrahent_nrdomu',10)->nullable();
            $table->string('kontrahent_nrlokalu',10)->nullable();
            $table->string('kontrahent_miasto',40)->nullable();    
            $table->string('kontrahent_kodpocztowy', 10)->nullable();
            $table->string('kontrahent_poczta',40)->nullable();
            $table->string('kontrahent_nip', 10)->unique()->nullable();       
            $table->string('kontrahent_telefon1',20)->unique()->nullable();
            $table->string('kontrahent_telefon2',20)->unique()->nullable();
            $table->string('kontrahent_odleglosc',100)->nullable();
            $table->string('kontrahent_email', 100)->nullable();
            $table->string('kontrahent_grupa',20)->nullable();
    
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
        Schema::dropIfExists('kontrahenci');
    }

}
