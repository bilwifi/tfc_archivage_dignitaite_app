<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dignitaires', function (Blueprint $table) {
            $table->bigIncrements('iddignitaires');
            $table->string('nom');
            $table->string('postnom')->nullable();
            $table->string('prenom');
            $table->string('lieu_naissance');
            $table->date('date_naissance');
            $table->date('date_deces')->nullable();
            $table->string('nationalite');
            $table->string('fonction');
            $table->text('picture')->nullable();
            
        });
        Schema::create('medailles', function (Blueprint $table) {
            $table->bigIncrements('idmedailles');
            $table->string('lib');
            $table->text('picture');
            $table->text('description')->nullable();
          
        });
        Schema::create('titres', function (Blueprint $table) {
            $table->bigIncrements('idtitres');
            $table->unsignedBigInteger('iddignitaires');
            $table->unsignedBigInteger('idmedailles');
            $table->string('num_brevet')->unique();
            $table->date('date_decoration');
            $table->foreign('iddignitaires')
                  ->references('iddignitaires')->on('dignitaires')->onDelete('cascade');
            $table->foreign('idmedailles')
                  ->references('idmedailles')->on('medailles')->onDelete('cascade');
            
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('titres');
        Schema::dropIfExists('medailles');
        Schema::dropIfExists('dignitaires');
        
    }
}
