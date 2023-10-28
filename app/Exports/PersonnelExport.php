<?php
    namespace App\Exports; 
    use App\Models\Personnel;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Illuminate\Support\Facades\DB;

    class PersonnelExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table


        /* 'id_type',
        'nom',
        'prenom',
        'date_naissance',
        'cin',
        'id_club',
        'id_s_cat',
        'observation',
        'licence',
        'annee_validite',
        'id_expire',
        'id_sexe',
        'identification',
        'id_format_jeu',
        'id_position_jeu',
        'id_statut_regle_8',
        'id_statut_citoyennete',
        'nb_match_last',
        'id_niveau_equipe',
        'passeport',
        'actif',
        'taille',
        'poids',
        'selection_id',
        'annee_selection',
        'telephone'*/

        return [ 
            'nom',
            'prenom',
            'date_naissance',
            'sexe',
            'format_du_jeu',
            'niveau_de_lequipe',
            'position_de_jeu',
            'nombre_de_match',
            'statut_de_la_citoyennete',
            'statut_de_la_regle_8',
            'assurance_medicale',
            'numero_de_passeport',
            'carte_d_identite',
            'role_dans_l_equipe',
            'club',
            'section',
            'ligue',
            'sous_categorie',
            'categorie'
           ];

        }

        public function collection() 
        {  
           
            return Personnel::whereNotNull('cin')->select('personnel.nom',
                                    'personnel.prenom',
                                    'personnel.date_naissance',
                                    'sexe.designation as sexe',
                                    'format_jeu.designation as format_du_jeu',
                                    'niveau_equipe.designation as niveau_de_lequipe',
                                    'position_jeu.designation as position_de_jeu',
                                    'nb_match_last as nombre_de_match',
                                    'statut_citoyennete.designation as statut_de_la_citoyennete',
                                    'statut_regle.designation as statut_de_la_regle_8',
                                    DB::raw("'Oui' AS assurance_medicale"),
                                    'passeport as numero_de_passeport',
                                    'cin as carte_d_identite',
                                    'type.designation as role_dans_l_equipe',
                                    'club.nom as club',
                                    'section.nom as section',
                                    'ligue.nom as ligue',
                                    'scat.designation as sous_categorie',
                                    'categorie.designation as categorie')
                                    ->leftJoin('club', 'personnel.id_club', 'club.id')
                                    ->leftJoin('section', 'club.id_section', 'section.id')
                                    ->leftJoin('ligue', 'section.id_ligue', 'ligue.id')
                                    ->leftJoin('sexe', 'sexe.id', 'personnel.id_sexe')
                                    ->leftJoin('format_jeu', 'format_jeu.id', 'personnel.id_format_jeu')
                                    ->leftJoin('niveau_equipe', 'niveau_equipe.id', 'personnel.id_niveau_equipe')
                                    ->leftJoin('position_jeu', 'position_jeu.id', 'personnel.id_position_jeu')
                                    ->leftJoin('statut_citoyennete', 'statut_citoyennete.id', 'personnel.id_statut_citoyennete')
                                    ->leftJoin('statut_regle', 'statut_regle.id', 'personnel.id_statut_regle_8')
                                    ->leftJoin('type', 'type.id', 'personnel.id_type')
                                    ->leftJoin('scat', 'scat.id', 'personnel.id_s_cat')
                                    ->leftJoin('categorie', 'categorie.id', 'scat.id')
                                    ->get(); 
        }
    }
?>