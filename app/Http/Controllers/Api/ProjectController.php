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
    public function index()
    {
        //
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

    public function show(Project $project)
    {
        //return Project::where('id', $project)->get();
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
