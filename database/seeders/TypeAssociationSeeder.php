<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('type_association')->insert([
        		'id' => 1,
            	'designation' => 'Etablissement'
            ] 
        );

         DB::table('type_association')->insert(
            [
            	'id' => 2,
            	'designation' => 'Association'
            ]  
        );
    }
}
