<?php
    namespace App\Exports; 
    use App\Models\Ligue;
    use Maatwebsite\Excel\Concerns\FromCollection; 
    use Maatwebsite\Excel\Concerns\WithHeadings;
 
    class LigueExport implements FromCollection, WithHeadings { 
        public function headings(): array {




        // according to users table




        return [
                'nom',
                'contact',
                'president',
                'vpresident',
                'observation',
                'ctr',
                'adresse',
                'mail_adresse',
                'fb_adresse'
           ];

        }

        public function collection() 
        { 
            return Ligue::select('nom',
                                'contact',
                                'president',
                                'vpresident',
                                'observation',
                                'ctr',
                                'adresse',
                                'mail_adresse',
                                'fb_adresse')->get(); 
        }
    }
?>