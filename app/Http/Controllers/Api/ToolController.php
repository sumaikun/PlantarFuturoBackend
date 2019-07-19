<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use App\Models\ToolAsignation;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://plantarfuturo.com/ws")
*/

class ToolController extends Controller
{
    /**
        @OA\Get(
            tags={"[CR] Herramienta"},
            path="/api/tool",
            summary="Mostrar lista de herramientas",
            @OA\Response(
                response=200,
                description="Mostrar todos los herramientas."
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
        foreach (Tool::all() as $tool)
        {
            $tools[] = $tool->setAttribute('tool_category', $tool->tool_category);
        }

        return ( $tools ) ? $tools : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"[CR] Herramienta"},
            path="/api/tool",
            summary="Registrar una nueva Herramienta",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="code",
                            description="Codigo de la Herramienta",
                            example="MQ0001",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="name",
                            description="Nombre de la herramienta",
                            example="Motosierra",
                            type="string",
                        ),

                        @OA\Property(
                            property="description",
                            description="Descripción",
                            example="Herramienta necesaria para el aprovechamiento de los arboles",
                            type="string",
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo de herramienta (0: NO consume combustible 1: SI consume combustible)",
                            example="1",
                            type="string",
                        ),

                        @OA\Property(
                            property="model",
                            description="Modelo",
                            example="Modelo 2015",
                            type="string",
                        ),

                        @OA\Property(
                            property="customer",
                            description="Cliente",
                            example="Cliente",
                            type="string",
                        ),

                        @OA\Property(
                            property="workfront",
                            description="Frente de trabajo",
                            example="frente de trabajo #1",
                            type="string",
                        ),

                        @OA\Property(
                            property="condition",
                            description="Condicion (1: Buena, 2: Media, 3: Mala(",
                            example="1",
                            type="string",
                        ),

                        @OA\Property(
                            property="provider",
                            description="Proveedor",
                            example="ElectroMaquinaria S.A.S",
                            type="string",
                        ),

                        @OA\Property(
                            property="remaining_service",
                            description="Servicio restante",
                            example="5 temporadas",
                            type="string",
                        ),

                        @OA\Property(
                            property="buy_date",
                            description="Fecha de la compra de la herramienta (YYYY-MM-DD)",
                            example="2019-07-15",
                            type="date",
                        ),

                        @OA\Property(
                            property="price",
                            description="Valor inicial",
                            example="2563000",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="tool_category_id",
                            description="Id de la categoria de herramientas",
                            example="2563000",
                            type="number",
                            format="float"
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
        $tool = new Tool;
        $tool->code              = $request->code;
        $tool->name              = $request->name;
        $tool->description       = $request->description;
        $tool->type              = $request->type;
        $tool->model             = $request->model;
        $tool->customer          = $request->customer;
        $tool->workfront         = $request->workfront;
        $tool->condition         = $this->getCondition($request->condition);
        $tool->provider          = $request->provider;
        $tool->remaining_service = $request->remaining_service;
        $tool->buy_date          = date('Y-m-d', strtotime($request->buy_date));
        $tool->price             = $request->price;
        $tool->tool_category_id  = $request->tool_category_id;
        $tool->save();

        $toolAsignation = new ToolAsignation;
        $toolAsignation->state = 1;
        $toolAsignation->checkin    = date('Y-m-d', strtotime($request->buy_date));
        $toolAsignation->project_id = $request->project_id;
        $toolAsignation->tool_id    = $tool->id;

        return response()->json(["message" => "¡Herramienta registrada!", "id" => $tool->id], 200);
    }

    /**
        @OA\Get(
            tags={"[CR] Herramienta"},
            path="/api/tool/{id}",
            summary="Ver Herramienta",
            @OA\Parameter(
                name="id",
                in="path",
                description="id de la herramienta",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los herramientas."
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

    public function show(Tool $tool)
    {
        $tool->setAttribute('tool_category', $tool->tool_category);

        return ( $tool ) ? $tool : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"[CR] Herramienta"},
            path="/api/tool/project/{id}",
            summary="Mostrar lista de herramientas de un proyecto",
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
                description="Mostrar todos los herramientas."
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

    public function toolsByProject($id)
    {
        $toolAsignations = ToolAsignation::where('state', 1)->where('project_id', $id)->whereNull('checkout')->get();
        $tools = [];

        foreach ($toolAsignations as $toolAsignation)
        {
            $toolAsignation->setAttribute('tool', $toolAsignation->tool);
            if (!in_array_field($toolAsignation->tool_id, 'tool_id', $tools)) $tools[] = $toolAsignation;
        }
        return ( $tools ) ? $tools : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"[CR] Herramienta"},
            path="/api/tool/project/pending/{id}",
            summary="Mostrar lista de herramientas trasladadas de otro proyecto",
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
                description="Mostrar todos los herramientas."
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

    public function toolsPendingByProject($id)
    {
        $toolAsignations = ToolAsignation::where('state', 2)->where('project_id', $id)->get();
        $tools = [];

        foreach ($toolAsignations as $toolAsignation)
        {
            $toolAsignation->setAttribute('tool', $toolAsignation->tool);
            if (!in_array_field($toolAsignation->tool_id, 'tool_id', $tools)) $tools[] = $toolAsignation;
        }
        return ( $tools ) ? $tools : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"[CR] Herramienta"},
            path="/api/tool/{id}",
            summary="Editar Herramienta",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary Key) de la Herramienta",
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
                            description="Codigo de la Herramienta",
                            example="MQ0001",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="name",
                            description="Nombre de la herramienta",
                            example="Motosierra",
                            type="string",
                        ),

                        @OA\Property(
                            property="description",
                            description="Descripción",
                            example="Herramienta necesaria para el aprovechamiento de los arboles",
                            type="string",
                        ),

                        @OA\Property(
                            property="type",
                            description="Tipo de herramienta (0: NO consume combustible 1: SI consume combustible)",
                            example="1",
                            type="string",
                        ),

                        @OA\Property(
                            property="model",
                            description="Modelo",
                            example="Modelo 2015",
                            type="string",
                        ),

                        @OA\Property(
                            property="customer",
                            description="Cliente",
                            example="Cliente",
                            type="string",
                        ),

                        @OA\Property(
                            property="workfront",
                            description="Frente de trabajo",
                            example="frente de trabajo #1",
                            type="string",
                        ),

                        @OA\Property(
                            property="condition",
                            description="Condicion (1: Buena, 2: Media, 3: Mala(",
                            example="1",
                            type="string",
                        ),

                        @OA\Property(
                            property="provider",
                            description="Proveedor",
                            example="ElectroMaquinaria S.A.S",
                            type="string",
                        ),

                        @OA\Property(
                            property="remaining_service",
                            description="Servicio restante",
                            example="5 temporadas",
                            type="string",
                        ),

                        @OA\Property(
                            property="buy_date",
                            description="Fecha de la compra de la herramienta (YYYY-MM-DD)",
                            example="2019-07-15",
                            type="date",
                        ),

                        @OA\Property(
                            property="price",
                            description="Valor inicial",
                            example="2563000",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="tool_category_id",
                            description="Id de la categoria de herramientas",
                            example="2563000",
                            type="number",
                            format="float"
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

    public function update(Request $request, Tool $tool)
    {
        $tool->code              = $request->code;
        $tool->name              = $request->name;
        $tool->description       = $request->description;
        $tool->type              = $request->type;
        $tool->model             = $request->model;
        $tool->customer          = $request->customer;
        $tool->workfront         = $request->workfront;
        $tool->condition         = $this->getCondition($request->condition);
        $tool->provider          = $request->provider;
        $tool->remaining_service = $request->remaining_service;
        $tool->buy_date          = date('Y-m-d', strtotime($request->buy_date));
        $tool->price             = $request->price;
        $tool->tool_category_id  = $request->tool_category_id;
        $tool->save();

        $toolAsignation = ToolAsignation::where('tool_id', $tool->id)->where('project_id', $request->project_id)->first();
        if (isset($toolAsignation))
        {
            $toolAsignation->state = 1;
            $toolAsignation->checkin    = date('Y-m-d', strtotime($request->buy_date));
            $toolAsignation->project_id = $request->project_id;
            $toolAsignation->tool_id    = $tool->id;
        }

        return response()->json(["message" => "¡Herramienta editada!", "id" => $tool->id], 200);
    }

    /**
        @OA\POST(
            tags={"[CR] Herramienta"},
            path="/api/tool/transfer",
            summary="Traslado de herramientas a un proyecto",
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="starting_project",
                            type="integer",
                            description="Id del proyecto de partida",
                        ),
                        @OA\Property(
                            property="project_destination",
                            type="integer",
                            description="Id del proyecto destino",
                        ),
                        @OA\Property(
                            property="transfer_date",
                            type="date",
                            description="Fecha del traslado de la herramienta (YYYY-MM-DD)",
                        ),
                        @OA\Property(
                            property="tools",
                            type="array",
                            @OA\Items(
                                type="integer",
                                @OA\Items()
                            ),
                            description="Users ID's"
                        ),
                        example={"project_id": 3, "transfer_date": "2019-07-15", "tools": {1, 2}}
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
    public function toolTransfer(Request $request)
    {
        $asignation = ToolAsignation::where('state', 1)->where('project_id', $request->starting_project)->whereNull('checkout')->first();
        $asignation->checkout = date('Y-m-d', strtotime($request->transfer_date));
        $asignation->state = 3;
        $asignation->save();

        foreach ($request->tools as $tool)
        {
            $toolAsignation = new ToolAsignation;
            $toolAsignation->state      = 2;
            $toolAsignation->checkin    = date('Y-m-d', strtotime($request->transfer_date));
            $toolAsignation->project_id = $request->project_destination;
            $toolAsignation->tool_id    = $tool;

            $toolAsignation->save();
        }

        return response()->json(["message" => "¡Herramientas trasladadas!", "Herramientas" => $request->tools], 200);
    }

    /**
        @OA\POST(
            tags={"[CR] Herramienta"},
            path="/api/tool/receiving",
            summary="Recepcion de una herramienta",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="tool_asignation_id",
                            description="Id de la asignacion de la herramienta",
                            example="1",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="transfer_notes",
                            description="Observaciones sobre el estado de la herramienta al momento del translado",
                            example="Se evidencia que la herramienta a pesar de estar un poco desgastada, se mantiene en buen estado.",
                            type="string",
                        ),

                        @OA\Property(
                            property="evidence_photo",
                            description="Foto de evidencia",
                            example="",
                            type="string",
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

    public function recievingTool(Request $request)
    {
        $toolAsignation = ToolAsignation::find($request->tool_asignation_id);
        
        $toolAsignation->state = 1;
        $toolAsignation->transfer_notes = $request->transfer_notes;
        $toolAsignation->evidence_photo = $evidence_photo;
        $toolAsignation->save();

        return response()->json(["message" => "¡Herramienta recibida!", "id" => $toolAsignation->tool_id], 200);
    }
    

    public function getCondition($condition)
    {
        switch ($condition) {
            case 1:
                return "Bueno";
            case 2:
                return "Regular";
            case 3:
                return "Malo";
            default:
                return null;
        }
    }
}
