<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\DryRavineRound;
use App\Exports\DryRavineRoundsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DryRavineRoundController extends Controller
{
    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a quebrada seca"},
            path="/api/risks/dryravine-round",
            summary="Mostrar lista de recorridos de quebrada",
            @OA\Response(
                response=200,
                description="Mostrar todos los recorridos de quebrada."
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
        $dryRavineRounds = DryRavineRound::all();
        return ( $dryRavineRounds ) ? $dryRavineRounds : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Riesgos] Recorrido de inspección a quebrada seca"},
            path="/api/risks/dryravine-round",
            summary="Registrar recorrido de quebrada",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo del recorrido de quebrada (max 10ch)",
                            example="RQ01",
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
                            property="waterdam",
                            description="Represamientos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="wd_location",
                            description="Ubicación del represamiento",
                            example="En el metro 3 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="wd_description",
                            description="Descripción del represamiento",
                            example="Se generó un represamiento",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="materialdrag",
                            description="Arrastre de material (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="md_location",
                            description="Ubicación de la arrastre de material",
                            example="Desde el metro 5 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="md_description",
                            description="Descripción de la arrastre de material",
                            example="Se arrastro material de construccion",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="noises",
                            description="Presencia de ruidos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="ns_location",
                            description="Ubicación de la presencia de ruidos",
                            example="Desde el metro 10 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="ns_description",
                            description="Descripción de la presencia de ruidos",
                            example="Un ruido estruendoso",
                            type="string",
                            format="string"
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

        $dryRavineRound = new DryRavineRound;
        $dryRavineRound->code             = $request->code;
        $dryRavineRound->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $dryRavineRound->waterdam         = $this->getYesNo($request->waterdam);
        $dryRavineRound->wd_location      = $request->wd_location;
        $dryRavineRound->wd_description   = $request->wd_description;
        $dryRavineRound->materialdrag     = $this->getYesNo($request->materialdrag);
        $dryRavineRound->md_location      = $request->md_location;
        $dryRavineRound->md_description   = $request->md_description;
        $dryRavineRound->noises           = $this->getYesNo($request->noises);
        $dryRavineRound->ns_location      = $request->ns_location;
        $dryRavineRound->ns_description   = $request->ns_description;
        $dryRavineRound->level            = $request->level;
        $dryRavineRound->responsible_name = $request->responsible_name;
        $dryRavineRound->responsible_id   = $request->responsible_id;
        $dryRavineRound->observations     = $request->observations;
        $dryRavineRound->project_id       = $request->project_id;
        $dryRavineRound->user_id          = $request->user_id;
        $dryRavineRound->save();

        return response()->json(["message" => "¡Recorrido de quebrada registrado correctamente!", "id" => $dryRavineRound->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a quebrada seca"},
            path="/api/risks/dryravine-round/{id}",
            summary="Lista de los recorridos de quebrada de un proyecto",
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
        $dryRavineRounds = DryRavineRound::where('project_id', $id)->get();
        return ( $dryRavineRounds ) ? $dryRavineRounds : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Riesgos] Recorrido de inspección a quebrada seca"},
            path="/api/risks/dryravine-round/{id}",
            summary="Editar recorrido de quebrada",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del Recorrido de quebrada",
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
                            description="Codigo del recorrido de quebrada (max 10ch)",
                            example="RQ01",
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
                            property="waterdam",
                            description="Represamientos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="wd_location",
                            description="Ubicación del represamiento",
                            example="En el metro 3 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="wd_description",
                            description="Descripción del represamiento",
                            example="Se generó un represamiento",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="materialdrag",
                            description="Arrastre de material (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="md_location",
                            description="Ubicación de la arrastre de material",
                            example="Desde el metro 5 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="md_description",
                            description="Descripción de la arrastre de material",
                            example="Se cayeron 5 rocas",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="noises",
                            description="Presencia de ruidos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="ns_location",
                            description="Ubicación de la presencia de ruidos",
                            example="Desde el metro 10 de la quebrada",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="ns_description",
                            description="Descripción de la presencia de ruidos",
                            example="Un ruido estruendoso",
                            type="string",
                            format="string"
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
    public function update(Request $request, $id)
    {

        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );
        $dryRavineRound = DryRavineRound::find($id);
        $dryRavineRound->code             = $request->code;
        $dryRavineRound->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $dryRavineRound->waterdam         = $this->getYesNo($request->waterdam);
        $dryRavineRound->wd_location      = $request->wd_location;
        $dryRavineRound->wd_description   = $request->wd_description;
        $dryRavineRound->materialdrag     = $this->getYesNo($request->materialdrag);
        $dryRavineRound->md_location      = $request->md_location;
        $dryRavineRound->md_description   = $request->md_description;
        $dryRavineRound->noises           = $this->getYesNo($request->noises);
        $dryRavineRound->ns_location      = $request->ns_location;
        $dryRavineRound->ns_description   = $request->ns_description;
        $dryRavineRound->level            = $request->level;
        $dryRavineRound->responsible_name = $request->responsible_name;
        $dryRavineRound->responsible_id   = $request->responsible_id;
        $dryRavineRound->observations     = $request->observations;
        $dryRavineRound->project_id       = $request->project_id;
        $dryRavineRound->user_id          = $request->user_id;
        $dryRavineRound->save();

        return response()->json(["message" => "¡Recorrido de quebrada editado correctamente!", "id" => $dryRavineRound->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a quebrada seca"},
            path="/api/risks/dryravine-round/export/{id}",
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
        return Excel::download(new DryRavineRoundsExport($id), $project->name . ' - Recorridos de quebrada.xls');
    }

    public function validateLevel($level)
    {
        if ($level >= 1 && $level <= 5) return true;
        return false;
    }

    public function getYesNo($bool)
    {
        switch ($bool) {
            case 1:
                return "Si";
            case 2:
                return "No";
            default:
                return null;
        }
    }
}