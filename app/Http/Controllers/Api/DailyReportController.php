<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use App\Models\ReportActivity;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    /**
        @OA\Get(
            tags={"[Plant & Civil] Reporte diario"},
            path="/api/daily-report",
            summary="Mostrar lista de reportes diarios",
            @OA\Response(
                response=200,
                description="Mostrar todos los reportes."
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
        foreach (DailyReport::all() as $dailyReport)
        {
            $dailyReport->setAttribute('project', $dailyReport->project);
            $dailyReport->setAttribute('activities', $dailyReport->default_activities);
            $dailyReports[] = $dailyReport;
        }

        return ( $dailyReports ) ? $dailyReports : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Plant & Civil] Reporte diario"},
            path="/api/daily-report",
            summary="Registrar Reporte diario",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="responsible",
                            description="Responsable del reporte diario",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="field_assistant",
                            description="Auxiliar de campo",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Sitio",
                            example="Huerta N1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha del reporte (YYYY-MM-DD)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="people_number",
                            description="Numero de personas en campo",
                            example="10",
                            type="integer",
                            format="integer"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Establecimiento, 2: Mantenimiento)",
                            example="2",
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

                        @OA\Property(
                            property="activities",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="default_activity_id",
                                    type="string",
                                    description="Id de la actividad",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="hours",
                                    type="integer",
                                    description="Cantidad de horas",
                                    example="5"
                                ),
                                @OA\Property(
                                    property="quantity",
                                    type="integer",
                                    description="Cantidad de unidad de medida",
                                    example="20"
                                ),
                            ),
                            description="Lista de actividades"
                        ),
                    )
                ),
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="responsible",
                            description="Responsable del reporte diario",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="field_assistant",
                            description="Auxiliar de campo",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Sitio",
                            example="Huerta N1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha del reporte (YYYY-MM-DD)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="people_number",
                            description="Numero de personas en campo",
                            example="10",
                            type="integer",
                            format="integer"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Establecimiento, 2: Mantenimiento)",
                            example="2",
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

                        @OA\Property(
                            property="activities",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="default_activity_id",
                                    type="string",
                                    description="Id de la actividad",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="hours",
                                    type="integer",
                                    description="Cantidad de horas",
                                    example="5"
                                ),
                                @OA\Property(
                                    property="quantity",
                                    type="integer",
                                    description="Cantidad de unidad de medida",
                                    example="20"
                                ),
                            ),
                            description="Lista de actividades"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Reporte registrado."
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
        $dailyReport = new DailyReport;
        $dailyReport->responsible     = $request->responsible;
        $dailyReport->field_assistant = $request->field_assistant;
        $dailyReport->location        = $request->location;
        $dailyReport->report_date     = date('Y-m-d H:i', strtotime($request->report_date));
        $dailyReport->people_number   = $request->code;
        $dailyReport->type            = $request->type;
        $dailyReport->project_id      = $request->project_id;
        $dailyReport->save();

        foreach ($request->activities as $activity)
        {
            $newActivity = new ReportActivity;

            $newActivity->default_activity_id = $activity['default_activity_id'];
            $newActivity->hours               = $activity['hours'];
            $newActivity->quantity            = $activity['quantity'];
            $newActivity->daily_report_id     = $dailyReport->id;
            $newActivity->save();
        }

        return response()->json(["message" => "¡Reporte diario registrado!", "id" => $dailyReport->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Plant & Civil] Reporte diario"},
            path="/api/daily-report/{id}",
            summary="Ver reporte diario",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del reporte",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los reportes."
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

    public function show(DailyReport $dailyReport)
    {
        $dailyReport->setAttribute('project', $dailyReport->project);
        $dailyReport->setAttribute('activities', $dailyReport->default_activities);

        return ( $dailyReport ) ? $dailyReport : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"[Plant & Civil] Reporte diario"},
            path="/api/daily-report/project/{id}",
            summary="Ver reportes diarios de un proyecto",
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
                description="Mostrar todos los reportes."
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

    public function showByProject($id)
    {
        $dailyReports = [];
        foreach (DailyReport::where('project_id', $id)->get() as $dailyReport)
        {
            $dailyReport->setAttribute('project', $dailyReport->project);
            $dailyReport->setAttribute('report_activities', $dailyReport->report_activities);
            $dailyReports[] = $dailyReport;
        }

        return ( $dailyReports ) ? $dailyReports : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Plant & Civil] Reporte diario"},
            path="/api/daily-report/{id}",
            summary="Editar Reporte diario",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary Key) del Reporte diario",
                @OA\Schema(type="integer")
            ),

            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="responsible",
                            description="Responsable del reporte diario",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="field_assistant",
                            description="Auxiliar de campo",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Sitio",
                            example="Huerta N1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha del reporte (YYYY-MM-DD)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="people_number",
                            description="Numero de personas en campo",
                            example="10",
                            type="integer",
                            format="integer"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Establecimiento, 2: Mantenimiento)",
                            example="2",
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

                        @OA\Property(
                            property="activities",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="default_activity_id",
                                    type="string",
                                    description="Id de la actividad",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="hours",
                                    type="integer",
                                    description="Cantidad de horas",
                                    example="5"
                                ),
                                @OA\Property(
                                    property="quantity",
                                    type="integer",
                                    description="Cantidad de unidad de medida",
                                    example="20"
                                ),
                            ),
                            description="Lista de actividades"
                        ),
                    )
                ),
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="responsible",
                            description="Responsable del reporte diario",
                            example="Marlon Gamba",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="field_assistant",
                            description="Auxiliar de campo",
                            example="Pedro Alarcon",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="location",
                            description="Sitio",
                            example="Huerta N1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="report_date",
                            description="Fecha del reporte (YYYY-MM-DD)",
                            example="2019-05-26 13:45",
                            type="string",
                            format="date-time"
                        ),

                        @OA\Property(
                            property="people_number",
                            description="Numero de personas en campo",
                            example="10",
                            type="integer",
                            format="integer"
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo (1: Establecimiento, 2: Mantenimiento)",
                            example="2",
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

                        @OA\Property(
                            property="activities",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="default_activity_id",
                                    type="string",
                                    description="Id de la actividad",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="hours",
                                    type="integer",
                                    description="Cantidad de horas",
                                    example="5"
                                ),
                                @OA\Property(
                                    property="quantity",
                                    type="integer",
                                    description="Cantidad de unidad de medida",
                                    example="20"
                                ),
                            ),
                            description="Lista de actividades"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Reporte registrado."
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

    public function update(Request $request, DailyReport $dailyReport)
    {
        $dailyReport->responsible     = $request->responsible;
        $dailyReport->field_assistant = $request->field_assistant;
        $dailyReport->location        = $request->location;
        $dailyReport->report_date     = date('Y-m-d H:i', strtotime($request->report_date));
        $dailyReport->people_number   = $request->code;
        $dailyReport->type            = $request->type;
        $dailyReport->project_id      = $request->project_id;

        if (isset($request->assistants))
        {
            ReportActivity::where('daily_report_id', $dailyReport->id)->delete();
            foreach ($request->activities as $activity)
            {
                $newActivity = new ReportActivity;

                $newActivity->default_activity_id = $activity['default_activity_id'];
                $newActivity->hours               = $activity['hours'];
                $newActivity->quantity            = $activity['quantity'];
                $newActivity->daily_report_id     = $dailyReport->id;
                $newActivity->save();
            }
        }

        return response()->json(["message" => "¡Reporte diario editado!", "id" => $dailyReport->id], 200);
    }
}
