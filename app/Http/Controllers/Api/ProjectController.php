<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\FunctionalUnit;
use App\Models\ForestUnit;
use App\Models\Contractor;
use App\Models\User;
use App\Exports\ProjectInventoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
/**
* @OA\Server(url="http://localhost:8000")
*/

class ProjectController extends Controller
{
    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project",
            summary="Mostrar lista de proyectos",
            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
            ),
            @OA\Response(
                response=204,
                description="No hay resultados que mostrar."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */
    public function index()
    {
        foreach (Project::all() as $project)
        {
            $projects[] = $project->setAttribute('customer', $project->customer);
        }

        return ( $projects ) ? $projects : response()->json(null, 204);
    }

    public function create()
    {
        //
    }

    /**
        @OA\POST(
            tags={"Proyecto"},
            path="/api/project",
            summary="Registrar proyecto",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre del proyecto",
                            example="Conjuntos Residenciales Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="inspector",
                            description="Interventor",
                            example="Marlon Gamba SA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="representative_name",
                            description="Nombre del representante",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="representative_position",
                            description="Cargo del representante",
                            example="Gerente General",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="administrative_act",
                            description="Acto administrativo",
                            example="Resolucion 0036",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="enviromental_control",
                            description="Autoridad Ambiental",
                            example="ANLA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="east_coord",
                            description="Coordenada Este",
                            example="1142274",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="north_coord",
                            description="Coordenada Norte",
                            example="1155849",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Localización",
                            example="Fase I",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="phase",
                            description="Fase",
                            example="1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="customer_id",
                            description="Id del cliente",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Proyecto registrada."
            ),
            @OA\Response(
                response=400,
                description="Request mal mandado."
            ),
            @OA\Response(
                response=401,
                description="Ingreso no autorizado."
            ),
            @OA\Response(
                response=405,
                description="metodo HTTP no permitido."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */
    
    public function store(Request $request)
    {        
        $project = new Project;
        $project->name                     = $request->name;
        $project->inspector                = $request->inspector;
        $project->responsible              = $request->responsible;
        $project->representative_name      = $request->representative_name;
        $project->representative_position  = $request->representative_position;
        $project->administrative_act       = $request->administrative_act;
        $project->enviromental_control     = $request->enviromental_control;
        $project->east_coord               = $request->east_coord;
        $project->north_coord              = $request->north_coord;
        $project->location                 = $request->location;
        $project->phase                    = $request->phase;
        $project->customer_id              = $request->customer_id;
        $project->save();

        return response()->json(["message" => "¡Proyecto registrado!", "id" => $project->id], 200);
    }

    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project/{id}",
            summary="Consultar proyecto por ID",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "2",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
            ),
            @OA\Response(
                response=204,
                description="No hay resultados que mostrar."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */

    public function show(Project $project)
    {
        $project->setAttribute('customer', $project->customer);

        return ( $project ) ? $project : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project/functional-units/{id}",
            summary="Mostrar lista de unidades funcionales por proyecto",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
            ),
            @OA\Response(
                response=204,
                description="No hay resultados que mostrar."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */
    public function functionalUnits($id)
    {
        $functionalUnits = Project::find($id)->functional_units;
        return ( $functionalUnits ) ? $functionalUnits : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project/forest-units/{id}",
            summary="Mostrar lista de individuos forestales por proyecto",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
            ),
            @OA\Response(
                response=204,
                description="No hay resultados que mostrar."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */
    public function forestUnits($id)
    {
        foreach (Project::find($id)->functional_units as $functionalUnit)
        {
            if ($functionalUnit->forest_units)
            {
                $forestUnits[] = $functionalUnit->forest_units;
            }
        }
        return ( $forestUnits ) ? $forestUnits : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project/users/{id}",
            summary="Mostrar lista de usuarios asignados a un proyecto",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
            ),
            @OA\Response(
                response=204,
                description="No hay resultados que mostrar."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */
    public function users($id)
    {
        $contractors = Contractor::where('project_id', $id)->get();
        $users = [];
        foreach ($contractors as $contractor)
        {
            if (!in_array($contractor->user, $users))
                $users[] = $contractor->user;
        }
        return ( $users ) ? $users : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Proyecto"},
            path="/api/project/export/{id}",
            summary="Consolidado",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),
            @OA\Response(
                response=200,
                description="Consolidado del inventario."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */

    public function export($id)
    {
        return Excel::download(new ProjectInventoryExport($id), 'inventario.xls');
    }

    public function edit(Project $project)
    {
        //
    }

    /**
        @OA\PUT(
            tags={"Proyecto"},
            path="/api/project/{id}",
            summary="Editar proyecto",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del proyecto",
                @OA\Schema(type="integer")
            ),

            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre del proyecto",
                            example="Conjuntos Residenciales CAMC",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="inspector",
                            description="Interventor",
                            example="CAMC SA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="representative_name",
                            description="Nombre del representante",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="representative_position",
                            description="Cargo del representante",
                            example="Gerente General",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="administrative_act",
                            description="Acto administrativo",
                            example="Resolucion 0036",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="enviromental_control",
                            description="Autoridad Ambiental",
                            example="ANLA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="east_coord",
                            description="Coordenada Este",
                            example="1142274",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="north_coord",
                            description="Coordenada Norte",
                            example="1155849",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Localización",
                            example="Fase I",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="phase",
                            description="Fase",
                            example="1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="customer_id",
                            description="Id del cliente",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Proyecto registrada."
            ),
            @OA\Response(
                response=400,
                description="Request mal mandado."
            ),
            @OA\Response(
                response=401,
                description="Ingreso no autorizado."
            ),
            @OA\Response(
                response=405,
                description="metodo HTTP no permitido."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */

    public function update(Request $request, Project $project)
    {
        $project->name                     = $request->name;
        $project->inspector                = $request->inspector;
        $project->responsible              = $request->responsible;
        $project->representative_name      = $request->representative_name;
        $project->representative_position  = $request->representative_position;
        $project->administrative_act       = $request->administrative_act;
        $project->enviromental_control     = $request->enviromental_control;
        $project->east_coord               = $request->east_coord;
        $project->north_coord              = $request->north_coord;
        $project->location                 = $request->location;
        $project->phase                    = $request->phase;
        $project->customer_id              = $request->customer_id;
        $project->save();

        return response()->json(["message" => "¡Proyecto editado correctamente!", "id" => $project->id], 200);
    }

    public function destroy(Project $project)
    {
        //
    }

    /**
        @OA\POST(
            tags={"Proyecto"},
            path="/api/project/massive",
            summary="Probar como llegan los datos de excel desde angular",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del proyecto",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="arbol",
                            type="string"
                        ),
                        @OA\Property(
                            property="uf",
                            type="string"
                        ),
                        @OA\Property(
                            property="comun",
                            type="string"
                        ),
                        @OA\Property(
                            property="especie",
                            type="string"
                        ),
                        @OA\Property(
                            property="familia",
                            type="string"
                        ),
                        @OA\Property(
                            property="cap",
                            type="number",
                            format="float"
                        ),
                        @OA\Property(
                            property="altura_total",
                            type="number",
                            format="float"
                        ),
                        @OA\Property(
                            property="altura_comercial",
                            type="number",
                            format="float"
                        ),
                        @OA\Property(
                            property="diametro_copa",
                            type="number",
                            format="float"
                        ),
                        @OA\Property(
                            property="estado_fisico",
                            type="string"
                        ),
                        @OA\Property(
                            property="estado_sanitario",
                            type="string"
                        ),
                        @OA\Property(
                            property="coor_x",
                            type="string"
                        ),
                        @OA\Property(
                            property="coor_y",
                            type="string"
                        ),
                        @OA\Property(
                            property="origen",
                            type="string"
                        ),
                        @OA\Property(
                            property="densidad_copa",
                            type="string"
                        ),
                        @OA\Property(
                            property="producto",
                            type="string"
                        ),
                        @OA\Property(
                            property="margen",
                            type="string"
                        ),
                        @OA\Property(
                            property="tratamiento",
                            type="string"
                        ),
                        @OA\Property(
                            property="resolucion",
                            type="string"
                        ),
                        @OA\Property(
                            property="observaciones",
                            type="string"
                        ),
                        example={
                            "excelData": 
                            { 
                                "arbol": "F4",
                                "uf": "UF1",
                                "comun": "Cedro-Cedro amargo",
                                "especie": "Cedrela odorata L.",
                                "familia": "Meliaceae",
                                "cap": "45.3",
                                "altura_total": "10",
                                "altura_comercial": "2",
                                "diametro_copa_x": "6",
                                "diametro_copa_y": "6",
                                "estado_fisico": "Bueno",
                                "estado_sanitario": "Bueno",
                                "coor_x": "1053823",
                                "coor_y": "956015",
                                "origen": "Nativa",
                                "densidad_copa": "Clara",
                                "producto": "Madera",
                                "margen": "Izquierda",
                                "tratamiento": "Tala",
                                "resolucion": "Resolucion 0369",
                                "observaciones": "Árbol localizado sobre la margen"
                            },
                            "projectId": 2
                        }
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Muestra el resultado."
            ),
            @OA\Response(
                response=400,
                description="Indica que no se mandarón bien los parametros."
            ),
            @OA\Response(
                response=405,
                description="Metodo no permitido."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */

    public function massive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excelData' => 'required|array',
            'projectId'  => 'required|integer'
        ]);

        if ($validator->fails()) {

            $validatorErrors = array();

            foreach ($validator->errors()->getMessages() as $item)
            {
                array_push($validatorErrors, $item[0]);
            }

            return response()->json($validatorErrors, 400);
        }
        
        foreach ($request->excelData as $unit)
        {
            $forestUnit = new ForestUnit;
            try
            {
                $functionalUnit = FunctionalUnit::where('code', $unit["uf"])->where('project_id', $request->projectId)->first();
                if (!$functionalUnit)
                {
                    $functionalUnit = new FunctionalUnit;
                    $functionalUnit->code       = $unit['uf'];
                    $functionalUnit->type       = 1;
                    $functionalUnit->project_id = $request->projectId;

                    $functionalUnit->save();
                }

                if ($this->validateCode($functionalUnit->id, $unit["arbol"]))
                {
                    $forestUnit->code                = isset($unit["arbol"]) ? $unit["arbol"] : null;
                    $forestUnit->common_name         = isset($unit["comun"]) ? $unit["comun"] : null;
                    $forestUnit->species             = isset($unit["especie"]) ? $unit["especie"] : null;
                    $forestUnit->family              = isset($unit["familia"]) ? $unit["familia"] : null;
                    $forestUnit->cap_cm              = isset($unit["cap"]) ? $unit["cap"] : null;
                    $forestUnit->total_heigth_m      = isset($unit["altura_total"]) ? $unit["altura_total"] : null;
                    $forestUnit->commercial_heigth_m = isset($unit["altura_comercial"]) ? $unit["altura_comercial"] : null;
                    $forestUnit->x_cup_diameter_m    = isset($unit["diametro_copa_x"]) ? $unit["diametro_copa_x"] : null;
                    $forestUnit->y_cup_diameter_m    = isset($unit["diametro_copa_y"]) ? $unit["diametro_copa_y"] : null;
                    $forestUnit->condition           = isset($unit["estado_fisico"]) ? $unit["estado_fisico"] : null;
                    $forestUnit->health_status       = isset($unit["estado_sanitario"]) ? $unit["estado_sanitario"] : null;
                    $forestUnit->north_coord         = isset($unit["coor_x"]) ? $unit["coor_x"] : null;
                    $forestUnit->east_coord          = isset($unit["coor_y"]) ? $unit["coor_y"] : null;
                    $forestUnit->origin              = isset($unit["origen"]) ? $unit["origen"] : null;
                    $forestUnit->cup_density         = isset($unit["densidad_copa"]) ? $unit["densidad_copa"] : null;
                    $forestUnit->products            = isset($unit["producto"]) ? $unit["producto"] : null;
                    $forestUnit->margin              = isset($unit["margen"]) ? $unit["margen"] : null;
                    $forestUnit->treatment           = isset($unit["tratamiento"]) ? $unit["tratamiento"] : null;
                    $forestUnit->resolution          = isset($unit["resolucion"]) ? $unit["resolucion"] : null;
                    $forestUnit->version             = isset($unit["version"]) ? $unit["version"] : null;
                    $forestUnit->sheet_number        = isset($unit["numero_planilla"]) ? $unit["numero_planilla"] : null;
                    $forestUnit->note                = isset($unit["observaciones"]) ? $unit["observaciones"] : null;
                    $forestUnit->functional_unit_id  = $functionalUnit->id;

                    $forestUnit->save();
                }
                
            }
            catch (Exception $e)
            {
                
            }
        }
        return response()->json(["message" => "¡Carga masiva exitosa!"], 200);
    }

    public function validateCode($functional_unit_id, $code)
    {
        foreach (FunctionalUnit::find($functional_unit_id)->forest_units as $unit) {
            if ($code == $unit->code) return false;
        }
        return true;
    }
}
