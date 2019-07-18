<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Project;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
        @OA\Get(
            tags={"[SST] Visitantes"},
            path="/api/sst/visitor",
            summary="Mostrar lista de visitantes",
            @OA\Response(
                response=200,
                description="Mostrar todos los visitantes."
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
        foreach (Visitor::all() as $visitor)
        {
            $visitors[] = $visitor->setAttribute('project', $visitor->project);
        }

        return ( $visitors ) ? $visitors : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[SST] Visitantes"},
            path="/api/sst/visitor",
            summary="Registrar Visitante",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre del visitante",
                            example="Miguel",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="document",
                            description="Documento del visitante",
                            example="1030256147",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="entity",
                            description="Entidad del visitante",
                            example="ANLA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="position",
                            description="Cargo del visitante",
                            example="Supervisor",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="state",
                            type="boolean",
                            description="Estado (1: Activo, 0: Inactivo)",
                            example="1"
                        ),

                        @OA\Property(
                            property="project_id",
                            description="Id del proyecto",
                            example="2",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Visitante registrada."
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
        $visitor = new Visitor;
        $visitor->name       = $request->name;
        $visitor->document   = $request->document;
        $visitor->entity     = $request->entity;
        $visitor->position   = $request->position;
        $visitor->state      = $request->state;
        $visitor->project_id = $request->project_id;
        $visitor->save();

        return response()->json(["message" => "¡Visitante registrada!", "id" => $visitor->id], 200);
    }

    /**
        @OA\Get(
            tags={"[SST] Visitantes"},
            path="/api/sst/visitor/{id}",
            summary="Ver visitantes por proyecto",
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
                description="Mostrar todos los visitantes."
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

    public function show($id)
    {
        $visitors = Visitor::where('project_id', $id)->get();

        return ( $visitors ) ? $visitors : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[SST] Visitantes"},
            path="/api/sst/visitor/{id}",
            summary="Editar Visitante",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary Key) del visitante",
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
                            description="Nombre del visitante",
                            example="Miguel",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="document",
                            description="Documento del visitante",
                            example="1030256147",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="entity",
                            description="Entidad del visitante",
                            example="ANLA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="position",
                            description="Cargo del visitante",
                            example="Supervisor",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="state",
                            type="boolean",
                            description="Estado (1: Activo, 0: Inactivo)",
                            example="1"
                        ),

                        @OA\Property(
                            property="project_id",
                            description="Id del proyecto",
                            example="2",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Visitante registrada."
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

    public function update(Request $request, Visitor $visitor)
    {
        $visitor->name       = $request->name;
        $visitor->document   = $request->document;
        $visitor->entity     = $request->entity;
        $visitor->position   = $request->position;
        $visitor->state      = $request->state;
        $visitor->project_id = $request->project_id;
        $visitor->save();

        return response()->json(["message" => "¡Visitante editado correctamente!", "id" => $visitor->id], 200);
    }
}
