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
        Schema::create('mutation', function (Blueprint $table) {
            $table->id();
            $table->date('date_mutation');
            $table->unsignedInteger('id_joueur');
            $table->unsignedInteger('id_ancien_club');
            $table->unsignedInteger('id_new_club');
            $table->string('motif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mutation');
    }
};
