<?php
/**
 * Created by PhpStorm.
 * User: jlanir
 * Date: 5/3/2018
 * Time: 3:02 PM
 */

namespace App\Exports;


use App\Carving;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarvingsExports implements FromCollection, WithHeadings
{
    public $data;

    public function __construct(Collection $carvings)
    {
        $this->data = $carvings;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Tag Number',
            'Name',
            'Skill',
            'Division',
            'Category',
            'Description',
            'Is for sale?',
        ];
    }
}