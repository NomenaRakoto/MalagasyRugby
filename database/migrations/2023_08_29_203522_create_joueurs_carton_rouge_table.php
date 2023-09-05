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
        Schema::create('joueurs_carton_rouge', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_match');
            $table->unsignedInteger('id_perso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joueurs_carton_rouge');
    }
};
