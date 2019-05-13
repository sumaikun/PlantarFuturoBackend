<?php

namespace App\Exports;

use App\Models\ForestUnit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProjectInventoryExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return ForestUnit::select('forest_units.code', 'forest_units.common_name', 'forest_units.scientific_name', 'forest_units.family', 'forest_units.cap_cm', 'forest_units.total_heigth_m', 'forest_units.commercial_heigth_m', 'forest_units.condition', 'forest_units.health_status', 'forest_units.x_cup_diameter_m', 'forest_units.y_cup_diameter_m', 'forest_units.east_coord', 'forest_units.north_coord', 'forest_units.note')
            ->join('functional_units', 'functional_units.id', '=', 'forest_units.functional_unit_id')
            ->join('projects', 'projects.id', '=', 'functional_units.project_id')
            ->where('functional_units.project_id', $this->projectId)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NOMBRE COMÚN',
            'N. CIENTÍFICO',
            'FAMILIA',
            'CAP',
            'HT',
            'HC',
            'ESTADO FÍSICO',
            'ESTADO SANITARIO',
            'DIÁMETRO DE COPA X',
            'DIÁMETRO DE COPA Y',
            'COORDENADA NORTE',
            'COORDENADA ESTE',
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
