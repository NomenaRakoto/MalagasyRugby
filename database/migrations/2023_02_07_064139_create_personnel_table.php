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
        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            $table->integer('id_type');
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->date('date_naissance');
            $table->string('cin');
            $table->unsignedInteger('id_club');
            $table->unsignedInteger('id_s_cat');
            $table->string('observation')->nullable();
            $table->bigInteger('licence')->unique();
            $table->integer('annee_validite')->nullable();
            $table->unsignedInteger('id_expire')->nullable();
            $table->unsignedInteger('id_sexe');
            $table->string('identification');
            $table->unsignedInteger('id_format_jeu')->nullable();
            $table->unsignedInteger('id_position_jeu')->nullable();
            $table->unsignedInteger('id_statut_regle_8')->nullable();
            $table->unsignedInteger('id_statut_citoyennete')->nullable();
            $table->unsignedInteger('nb_match_last')->nullable();
            $table->unsignedInteger('id_niveau_equipe')->nullable();
            $table->string('passeport')->nullable();
            $table->string('actif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel');
    }
};
