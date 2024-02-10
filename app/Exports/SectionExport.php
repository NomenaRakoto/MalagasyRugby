<?php
    namespace App\Exports; 
    use App\Models\Section;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
 
    class SectionExport implements FromCollection, WithHeadings { 
        private $ligue ;

        function __construct($id_ligue = null) {
            $this->ligue = $id_ligue;
        }

        public function headings(): array {




        // according to users table




        return [
                'nom',
                'contact',
                'president',
                'adresse',
                'mail_adresse',
                'fb_adresse',
                'observation',
                'Ligue'
           ];

        }

        public function collection() 
        { 
            if($this->ligue) {
                return Section::select('section.nom',
                            'section.contact',
                            'section.president',
                            'section.adresse',
                            'section.mail_adresse',
                            'section.fb_adresse',
                            'section.observation',
                            'ligue.nom as Ligue')->leftJoin('ligue', 'section.id_ligue', 'ligue.id')
                            ->where('id_ligue', $this->ligue)
                            ->get();
            } else {
                return Section::select('section.nom',
                            'section.contact',
                            'section.president',
                            'section.adresse',
                            'section.mail_adresse',
                            'section.fb_adresse',
                            'section.observation',
                            'ligue.nom as Ligue')->leftJoin('ligue', 'section.id_ligue', 'ligue.id')->get();
            }
             
        }
    }
?>