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
        /*return ForestUnit::select('forest_units.code', 'functional_units.code', forest_units.common_name', 'forest_units.scientific_name', 'forest_units.cap_cm', 'forest_units.total_heigth_m', 'forest_units.commercial_heigth_m', 'forest_units.condition', 'forest_units.health_status', 'forest_units.origin','forest_units.cup_density', 'forest_units.x_cup_diameter_m', 'forest_units.y_cup_diameter_m', 'forest_units.waypoint', 'forest_units.epiphytes', 'forest_units.note')
            ->join('functional_units', 'functional_units.id', '=', 'forest_units.functional_unit_id')
            ->join('projects', 'projects.id', '=', 'functional_units.project_id')
            ->where('functional_units.project_id', $this->projectId)->get();*/
        return ForestUnit::select('forest_units.code', 'functional_units.code as UF', 'forest_units.common_name', 'forest_units.scientific_name', 'forest_units.family', 'forest_units.cap_cm', 'forest_units.total_heigth_m', 'forest_units.commercial_heigth_m', 'forest_units.condition', 'forest_units.health_status', 'forest_units.origin','forest_units.cup_density', 'forest_units.x_cup_diameter_m', 'forest_units.y_cup_diameter_m', 'forest_units.waypoint', 'forest_units.epiphytes', 'forest_units.products','forest_units.margin','forest_units.treatment','forest_units.resolution','forest_units.state','forest_units.end_treatment','forest_units.note')
            ->join('functional_units', 'functional_units.id', '=', 'forest_units.functional_unit_id')
            ->join('projects', 'projects.id', '=', 'functional_units.project_id')
            ->where('functional_units.project_id', $this->projectId)->get();
    }

    public function headings(): array
    {
        /*return [
            'ID',
            'UF',
            'NOMBRE COMÚN',
            'N. CIENTÍFICO',
            'CAP',
            'HT',
            'HC',
            'ESTADO FÍSICO',
            'ESTADO SANITARIO',
            'ORIGEN',
            'DENSIDAD DE COPA',
            'DIÁMETRO DE COPA X',
            'DIÁMETRO DE COPA Y',
            'WAYPOINT',
            'EPÍFITAS',
            'OBSERVACIONES'
        ];*/
        return [
            'ID',
            'UF',
            'NOMBRE COMÚN',
            'N. CIENTÍFICO',
            'FAMILIA',
            'CAP',
            'HT',
            'HC',
            'ESTADO FÍSICO',
            'ESTADO SANITARIO',
            'ORIGEN',
            'DENSIDAD DE COPA',
            'DIÁMETRO DE COPA X',
            'DIÁMETRO DE COPA Y',
            'WAYPOINT',
            'EPÍFITAS',
            'PRODUCTOS Y POSIBLE USO',
            'MARGEN',
            'TRATAMIENTO',
            'RESOLUCIÓN',
            'ESTADO',
            'FECHA DE TRATAMIENTO',
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
