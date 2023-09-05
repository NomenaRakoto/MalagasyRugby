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
        //
        Schema::table('personnel', function (Blueprint $table) {
           $table->integer('id_type')->nullable()->change();
           $table->string('cin')->nullable()->change();
           $table->unsignedInteger('id_s_cat')->nullable()->change();
           $table->unsignedInteger('id_cat')->nullable();
           $table->bigInteger('licence')->nullable()->change();
           $table->string('identification')->nullable()->change();
           $table->string('pere')->nullable();
           $table->string('mere')->nullable();
           $table->unsignedInteger('id_etude')->nullable();
           $table->string('adresse')->nullable();
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
