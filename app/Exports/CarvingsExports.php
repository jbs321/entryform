<?php
/**
 * Created by PhpStorm.
 * User: jlanir
 * Date: 5/3/2018
 * Time: 3:02 PM
 */

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarvingsExports implements FromCollection, WithHeadings
{
    public $data;
    public $headers;

    public function __construct(Collection $data, array $headers = [])
    {
        $this->data = $data;
        $this->headers = $headers;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->headers;
    }
}