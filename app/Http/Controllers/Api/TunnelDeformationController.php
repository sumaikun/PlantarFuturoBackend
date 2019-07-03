<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TunnelDeformation;
use App\Exports\TunnelDeformationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class TunnelDeformationController extends Controller
{
    /**
        @OA\Get(
            tags={"[Riesgos] Deformaciones al interior tunel"},
            path="/api/risks/tunnel-deformation",
            summary="Mostrar lista de deformaciones en tunel",
            @OA\Response(
                response=200,
                description="Mostrar todas las deformaciones en tunel."
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
        $tunnelDeformations = TunnelDeformation::all();
        return ( $tunnelDeformations ) ? $tunnelDeformations : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[Riesgos] Deformaciones al interior tunel"},
            path="/api/risks/tunnel-deformation",
            summary="Registrar deformacion en tunel",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo de la deformacion en tunel (max 10ch)",
                            example="DF01",
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
                            example="Al principio del tunel 13",
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

        $tunnelDeformation = new TunnelDeformation;
        $tunnelDeformation->code             = $request->code;
        $tunnelDeformation->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $tunnelDeformation->longitude        = $request->longitude;
        $tunnelDeformation->width            = $request->width;
        $tunnelDeformation->new              = $this->getRift($request->new);
        $tunnelDeformation->location         = $request->location;
        $tunnelDeformation->description      = $request->description;
        $tunnelDeformation->level            = $request->level;
        $tunnelDeformation->responsible_name = $request->responsible_name;
        $tunnelDeformation->responsible_id   = $request->responsible_id;
        $tunnelDeformation->observations     = $request->observations;
        $tunnelDeformation->project_id       = $request->project_id;
        $tunnelDeformation->user_id          = $request->user_id;
        $tunnelDeformation->save();

        return response()->json(["message" => "¡Deformacion de tunel registrada correctamente!", "id" => $tunnelDeformation->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Deformaciones al interior tunel"},
            path="/api/risks/tunnel-deformation/{id}",
            summary="Lista de las deformaciones en tunel de un proyecto",
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
        $tunnelDeformations = TunnelDeformation::where('project_id', $id)->get();
        return ( $tunnelDeformations ) ? $tunnelDeformations : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[Riesgos] Deformaciones al interior tunel"},
            path="/api/risks/tunnel-deformation/{id}",
            summary="Editar deformacion en tunel",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) de la deformacion de tunel",
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
                            description="Codigo de la deformacion en tunel (max 10ch)",
                            example="DF01",
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
                            example="Al principio del tunel 13",
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
    public function update(Request $request, TunnelDeformation $tunnelDeformation)
    {
        if (!$this->validateLevel($request->level))
            return response()->json([
                "message" => "Error: ¡El nivel de emergencia es incorrecto!",
                "id" => $request->code,
                "level" => $request->level],
                400
            );

        $tunnelDeformation->code             = $request->code;
        $tunnelDeformation->report_date      = date('Y-m-d H:i', strtotime($request->report_date));
        $tunnelDeformation->longitude        = $request->longitude;
        $tunnelDeformation->width            = $request->width;
        $tunnelDeformation->new              = $request->new;
        $tunnelDeformation->location         = $request->location;
        $tunnelDeformation->description      = $request->description;
        $tunnelDeformation->level            = $request->level;
        $tunnelDeformation->responsible_name = $request->responsible_name;
        $tunnelDeformation->responsible_id   = $request->responsible_id;
        $tunnelDeformation->observations     = $request->observations;
        $tunnelDeformation->project_id       = $request->project_id;
        $tunnelDeformation->user_id          = $request->user_id;
        $tunnelDeformation->save();

        return response()->json(["message" => "¡Deformacion de tunel editada correctamente!", "id" => $tunnelDeformation->id], 200);
    }

    /**
        @OA\Get(
            tags={"[Riesgos] Deformaciones al interior tunel"},
            path="/api/risks/tunnel-deformation/export/{id}",
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
        return Excel::download(new TunnelDeformationsExport($id), $project->name . ' - Deformaciones de tunel.xls');
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
