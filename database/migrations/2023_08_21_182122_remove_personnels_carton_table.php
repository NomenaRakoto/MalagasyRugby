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
        Schema::table('personnel', function($table) {
            $table->dropColumn('carton_jaune');
            $table->dropColumn('carton_rouge');
        });

        Schema::table('match', function($table) {
            $table->unsignedInteger('nb_carton_jaune')->nullable()->default(0);
            $table->unsignedInteger('nb_carton_rouge')->nullable()->default(0);
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
