<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Precipitation;
use App\Exports\PrecipitationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PrecipitationController extends Controller
{
    /**
        @OA\Get(
            tags={"[Riesgos] Precipitación"},
            path="/api/risks/precipitation",
            summary="Mostrar lista de precipitaciones",
            @OA\Response(
                response=200,
                description="Mostrar todas las precipitaciones."
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
        $precipitations = Precipitation::all();
        return ( $precipitations ) ? $precipitations : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Riesgos] Precipitación"},
            path="/api/risks/precipitation",
            summary="Registrar precipitación",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo de la precipitación (max 10ch)",
                            example="PR01",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Llovizna, 2: Lluviam, 3: Lluvia Torrencial, 4: Tormenta)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="mm_hours",
                            description="milimetros / hora",
                            example="10.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="start",
                            description="Fecha y hora del inicio de la precipitación (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 22:46",
                            type="string",
                            format="date-time"
                        ),

                         @OA\Property(
                            property="finish",
                            description="Fecha y hora del final de la precipitación (YYYY-MM-DD hh:mm)",
                            example="2019-05-27 00:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="level",
                            description="Nivel de emergencia (Se mide de 1 a 5)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="responsible_name",
                            description="Nombre del responsable",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="responsible_id",
                            description="Identificacion del responsable",
                            example="123456789",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="observations",
                            description="Observaciones",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="project_id",
                            description="Id del proyecto",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="user_id",
                            description="Id del usuario logueado",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Cliente registrada."
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
        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );

        $precipitation = new Precipitation;
        $precipitation->code             = $request->code;
        $precipitation->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $precipitation->type             = $this->getType($request->type);
        $precipitation->mm_hours         = $request->mm_hours;
        $precipitation->start            = date('Y-m-d H:i', strtotime($request->start));
        $precipitation->finish           = date('Y-m-d H:i', strtotime($request->finish));
        $precipitation->level            = $request->level;
        $precipitation->responsible_name = $request->responsible_name;
        $precipitation->responsible_id   = $request->responsible_id;
        $precipitation->observations     = $request->observations;
        $precipitation->project_id       = $request->project_id;
        $precipitation->user_id          = $request->user_id;
        $precipitation->save();

        return response()->json(["message" => "¡Precipitación registrada correctamente!", "id" => $precipitation->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Precipitación"},
            path="/api/risks/precipitation/{id}",
            summary="Lista de las precipitaciones de un proyecto",
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
    public function show($id)
    {
        $precipitations = Precipitation::where('project_id', $id)->get();
        return ( $precipitations ) ? $precipitations : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Riesgos] Precipitación"},
            path="/api/risks/precipitation/{id}",
            summary="Editar precipitación",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) de la Precipitación",
                @OA\Schema(type="string")
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
                            description="Codigo de la precipitación (max 10ch)",
                            example="PR01",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Llovizna, 2: Lluviam, 3: Lluvia Torrencial, 4: Tormenta)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="mm_hours",
                            description="milimetros / hora",
                            example="10.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="start",
                            description="Fecha y hora del inicio de la precipitación (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 22:46",
                            type="string",
                            format="date-time"
                        ),

                         @OA\Property(
                            property="finish",
                            description="Fecha y hora del final de la precipitación (YYYY-MM-DD hh:mm)",
                            example="2019-05-27 00:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="level",
                            description="Nivel de emergencia (Se mide de 1 a 5)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="responsible_name",
                            description="Nombre del responsable",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="responsible_id",
                            description="Identificacion del responsable",
                            example="123456789",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="observations",
                            description="Observaciones",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="project_id",
                            description="Id del proyecto",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="user_id",
                            description="Id del usuario logueado",
                            example="1",
                            type="integer",
                            format="int32"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Cliente registrada."
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
    public function update(Request $request, Precipitation $precipitation)
    {
        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );

        $precipitation->code             = $request->code;
        $precipitation->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $precipitation->type             = $this->getType($request->type);
        $precipitation->mm_hours         = $request->mm_hours;
        $precipitation->start            = date('Y-m-d H:i', strtotime($request->start));
        $precipitation->finish           = date('Y-m-d H:i', strtotime($request->finish));
        $precipitation->level            = $request->level;
        $precipitation->responsible_name = $request->responsible_name;
        $precipitation->responsible_id   = $request->responsible_id;
        $precipitation->observations     = $request->observations;
        $precipitation->project_id       = $request->project_id;
        $precipitation->user_id          = $request->user_id;
        $precipitation->save();

        return response()->json(["message" => "¡Precipitación editada correctamente!", "id" => $precipitation->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Precipitación"},
            path="/api/risks/precipitation/export/{id}",
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
        $project = Project::find($id);
        return Excel::download(new PrecipitationsExport($id), $project->name . ' - Precipitationes.xls');
    }

    public function validateLevel($level)
    {
        if ($level >= 1 && $level <= 5) return true;
        return false;
    }

    public function getType($type)
    {
        switch ($type) {
            case 1:
                return "Llovizna";
            case 2:
                return "Lluvia";
            case 3:
                return "Lluvia Torrencial";
            case 4:
                return "Tormenta";
            default:
                return null;
        }
    }
}
