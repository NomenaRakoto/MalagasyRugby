<?php
    namespace App\Exports; 
    use App\Models\Club;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
 
    class AssociationExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table




        return ['nom',
                'contact',
                'responsable',
                'adresse',
                'mail_adresse',
                'fb_adresse',
                'observation',
                'region',
                'type'
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
                                'ligue.nom as region',
                                'type_association.designation as type')->join('ligue', 'club.id_region', 'ligue.id')->join('type_association', 'type_association.id', 'club.type')->whereNotNull('type')->get(); 
        }
    }
?>