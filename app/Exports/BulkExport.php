<?php

namespace App\Exports;

use App\Models\Bulk;
use Maatwebsite\Excel\Concerns\FromCollection;

class BulkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // use Exportable;
    public function collection()
    {
        return Bulk::all();
    }

 
}
