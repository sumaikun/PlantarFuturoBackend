<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\HillsideDisplacement;
use App\Exports\HillsideDisplacementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class HillsideDisplacementController extends Controller
{
    /**
        @OA\Get(
            tags={"[Riesgos] Desplazamientos de ladera"},
            path="/api/risks/hillside-displacement",
            summary="Mostrar lista de desplazamiento de ladera",
            @OA\Response(
                response=200,
                description="Mostrar todos los desplazamiento de ladera."
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
        $hillsideDisplacements = HillsideDisplacement::all();
        return ( $hillsideDisplacements ) ? $hillsideDisplacements : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Riesgos] Desplazamientos de ladera"},
            path="/api/risks/hillside-displacement",
            summary="Registrar desplazamiento de ladera",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo del desplazamiento de ladera (max 10ch)",
                            example="DL01",
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
                            property="longitude",
                            description="Longitud de la grieta (medido en mm)",
                            example="10.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="width",
                            description="Ancho de la grieta (Medido en mm)",
                            example="3.5",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="new",
                            description="Grieta (1: Nueva, 2: Existente)",
                            example="1",
                            type="boolean",
                            format="boolean"
                        ),

                        @OA\Property(
                            property="location",
                            description="Ubicacion de la grieta",
                            example="En el metro 25 del inicio de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="description",
                            description="Descripcion",
                            example="N/A",
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

        $hillsideDisplacement = new HillsideDisplacement;
        $hillsideDisplacement->code             = $request->code;
        $hillsideDisplacement->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $hillsideDisplacement->longitude        = $request->longitude;
        $hillsideDisplacement->width            = $request->width;
        $hillsideDisplacement->new              = $this->getRift($request->new);
        $hillsideDisplacement->location         = $request->location;
        $hillsideDisplacement->description      = $request->description;
        $hillsideDisplacement->level            = $request->level;
        $hillsideDisplacement->responsible_name = $request->responsible_name;
        $hillsideDisplacement->responsible_id   = $request->responsible_id;
        $hillsideDisplacement->observations     = $request->observations;
        $hillsideDisplacement->project_id       = $request->project_id;
        $hillsideDisplacement->user_id          = $request->user_id;
        $hillsideDisplacement->save();

        return response()->json(["message" => "¡Desplazamiento de ladera registrada correctamente!", "id" => $hillsideDisplacement->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Desplazamientos de ladera"},
            path="/api/risks/hillside-displacement/{id}",
            summary="Lista de las desplazamiento de ladera de un proyecto",
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
        $hillsideDisplacements = HillsideDisplacement::where('project_id', $id)->get();
        return ( $hillsideDisplacements ) ? $hillsideDisplacements : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Riesgos] Desplazamientos de ladera"},
            path="/api/risks/hillside-displacement/{id}",
            summary="Editar desplazamiento de ladera",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) de la Desplazamiento de ladera",
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
                            description="Codigo del desplazamiento de ladera (max 10ch)",
                            example="DL01",
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
                            property="longitude",
                            description="Longitud de la grieta (medido en mm)",
                            example="10.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="width",
                            description="Ancho de la grieta (Medido en mm)",
                            example="3.5",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="new",
                            description="Grieta (1: Nueva, 2: Existente)",
                            example="1",
                            type="boolean",
                            format="boolean"
                        ),

                        @OA\Property(
                            property="location",
                            description="Ubicacion de la grieta",
                            example="En el metro 25 del inicio de la ladera",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="description",
                            description="Descripcion",
                            example="N/A",
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
    public function update(Request $request, HillsideDisplacement $hillsideDisplacement)
    {
        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );

        $hillsideDisplacement->code             = $request->code;
        $hillsideDisplacement->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $hillsideDisplacement->longitude        = $request->longitude;
        $hillsideDisplacement->width            = $request->width;
        $hillsideDisplacement->new              = $request->new;
        $hillsideDisplacement->location         = $request->location;
        $hillsideDisplacement->description      = $request->description;
        $hillsideDisplacement->level            = $request->level;
        $hillsideDisplacement->responsible_name = $request->responsible_name;
        $hillsideDisplacement->responsible_id   = $request->responsible_id;
        $hillsideDisplacement->observations     = $request->observations;
        $hillsideDisplacement->project_id       = $request->project_id;
        $hillsideDisplacement->user_id          = $request->user_id;
        $hillsideDisplacement->save();

        return response()->json(["message" => "¡Desplazamiento de ladera editada correctamente!", "id" => $hillsideDisplacement->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Desplazamientos de ladera"},
            path="/api/risks/hillside-displacement/export/{id}",
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
        return Excel::download(new HillsideDisplacementsExport($id), 'Desplazamientos de ladera -' . $project->name . '.xls');
    }

    public function validateLevel($level)
    {
        if ($level >= 1 && $level <= 5) return true;
        return false;
    }

    public function getRift($new)
    {
        switch ($new) {
            case 1:
                return "Nueva";
            case 2:
                return "Existente";
            default:
                return null;
        }
    }
}
