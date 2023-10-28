<?php
    namespace App\Exports; 
    use App\Models\Club;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
 
    class ClubExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table




        return ['nom',
                'contact',
                'responsable',
                'adresse',
                'mail_adresse',
                'fb_adresse',
                'observation',
                'section',
                'ligue',
                'statut'
           ];

        }

        public function collection() 
        {  
            return Club::select('club.nom',
                                'club.contact',
                                'club.responsable',
                                'club.adresse',
                                'club.mail_adresse',
                                'club.fb_adresse',
                                'club.observation',
                                'section.nom as section',
                                'ligue.nom as ligue',
                                'actif')->leftJoin('section', 'club.id_section', 'section.id')->leftJoin('ligue', 'section.id_ligue', 'ligue.id')->get(); 
        }
    }
?>