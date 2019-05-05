<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
}
