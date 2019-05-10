<?php

namespace App\Exports;

use App\Models\ForestUnit;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectInventoryExport implements FromCollection
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
        return ForestUnit::select('forest_units.code', 'forest_units.common_name', 'forest_units.scientific_name', 'forest_units.family', 'forest_units.cap_cm', 'forest_units.total_heigth_m', 'forest_units.commercial_heigth_m', 'forest_units.condition', 'forest_units.health_status', 'forest_units.cup_diameter_m', 'forest_units.east_coord', 'forest_units.north_coord', 'forest_units.note')
            ->join('functional_units', 'functional_units.id', '=', 'forest_units.functional_unit_id')
            ->join('projects', 'projects.id', '=', 'functional_units.project_id')
            ->where('functional_units.project_id', $this->projectId)->get();
    }
}
