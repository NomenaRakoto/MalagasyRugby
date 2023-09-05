<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('config')->insert([
        	'varname' => 'licence',
        	'value' => '40414'
        ]);

        DB::table('config')->insert([
        	'varname' => 'cin',
        	'value' => '1811'
        ]);

        DB::table('config')->insert([
            'varname' => 'nom_federation',
            'value' => 'Malagasy Rugby'
        ]);

        DB::table('config')->insert([
            'varname' => 'acronyme_federation',
            'value' => 'MR'
        ]);

        DB::table('config')->insert([
            'varname' => 'saison',
            'value' => '2023'
        ]);
    }
}
