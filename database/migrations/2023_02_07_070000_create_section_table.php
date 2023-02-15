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
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('contact')->nullable();
            $table->string('president')->nullable();
            $table->string('observation')->nullable();
            $table->unsignedInteger('id_ligue');
            $table->string('logo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('mail_adresse')->nullable();
            $table->string('fb_adresse')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section');
    }
};
