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
        Schema::create('jeunes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->date('date_naissance');
            $table->unsignedInteger('id_association');
            $table->string('adresse')->nullable();
            $table->string('pere')->nullable();
            $table->string('mere')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('id_sexe');
            $table->unsignedInteger('id_categorie');
            $table->unsignedInteger('id_etude')->nullable();
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
        Schema::dropIfExists('jeunes');
    }
};
