<?php

namespace App\Exports;

use App\Models\HillsideDisplacement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class HillsideDisplacementsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return HillsideDisplacement::select('code','report_date','longitude','width','new','location','description','level','responsible_name','responsible_id','observations')->where('project_id', $this->projectId)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA DE REPORTE',
            'LONGITUD',
            'ANCHO',
            'GRIETA',
            'UBICACIÓN',
            'DESCRIPCIÓN',
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
