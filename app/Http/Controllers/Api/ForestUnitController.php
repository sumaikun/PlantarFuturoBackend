<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForestUnit;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://localhost:8000")
*/

class ForestUnitController extends Controller
{
    public function index()
    {
        //
    }

    /**
        @OA\POST(
            tags={"Individuos forestales"},
            path="/api/forest-unit",
            summary="Registrar individuo forestal",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        
                        @OA\Property(
                            property="inspector",
                            description="Interventor",
                            example="Marlon Gamba SA",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="code",
                            description="Codigo del individuo",
                            example="102F",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="common_name",
                            description="Nombre comun del individuo",
                            example="Torcazo",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="scientific_name",
                            description="Nombre cientifico del individuo",
                            example="Schefflera morototoni",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="species",
                            description="Especie del individuo",
                            example="Alchornea sp.",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="family",
                            description="Familia del individuo",
                            example="Euphorbiaceac",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="cap_cm",
                            description="CAP (Medido en cm)",
                            example="40.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="total_heigth_m",
                            description="Altura total (Medido en m)",
                            example="10.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="commercial_heigth_m",
                            description="Altura comercial (Medido en m)",
                            example="7.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="cup_diameter_m",
                            description="Diametro de copa (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="north_coord",
                            description="Coordenada norte",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="east_coord",
                            description="Coordenada este",
                            example="1073797",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="condition",
                            description="Estado fisico",
                            example="Bueno",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="health_status",
                            description="Estado Sanitario",
                            example="Bueno",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="origin",
                            description="Origen",
                            example="Nativa",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="cup_density",
                            description="Densidad de copa",
                            example="Clara",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="products",
                            description="Productos y Posible uso",
                            example="Leña",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="margin",
                            description="Margen",
                            example="Derecha",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="treatment",
                            description="Tipo de manejo",
                            example="Tala",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="state",
                            description="Estado",
                            example="Talado",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="resolution",
                            description="Resolucion",
                            example="0366",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general",
                            example="null",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="before_image",
                            description="Foto del antes",
                            example="null",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues",
                            example="null",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="start_treatment",
                            description="Fecha de inicio",
                            example= "2019-04-25",
                            type="string",
                            format="date"
                        ),

                        @OA\Property(
                            property="end_treatment",
                            description="Fecha de finalizacion",
                            example= "2019-04-28",
                            type="string",
                            format="date"
                        ),

                        @OA\Property(
                            property="note",
                            description="Observaciones",
                            example="Sin observaciones",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="functional_unit_id",
                            description="Id de la unidad funcional",
                            example="5",
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $forestUnit = new ForestUnit;
        $forestUnit->inspector           = $request->inspector;
        $forestUnit->code                = $request->code;
        $forestUnit->common_name         = $request->common_name;
        $forestUnit->scientific_name     = $request->scientific_name;
        $forestUnit->species             = $request->species;
        $forestUnit->family              = $request->family;
        $forestUnit->cap_cm              = $request->cap_cm;
        $forestUnit->total_heigth_m      = $request->total_heigth_m;
        $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        $forestUnit->cup_diameter_m      = $request->cup_diameter_m;
        $forestUnit->north_coord         = $request->north_coord;
        $forestUnit->east_coord          = $request->east_coord;
        $forestUnit->condition           = $request->condition;
        $forestUnit->health_status       = $request->health_status;
        $forestUnit->origin              = $request->origin;
        $forestUnit->cup_density         = $request->cup_density;
        $forestUnit->products            = $request->products;
        $forestUnit->margin              = $request->margin;
        $forestUnit->treatment           = $request->treatment;
        $forestUnit->state               = $request->state;
        $forestUnit->resolution          = $request->resolution;
        $forestUnit->general_image       = $request->general_image;
        $forestUnit->before_image        = $request->before_image;
        $forestUnit->after_image         = $request->after_image;
        $forestUnit->start_treatment     = $request->start_treatment;
        $forestUnit->end_treatment       = $request->end_treatment;
        $forestUnit->note                = $request->note;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();
        return response()->json(["message" => "¡Individuo forestal registrado!", "id" => $forestUnit->id], 200);
    }

    public function show(ForestUnit $forestUnit)
    {
        //
    }

    public function edit(ForestUnit $forestUnit)
    {
        //
    }

    public function update(Request $request, ForestUnit $forestUnit)
    {
        //
    }

    public function destroy(ForestUnit $forestUnit)
    {
        //
    }
}
