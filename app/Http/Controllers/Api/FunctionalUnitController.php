<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FunctionalUnit;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://localhost:8000")
*/

class FunctionalUnitController extends Controller
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

    public function show(FunctionalUnit $functionalUnit)
    {
        //
    }

    public function edit(FunctionalUnit $functionalUnit)
    {
        //
    }

    public function update(Request $request, FunctionalUnit $functionalUnit)
    {
        //
    }

    public function destroy(FunctionalUnit $functionalUnit)
    {
        //
    }
}
