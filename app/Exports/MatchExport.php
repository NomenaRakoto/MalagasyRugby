<?php
    namespace App\Exports; 
    use App\Models\MatchRugby;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Illuminate\Support\Facades\DB;
 
    class MatchExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table


        /*'date_match',
        'heure',
        'id_categorie',
        'nb_essai',
        'joueurs_essai',
        'bonus_offensive',
        'bonus_defensive',
        'nb_blessure',
        'commotion_cerebrale',
        'id_club_home',
        'id_club_guest',
        'terrain',
        'nb_carton_jaune',
        'nb_carton_rouge'*/

        return [ 
            'date_match',
            'heure',
            'categorie',
            'nb_essai',
            'bonus_offensive',
            'bonus_defensive',
            'nb_blessure',
            'commotion_cerebrale',
            'nb_carton_jaune',
            'nb_carton_rouge',
            'club_1',
            'club_2',
            'terrain',
            
           ];

        }

        public function collection() 
        {  
            return MatchRugby::select('match.date_match',
                                    'match.heure',
                                    'categorie.designation as categorie',
                                    'match.nb_essai',
                                    'match.bonus_offensive',
                                    'match.bonus_defensive',
                                    'match.nb_blessure',
                                    'match.commotion_cerebrale',
                                    'nb_carton_jaune',
                                    'nb_carton_rouge',
                                    'club1.nom as club_1',
                                    'club2.nom as club_2',
                                    'match.terrain')
                                    ->join('categorie', 'categorie.id', 'match.id_categorie')
                                    ->join('club as club1', 'match.id_club_home', 'club1.id')
                                    ->join('club as club2', 'match.id_club_guest', 'club2.id')
                                    ->get(); 
        }
    }
?>