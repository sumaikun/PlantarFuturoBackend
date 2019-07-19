<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Contractor;
use App\Models\Project;
use App\Models\ReportVisitor;
use App\Models\SSTReport;
use App\Models\User;
//use App\Exports\SSTReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SSTReportController extends Controller
{
    /**
        @OA\Get(
            tags={"[SST] Informe SST"},
            path="/api/sst",
            summary="Mostrar lista de informes sst",
            @OA\Response(
                response=200,
                description="Mostrar todos los informes sst."
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
        foreach (SSTReport::all() as $SSTReport)
        {
            $SSTReports[] = $SSTReport->setAttribute('project', $SSTReport->project);
        }

        return ( $SSTReports ) ? $SSTReports : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[SST] Informe SST"},
            path="/api/sst",
            summary="Registrar informe SST",

            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="date",
                        ),

                        @OA\Property(
                            property="location",
                            description="Lugar del reporte",
                            example="Proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="goal",
                            description="objetivo",
                            example="Llevar a cabo exitosamente la primera fase del proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Marlon Gamba",
                            type="string",
                        ),

                        @OA\Property(
                            property="notes",
                            description="Comentarios",
                            example="N/A",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img1",
                            description="Foto de avance 1",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img2",
                            description="Foto de avance 2",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img3",
                            description="Foto de avance 3",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img4",
                            description="Foto de avance 4",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),

                        @OA\Property(
                            property="assistants",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="assistance",
                                    type="boolean",
                                    description="Asistencia (1: Si, 0: No)",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="checkin",
                                    type="string",
                                    description="Hora de entrada (hh:mm)",
                                    example="09:05"
                                ),
                                @OA\Property(
                                    property="checkout",
                                    type="string",
                                    description="Hora de salida (hh:mm)",
                                    example="18:15"
                                ),
                                @OA\Property(
                                    property="reason",
                                    type="string",
                                    description="Motivo de ausencia",
                                    example="El trabajador no pudo llegar a trabajar por paro"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios",
                                    example="El trabajador aunque cumplio el horario, se tomo 30 minutos extra de almuerzo sin avisar"
                                ),
                                @OA\Property(
                                    property="contractor_id",
                                    type="integer",
                                    description="Id del usuario",
                                    example="2"
                                ),
                            ),
                            description="Lista de asistencia"
                        ),

                        @OA\Property(
                            property="visitors",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="visitor_id",
                                    type="integer",
                                    description="Id del Visitante",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios de la visita",
                                    example="El supervisor del ANLA estuvo revisando los avances del proyecto"
                                ),
                            ),
                            description="Lista de visitantes"
                        ),
                    )
                ),
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="date",
                        ),

                        @OA\Property(
                            property="location",
                            description="Lugar del reporte",
                            example="Proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="goal",
                            description="objetivo",
                            example="Llevar a cabo exitosamente la primera fase del proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Marlon Gamba",
                            type="string",
                        ),

                        @OA\Property(
                            property="notes",
                            description="Comentarios",
                            example="N/A",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img1",
                            description="Foto de avance 1",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img2",
                            description="Foto de avance 2",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img3",
                            description="Foto de avance 3",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img4",
                            description="Foto de avance 4",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),

                        @OA\Property(
                            property="assistants",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="assistance",
                                    type="boolean",
                                    description="Asistencia (1: Si, 0: No)",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="checkin",
                                    type="string",
                                    description="Hora de entrada (hh:mm)",
                                    example="09:05"
                                ),
                                @OA\Property(
                                    property="checkout",
                                    type="string",
                                    description="Hora de salida (hh:mm)",
                                    example="18:15"
                                ),
                                @OA\Property(
                                    property="reason",
                                    type="string",
                                    description="Motivo de ausencia",
                                    example="El trabajador no pudo llegar a trabajar por paro"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios",
                                    example="El trabajador aunque cumplio el horario, se tomo 30 minutos extra de almuerzo sin avisar"
                                ),
                                @OA\Property(
                                    property="contractor_id",
                                    type="integer",
                                    description="Id del usuario",
                                    example="2"
                                ),
                            ),
                            description="Lista de asistencia"
                        ),

                        @OA\Property(
                            property="visitors",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="visitor_id",
                                    type="integer",
                                    description="Id del Visitante",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios de la visita",
                                    example="El supervisor del ANLA estuvo revisando los avances del proyecto"
                                ),
                            ),
                            description="Lista de visitantes"
                        ),
                    )
                ),
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
        $SSTReport = new SSTReport;
        $SSTReport->report_date   = date('Y-m-d H:i', strtotime($request->report_date));
        $SSTReport->location      = $request->location;
        $SSTReport->goal          = $request->goal;
        $SSTReport->responsible   = $request->responsible;
        $SSTReport->notes         = $request->notes;
        $SSTReport->progress_img1 = $request->progress_img1;
        $SSTReport->progress_img2 = $request->progress_img2;
        $SSTReport->progress_img3 = $request->progress_img3;
        $SSTReport->progress_img4 = $request->progress_img4;
        $SSTReport->project_id    = $request->project_id;
        $SSTReport->save();

        foreach ($request->assistants as $assistant)
        {
            $newAssistant = new Assistant;

            $newAssistant->assistance    = $assistant['assistance'];
            $newAssistant->checkin       = date('H:i', strtotime($assistant['checkin']));
            $newAssistant->checkout      = date('H:i', strtotime($assistant['checkout']));
            $newAssistant->reason        = $assistant['reason'];
            $newAssistant->notes         = $assistant['notes'];
            $newAssistant->contractor_id = $assistant['contractor_id'];
            $newAssistant->sst_report_id = $SSTReport->id;
            $newAssistant->save();
        }

        foreach ($request->visitors as $visitor)
        {
            $reportVisitor = new ReportVisitor;

            $reportVisitor->notes         = $visitor['notes'];
            $reportVisitor->visitor_id    = $visitor['visitor_id'];
            $reportVisitor->sst_report_id = $SSTReport->id;
            $reportVisitor->save();
        }

        return response()->json(["message" => "¡Informe SST registrado correctamente!", "id" => $SSTReport->id], 200);
    }

    /**
        @OA\Get(
            tags={"[SST] Informe SST"},
            path="/api/sst/{id}",
            summary="Lista de los informes sst de un proyecto",
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
        foreach (SSTReport::where('project_id', $id)->get() as $SSTReport)
        {
            $SSTReports[] = $SSTReport->setAttribute('project', $SSTReport->project);
        }
        return ( $SSTReports ) ? $SSTReports : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"[SST] Informe SST"},
            path="/api/sst/assistants/{id}",
            summary="Lista de los asistentes del informe SST",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del informe SST",
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
    public function listAssistants($id)
    {
        $assistants = SSTReport::find($id)->assistants;
        return ( $assistants ) ? $assistants : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"[SST] Informe SST"},
            path="/api/sst/visitors/{id}",
            summary="Lista de los visitantes del informe SST",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del informe SST",
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
    public function listVisitors($id)
    {
        $visitors = SSTReport::find($id)->report_visitors;
        return ( $visitors ) ? $visitors : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[SST] Informe SST"},
            path="/api/sst/{id}",
            summary="Editar informe SST",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del Informe SST",
                @OA\Schema(type="string")
            ),
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="date",
                        ),

                        @OA\Property(
                            property="location",
                            description="Lugar del reporte",
                            example="Proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="goal",
                            description="objetivo",
                            example="Llevar a cabo exitosamente la primera fase del proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Marlon Gamba",
                            type="string",
                        ),

                        @OA\Property(
                            property="notes",
                            description="Comentarios",
                            example="N/A",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img1",
                            description="Foto de avance 1",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img2",
                            description="Foto de avance 2",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img3",
                            description="Foto de avance 3",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img4",
                            description="Foto de avance 4",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),

                        @OA\Property(
                            property="assistants",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="assistance",
                                    type="boolean",
                                    description="Asistencia (1: Si, 0: No)",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="checkin",
                                    type="string",
                                    description="Hora de entrada (hh:mm)",
                                    example="09:05"
                                ),
                                @OA\Property(
                                    property="checkout",
                                    type="string",
                                    description="Hora de salida (hh:mm)",
                                    example="18:15"
                                ),
                                @OA\Property(
                                    property="reason",
                                    type="string",
                                    description="Motivo de ausencia",
                                    example="El trabajador no pudo llegar a trabajar por paro"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios",
                                    example="El trabajador aunque cumplio el horario, se tomo 30 minutos extra de almuerzo sin avisar"
                                ),
                                @OA\Property(
                                    property="contractor_id",
                                    type="integer",
                                    description="Id del detalle entre proyecto y usuario (Contractor)",
                                    example="2"
                                ),
                            ),
                            description="Lista de asistencia"
                        ),

                        @OA\Property(
                            property="visitors",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="visitor_id",
                                    type="integer",
                                    description="Id del Visitante",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios de la visita",
                                    example="El supervisor del ANLA estuvo revisando los avances del proyecto"
                                ),
                            ),
                            description="Lista de visitantes"
                        ),
                    )
                ),
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        @OA\Property(
                            property="report_date",
                            description="Fecha y hora del reporte (YYYY-MM-DD hh:mm)",
                            example="2019-05-26 13:45",
                            type="date",
                        ),

                        @OA\Property(
                            property="location",
                            description="Lugar del reporte",
                            example="Proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="goal",
                            description="objetivo",
                            example="Llevar a cabo exitosamente la primera fase del proyecto X",
                            type="string",
                        ),

                        @OA\Property(
                            property="responsible",
                            description="Responsable",
                            example="Marlon Gamba",
                            type="string",
                        ),

                        @OA\Property(
                            property="notes",
                            description="Comentarios",
                            example="N/A",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img1",
                            description="Foto de avance 1",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img2",
                            description="Foto de avance 2",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img3",
                            description="Foto de avance 3",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="progress_img4",
                            description="Foto de avance 4",
                            example="",
                            type="string",
                        ),

                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),

                        @OA\Property(
                            property="assistants",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="assistance",
                                    type="boolean",
                                    description="Asistencia (1: Si, 0: No)",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="checkin",
                                    type="string",
                                    description="Hora de entrada (hh:mm)",
                                    example="09:05"
                                ),
                                @OA\Property(
                                    property="checkout",
                                    type="string",
                                    description="Hora de salida (hh:mm)",
                                    example="18:15"
                                ),
                                @OA\Property(
                                    property="reason",
                                    type="string",
                                    description="Motivo de ausencia",
                                    example="El trabajador no pudo llegar a trabajar por paro"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios",
                                    example="El trabajador aunque cumplio el horario, se tomo 30 minutos extra de almuerzo sin avisar"
                                ),
                                @OA\Property(
                                    property="contractor_id",
                                    type="integer",
                                    description="Id del detalle entre proyecto y usuario (Contractor)",
                                    example="2"
                                ),
                            ),
                            description="Lista de asistencia"
                        ),

                        @OA\Property(
                            property="visitors",
                            type="array",
                            @OA\Items(
                                @OA\Property(
                                    property="visitor_id",
                                    type="integer",
                                    description="Id del Visitante",
                                    example="1"
                                ),
                                @OA\Property(
                                    property="notes",
                                    type="string",
                                    description="Comentarios de la visita",
                                    example="El supervisor del ANLA estuvo revisando los avances del proyecto"
                                ),
                            ),
                            description="Lista de visitantes"
                        ),
                    )
                ),
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
    public function update(Request $request, $id)
    {
        $SSTReport = SSTReport::find($id);
        $SSTReport->report_date   = date('Y-m-d H:i', strtotime($request->report_date));
        $SSTReport->location      = $request->location;
        $SSTReport->goal          = $request->goal;
        $SSTReport->responsible   = $request->responsible;
        $SSTReport->notes         = $request->notes;
        $SSTReport->progress_img1 = $request->progress_img1;
        $SSTReport->progress_img2 = $request->progress_img2;
        $SSTReport->progress_img3 = $request->progress_img3;
        $SSTReport->progress_img4 = $request->progress_img4;
        $SSTReport->project_id    = $request->project_id;
        $SSTReport->save();

        if (isset($request->assistants))
        {
            Assistant::where('sst_report_id', $SSTReport->id)->delete();
            foreach ($request->assistants as $assistant)
            {
                $newAssistant = new Assistant;

                $newAssistant->assistance    = $assistant['assistance'];
                $newAssistant->checkin       = date('H:i', strtotime($assistant['checkin']));
                $newAssistant->checkout      = date('H:i', strtotime($assistant['checkout']));
                $newAssistant->reason        = $assistant['reason'];
                $newAssistant->notes         = $assistant['notes'];
                $newAssistant->contractor_id = $assistant['contractor_id'];
                $newAssistant->sst_report_id = $SSTReport->id;
                $newAssistant->save();
            }
        }

        if (isset($request->visitors))
        {
            ReportVisitor::where('sst_report_id', $SSTReport->id)->delete();
            foreach ($request->visitors as $visitor)
            {
                $reportVisitor = new ReportVisitor;

                $reportVisitor->notes         = $visitor['notes'];
                $reportVisitor->visitor_id    = $visitor['visitor_id'];
                $reportVisitor->sst_report_id = $SSTReport->id;
                $reportVisitor->save();
            }
        }

        return response()->json(["message" => "¡Informe SST editado correctamente!", "id" => $SSTReport->id], 200);
    }

    /**
        @OA\Get(
            tags={"[SST] Informe SST"},
            path="/api/sst/export/{id}",
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
        //$project = Project::find($id);
        //return Excel::download(new SSTReportsExport($id), $project->name . ' - informes sst.xls');
    }
}