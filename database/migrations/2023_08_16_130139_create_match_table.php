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
        Schema::create('match', function (Blueprint $table) {
            $table->id();
            $table->date('date_match');
            $table->time('heure');
            $table->unsignedInteger('id_categorie');
            $table->unsignedInteger('nb_essai')->nullable()->default(0);
            $table->text('joueurs_essai')->nullable();
            $table->unsignedInteger('bonus_offensive')->nullable()->default(0);
            $table->unsignedInteger('bonus_defensive')->nullable()->default(0);
            $table->unsignedInteger('nb_blessure')->nullable()->default(0);
            $table->unsignedInteger('commotion_cerebrale')->nullable()->default(0);
            $table->unsignedInteger('id_club_home');
            $table->unsignedInteger('id_club_guest');
            $table->string('terrain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match');
    }
};
