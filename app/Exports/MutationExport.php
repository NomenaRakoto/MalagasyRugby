<?php
    namespace App\Exports; 
    use App\Models\Mutation;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Illuminate\Support\Facades\DB;
 
    class MutationExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table


        /*'date_mutation',
        'id_joueur',
        'id_ancien_club',
        'id_new_club',
        'motif'*/

        return [ 
            'date_mutation',
            'Nom_joueur',
            'club_de_depart',
            'Transfere_a',
            'motif'
           ];

        }

        public function collection() 
        {  
            return Mutation::select('mutation.date_mutation',
                                    DB::raw("CONCAT(personnel.nom,' ', personnel.prenom) AS Nom_joueur"),
                                    'club1.nom as club_de_depart',
                                    'club2.nom as Transfere_a',
                                    'motif')
                                    ->join('personnel', 'personnel.id', 'mutation.id_joueur')
                                    ->join('club as club1', 'club1.id', 'mutation.id_ancien_club')
                                    ->join('club as club2', 'club2.id', 'mutation.id_new_club')
                                    ->get(); 
        }
    }
?>