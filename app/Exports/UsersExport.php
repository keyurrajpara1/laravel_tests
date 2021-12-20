<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

// class UsersExport implements FromCollection, Responsable
// class UsersExport implements FromCollection
// class UsersExport implements FromArray
// class UsersExport implements FromView
class UsersExport implements 
    // FromCollection, 
    ShouldAutoSize, 
    WithMapping, WithHeadings, WithEvents, WithDrawings, WithCustomStartCell,
    FromQuery
{
    use Exportable;
    // private $fileName = "users.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        // return User::all();
        // return [
        //     ['Abc', 'Abc@gmail.com']
        // ];
        return new Collection([
            ['Abc', 'Abc@gmail.com']
        ]);
    }*/
    /*public function array(): array
    {
        return [
            ['Abc', 'Abc@gmail.com']
        ];
    }*/
    /*public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }*/
    /*public function collection(){
        return User::with('address')->get();
    }*/
    public function query(){
        return User::query()->with('address');
    }
    public function map($user): array{
        return [
            $user->id,
            $user->name,
            $user->address->country,
        ];
    }
    public function headings(): array{
        return [
            '#',
            'Email',
            'Country',
            'Created At'
        ];
    }
    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event){
                // $event->sheet->getStyle('A1:D1')->applyFromArray([
                $event->sheet->getStyle('A8:D8')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            }
        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/laravel_logo.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B2');

        return $drawing;
    }
    public function startCell(): string
    {
        return 'A8';
    }
}
