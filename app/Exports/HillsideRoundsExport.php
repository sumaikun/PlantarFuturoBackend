<?php

namespace App\Exports;

use App\HillsideRound;
use Maatwebsite\Excel\Concerns\FromCollection;

class HillsideRoundsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HillsideRound::all();
    }
}
