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
        Schema::table('personnel', function (Blueprint $table) {
            $table->double('taille')->nullable();
            $table->double('poids')->nullable();
            $table->integer('carton_rouge')->nullable();
            $table->integer('carton_jaune')->nullable();
            $table->integer('selection_id')->nullable();
            $table->integer('annee_selection')->nullable();
            $table->string('telephone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
