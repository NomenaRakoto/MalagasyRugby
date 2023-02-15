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
        Schema::create('scat', function (Blueprint $table) {
            $table->id();
            $table->string("designation");
            $table->unsignedInteger("min_age")->nullable();
            $table->unsignedInteger("max_age")->nullable();
            $table->unsignedInteger("id_sexe")->nullable();
            $table->unsignedInteger("id_cat")->nullable();
            $table->unsignedInteger("id_type")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scat');
    }
};
