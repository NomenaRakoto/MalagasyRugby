<?php
    namespace App\Exports; 
    use App\Models\Jeune;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
 
    class JeuneExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table


        /*'nom',
            'prenom',
            'date_naissance',
            'id_club',
            'adresse',
            'pere',
            'mere',
            'id_sexe',
            'id_cat',
            'id_etude'*/

        return [ 
            'nom',
            'prenom',
            'date_naissance',
            'association',
            'adresse',
            'pere',
            'mere',
            'sexe',
            'categorie',
            'etude',
            'region'
           ];

        }

        public function collection() 
        {  
            return Jeune::whereNull('cin')->select('personnel.nom',
                                    'personnel.prenom',
                                    'personnel.date_naissance',
                                    'club.nom as association',
                                    'personnel.adresse',
                                    'personnel.pere',
                                    'personnel.mere',
                                    'sexe.designation as sexe',
                                    'categorie.designation as categorie',
                                    'etude.designation as etude',
                                    'ligue.nom as region')
                                    ->leftJoin('club', 'personnel.id_club', 'club.id')
                                    ->leftJoin('ligue', 'club.id_region', 'ligue.id')
                                    ->leftJoin('sexe', 'sexe.id', 'personnel.id_sexe')
                                    ->leftJoin('categorie', 'categorie.id', 'personnel.id_cat')
                                    ->leftJoin('etude', 'etude.id', 'personnel.id_etude')
                                    ->get(); 
        }
    }
?>