<?php

namespace App\Exports;

use App\Models\Precipitation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PrecipitationsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	public function __construct(int $projectId)
    {
        $this->projectId = $projectId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	return Precipitation::select('code','report_date','type','mm_hours','start','finish','level','responsible_name','responsible_id','observations')->where('project_id', $this->projectId)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA DE REPORTE',
            'TIPO',
            'mm/hora',
            'FECHA Y HORA DE INICIO',
            'FECHA Y HORA FINAL',
            'ESTADO DE EMERGENCIA',
            'RESPONSABLE',
            'IDENTIFICACIÓN',
            'OBSERVACIONES'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
