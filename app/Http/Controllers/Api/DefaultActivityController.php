<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DefaultActivity;
use App\Models\ActivityType;
use Illuminate\Http\Request;

class DefaultActivityController extends Controller
{
    /**
        @OA\Get(
            tags={"[Plantación] Actividad"},
            path="/api/default-activity",
            summary="Mostrar lista de actvidades",
            @OA\Response(
                response=200,
                description="Mostrar todos los actividades."
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
        $defaultActivities = [];
        foreach (DefaultActivity::all() as $defaultActivity)
        {
            $defaultActivities[] = $defaultActivity->setAttribute('activity_type', $defaultActivity->activity_type);
        }

        return ( $defaultActivities ) ? $defaultActivities : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Plantación] Actividad"},
            path="/api/default-activity",
            summary="Registrar Actividad",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre de la actividad",
                            example="Rocería",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="measuring_unit",
                            description="Unidad de la medida de la actividad",
                            example="m2",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="activity_type_id",
                            description="Id del tipo de actividad (1: Establecimiento, 2: Mantenimiento, 3: Civil)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Actividad registrada."
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
        $defaultActivity = new DefaultActivity;
        $defaultActivity->name             = $request->name;
        $defaultActivity->measuring_unit   = $request->measuring_unit;;
        $defaultActivity->activity_type_id = $request->activity_type_id;
        $defaultActivity->save();

        return response()->json(["message" => "¡Actividad registrada!", "id" => $defaultActivity->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Plantación] Actividad"},
            path="/api/default-activity/{id}",
            summary="Ver Actividades segun tipo",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del tipo (1: Establecimiento, 2: Mantenimiento, 3: Civil, 4: Plantación)",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los actividades."
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
        $defaultActivities = [];
        foreach (DefaultActivity::whereIn('activity_type_id', [$id, 4])->get() as $defaultActivity)
        {
            $defaultActivities[] = $defaultActivity->setAttribute('activity_type', $defaultActivity->activity_type);
        }

        return ( $defaultActivities ) ? $defaultActivities : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Plantación] Actividad"},
            path="/api/default-activity/{id}",
            summary="Editar Actividad",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary Key) de la Actividad",
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
                            description="Nombre de la actividad",
                            example="Rocería",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="measuring_unit",
                            description="Unidad de la medida de la actividad",
                            example="m2",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="activity_type_id",
                            description="Id del tipo de actividad (1: Establecimiento, 2: Mantenimiento, 3: Civil, 4: Plantación)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Actividad editada."
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

    public function update(Request $request, DefaultActivity $defaultActivity)
    {
        $defaultActivity->name             = $request->name;
        $defaultActivity->measuring_unit   = $request->measuring_unit;;
        $defaultActivity->activity_type_id = $request->activity_type_id;
        $defaultActivity->save();

        return response()->json(["message" => "¡Actividad registrada!", "id" => $defaultActivity->id], 200);
    }
}
