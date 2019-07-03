<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\HillsideRound;
use App\Exports\HillsideRoundsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class HillsideRoundController extends Controller
{
    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a la ladera"},
            path="/api/risks/hillside-round",
            summary="Mostrar lista de recorridos de ladera",
            @OA\Response(
                response=200,
                description="Mostrar todos los recorridos de ladera."
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
        $hillsideRounds = HillsideRound::all();
        return ( $hillsideRounds ) ? $hillsideRounds : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Riesgos] Recorrido de inspección a la ladera"},
            path="/api/risks/hillside-round",
            summary="Registrar recorrido de ladera",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo del recorrido de ladera (max 10ch)",
                            example="RL01",
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
                            property="landslides",
                            description="Deslizamientos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="ls_location",
                            description="Ubicación del deslizamiento",
                            example="En el metro 3 de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="ls_description",
                            description="Descripción del deslizamiento",
                            example="Se generó un deslizamiento",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="rockfall",
                            description="Caida de rocas (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="rf_location",
                            description="Ubicación de la caida de rocas",
                            example="Desde el metro 5 de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="rf_description",
                            description="Descripción de la caida de rocas",
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
                            example="Desde el metro 10 de la ladera",
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

        $hillsideRound = new HillsideRound;
        $hillsideRound->code             = $request->code;
        $hillsideRound->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $hillsideRound->landslides       = $this->getYesNo($request->landslides);
        $hillsideRound->ls_location      = $request->ls_location;
        $hillsideRound->ls_description   = $request->ls_description;
        $hillsideRound->rockfall         = $this->getYesNo($request->rockfall);
        $hillsideRound->rf_location      = $request->rf_location;
        $hillsideRound->rf_description   = $request->rf_description;
        $hillsideRound->noises           = $this->getYesNo($request->noises);
        $hillsideRound->ns_location      = $request->ns_location;
        $hillsideRound->ns_description   = $request->ns_description;
        $hillsideRound->level            = $request->level;
        $hillsideRound->responsible_name = $request->responsible_name;
        $hillsideRound->responsible_id   = $request->responsible_id;
        $hillsideRound->observations     = $request->observations;
        $hillsideRound->project_id       = $request->project_id;
        $hillsideRound->user_id          = $request->user_id;
        $hillsideRound->save();

        return response()->json(["message" => "¡Recorrido de ladera registrado correctamente!", "id" => $hillsideRound->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a la ladera"},
            path="/api/risks/hillside-round/{id}",
            summary="Lista de los recorridos de ladera de un proyecto",
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
        $hillsideRounds = HillsideRound::where('project_id', $id)->get();
        return ( $hillsideRounds ) ? $hillsideRounds : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Riesgos] Recorrido de inspección a la ladera"},
            path="/api/risks/hillside-round/{id}",
            summary="Editar recorrido de ladera",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del Recorrido de ladera",
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
                            description="Codigo del recorrido de ladera (max 10ch)",
                            example="RL01",
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
                            property="landslides",
                            description="Deslizamientos (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="ls_location",
                            description="Ubicación del deslizamiento",
                            example="En el metro 3 de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="ls_description",
                            description="Descripción del deslizamiento",
                            example="Se generó un deslizamiento",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="rockfall",
                            description="Caida de rocas (1: Si, 2: No)",
                            example="1",
                            type="number",
                            format="int32"
                        ),

                        @OA\Property(
                            property="rf_location",
                            description="Ubicación de la caida de rocas",
                            example="Desde el metro 5 de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="rf_description",
                            description="Descripción de la caida de rocas",
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
                            example="Desde el metro 10 de la ladera",
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
    public function update(Request $request, HillsideRound $hillsideRound)
    {
        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );

        $hillsideRound->code             = $request->code;
        $hillsideRound->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $hillsideRound->landslides       = $this->getYesNo($request->landslides);
        $hillsideRound->ls_location      = $request->ls_location;
        $hillsideRound->ls_description   = $request->ls_description;
        $hillsideRound->rockfall         = $this->getYesNo($request->rockfall);
        $hillsideRound->rf_location      = $request->rf_location;
        $hillsideRound->rf_description   = $request->rf_description;
        $hillsideRound->noises           = $this->getYesNo($request->noises);
        $hillsideRound->ns_location      = $request->ns_location;
        $hillsideRound->ns_description   = $request->ns_description;
        $hillsideRound->level            = $request->level;
        $hillsideRound->responsible_name = $request->responsible_name;
        $hillsideRound->responsible_id   = $request->responsible_id;
        $hillsideRound->observations     = $request->observations;
        $hillsideRound->project_id       = $request->project_id;
        $hillsideRound->user_id          = $request->user_id;
        $hillsideRound->save();

        return response()->json(["message" => "¡Recorrido de ladera editado correctamente!", "id" => $hillsideRound->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Recorrido de inspección a la ladera"},
            path="/api/risks/hillside-round/export/{id}",
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
        return Excel::download(new HillsideRoundsExport($id), $project->name . ' - Recorridos de ladera.xls');
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
