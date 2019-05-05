<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FunctionalUnit;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://plantarfuturo.com/ws")
*/

class FunctionalUnitController extends Controller
{
    /**
        @OA\Get(
            tags={"Unidad Funcional"},
            path="/api/functional-unit",
            summary="Mostrar lista de unidades funcionales",
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
        foreach (FunctionalUnit::all() as $functionalUnit)
        {
            $functionalUnits[] = $functionalUnit->setAttribute('project', $functionalUnit->project);
        }

        return ( $functionalUnits ) ? $functionalUnits : response()->json(null, 204);
    }

    public function create()
    {
        //
    }

    /**
        @OA\POST(
            tags={"Unidad Funcional"},
            path="/api/functional-unit",
            summary="Registrar Unidad Funcional",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="code",
                            description="Codigo de la unidad funcional",
                            example="UF1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo de UF (1: Licencia, 2: Compensación)",
                            example="1",
                            type="integer",
                            format="int32"
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
        $functionalUnit = new FunctionalUnit;
        $functionalUnit->code       = $request->code;
        $functionalUnit->type       = $request->type == 1 ? "Licencia" : "Compensación";
        $functionalUnit->project_id = $request->project_id;
        $functionalUnit->save();

        return response()->json(["message" => "¡Unidad funcional registrada!", "id" => $functionalUnit->id], 200);
    }

    /**
        @OA\Get(
            tags={"Unidad Funcional"},
            path="/api/functional-unit/{id}",
            summary="Ver unidad funcional",
            @OA\Parameter(
                name="id",
                in="path",
                description="id de la UF",
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

    public function show(FunctionalUnit $functionalUnit)
    {
        $functionalUnit->setAttribute('project', $functionalUnit->project);

        return ( $functionalUnit ) ? $functionalUnit : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Unidad Funcional"},
            path="/api/functional-unit/forest-units/{id}",
            summary="Mostrar lista de individuos forestales de una UF",
            @OA\Parameter(
                name="id",
                in="path",
                description="id de la UF",
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
        $forestUnits = FunctionalUnit::find($id)->forest_units;
        return ( $forestUnits ) ? $forestUnits : response()->json(null, 204);
    }

    public function edit(FunctionalUnit $functionalUnit)
    {
        //
    }

    /**
        @OA\PUT(
            tags={"Unidad Funcional"},
            path="/api/functional-unit/{id}",
            summary="Registrar Unidad Funcional",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary Key) de la unidad funcional",
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
                            property="code",
                            description="Codigo de la unidad funcional",
                            example="UF1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo de UF (1: Licencia, 2: Compensación)",
                            example="1",
                            type="integer",
                            format="int32"
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

    public function update(Request $request, FunctionalUnit $functionalUnit)
    {
        $functionalUnit->code       = $request->code;
        $functionalUnit->type       = $request->type == 1 ? "Licencia" : "Compensación";
        $functionalUnit->project_id = $request->project_id;
        $functionalUnit->save();

        return response()->json(["message" => "¡Unidad funcional registrada!", "id" => $functionalUnit->id], 200);
    }

    public function destroy(FunctionalUnit $functionalUnit)
    {
        //
    }
}
