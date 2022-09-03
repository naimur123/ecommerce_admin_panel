<?php

namespace App\Exports;

use App\Http\Resources\UserResource;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class CustomerList implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Email verified at',
            'Phone',
            'Social Id',
            'Image',
            'Created_at',
            'Updated_at' 
        ];
    } 
    
    public function collection()
    {
       return UserResource::collection(User::all());
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,        
            'C' => 30,
            'D' => 30,    
            'E' => 30,          
            'F' => 30,          
            'G' => 30,          
            'H' => 30,          
            'I' => 30,          
        ];
    }
    
}
