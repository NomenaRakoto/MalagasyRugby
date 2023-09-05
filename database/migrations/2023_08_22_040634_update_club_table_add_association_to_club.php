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
        Schema::table('club', function (Blueprint $table) {
            //

            $table->unsignedInteger('id_region')->nullable();
            $table->unsignedInteger('type')->nullable();
            $table->unsignedInteger('id_section')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('club', function (Blueprint $table) {
            //
        });
    }
};
