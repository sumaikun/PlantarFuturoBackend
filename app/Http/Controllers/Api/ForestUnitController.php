<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForestUnit;
use App\Models\FunctionalUnit;
use Illuminate\Http\Request;
use PDF;

/**
* @OA\Server(url="http://localhost:8000")
*/

class ForestUnitController extends Controller
{
    /**
        @OA\Get(
            tags={"Individuos forestales"},
            path="/api/forest-unit",
            summary="Mostrar lista de individuos forestales",
            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
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
        foreach (ForestUnit::all() as $forestUnit)
        {
            $forestUnits[] = $forestUnit->setAttribute('functional_unit', $forestUnit->functional_unit);
        }

        return ( $forestUnits ) ? $forestUnits : response()->json(null, 204);
    }

    public function create()
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
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="species",
                            description="Especie del individuo",
                            example="Alchornea sp.",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="family",
                            description="Familia del individuo",
                            example="Euphorbiaceac",
                            nullable=true,
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
                            description="Estado fisico (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="health_status",
                            description="Estado Sanitario (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="products (1: Leña, 2: Madera)",
                            description="Productos y Posible uso",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="margin",
                            description="Margen (1: Derecha, 2: Izquierda)",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="treatment",
                            description="Tipo de manejo (1: Tala, 2: Perman. Y/poda, 3: Bloque y T. , 4: Plantar)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="state",
                            description="Estado (1: Talado, 2: No Talado, 3: En proceso, 4: Sin Iniciar, 5: Inhabilitado, 6: Sin definir)",
                            example="4",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="resolution",
                            description="Resolución",
                            example="0366",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="before_image",
                            description="Foto del antes",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues",
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
                            description="Fecha de finalización",
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
        if (!$this->validateCode($request->functional_unit_id, $request->code))
            return response()->json([
                "message" => "Error: ¡El codigo del individuo forestal ya existe!",
                "id" => $request->code],
                400
            );

        $forestUnit = new ForestUnit;
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
        $forestUnit->condition           = $this->getCondition($request->condition);
        $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        $forestUnit->origin              = $request->origin == 1 ? "Nativa" : "Exotica";
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->products            = $request->products == 1 ? "Leña" : "Madera";
        $forestUnit->margin              = $request->margin == 1 ? "Derecha" : "Izquierda";
        $forestUnit->treatment           = $this->getTreatment($request->treatment);
        $forestUnit->state               = $this->getState($request->state);
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

    /**
        @OA\POST(
            tags={"Individuos forestales"},
            path="/api/forest-unit/first-phase",
            summary="Primera fase IF - Creación",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="code",
                            description="Codigo del individuo",
                            example="103F",
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
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="resolution",
                            description="Resolución",
                            example="0377",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="functional_unit_id",
                            description="Id de la unidad funcional",
                            example="3",
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

    public function firstPhase(Request $request)
    {
        if (!$this->validateCode($request->functional_unit_id, $request->code))
            return response()->json([
                "message" => "Error: ¡El codigo del individuo forestal ya existe!",
                "id" => $request->code],
                400
            );

        $forestUnit = new ForestUnit;
        $forestUnit->code                = $request->code;
        $forestUnit->common_name         = $request->common_name;
        $forestUnit->scientific_name     = $request->scientific_name;
        $forestUnit->state               = $this->getState(6);
        $forestUnit->resolution          = $request->resolution;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();

        return response()->json(["message" => "¡Primera fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/second-phase/{id}",
            summary="Segunda fase IF - Datos generales",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del IF",
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
                            property="species",
                            description="Especie del individuo",
                            example="Alchornea sp.",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="family",
                            description="Familia del individuo",
                            example="Euphorbiaceac",
                            nullable=true,
                            type="string",
                            format="string"
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
                            description="Estado fisico (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="health_status",
                            description="Estado Sanitario (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="treatment",
                            description="Tipo de manejo (1: Tala, 2: Perman. Y/poda, 3: Bloque y T. , 4: Plantar)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="state",
                            description="Estado (2: No Talado, 4: Sin Iniciar, 5: Inhabilitado)",
                            example="4",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general",
                            nullable=true,
                            type="string",
                            format="string"
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

    public function secondPhase(Request $request, ForestUnit $forestUnit)
    {
        $forestUnit->species       = $request->species;
        $forestUnit->family        = $request->family;
        $forestUnit->north_coord   = $request->north_coord;
        $forestUnit->east_coord    = $request->east_coord;
        $forestUnit->condition     = $this->getCondition($request->condition);
        $forestUnit->health_status = $this->getHealthStatus($request->health_status);
        $forestUnit->treatment     = $this->getTreatment($request->treatment);
        $forestUnit->state         = $this->getState($request->state);
        $forestUnit->general_image = $request->general_image;
        $forestUnit->save();

        return response()->json(["message" => "¡Segunda fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/third-phase/{id}",
            summary="Tercera fase IF - Antes de intervención",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del IF",
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
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="before_image",
                            description="Foto del antes",
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

    public function thirdPhase(Request $request, ForestUnit $forestUnit)
    {
        $forestUnit->cap_cm              = $request->cap_cm;
        $forestUnit->total_heigth_m      = $request->total_heigth_m;
        $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        $forestUnit->cup_diameter_m      = $request->cup_diameter_m;
        $forestUnit->origin              = $request->origin == 1 ? "Nativa" : "Exotica";
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->state               = $this->getState(3);
        $forestUnit->before_image        = $request->before_image;
        $forestUnit->start_treatment     = $request->start_treatment;
        $forestUnit->save();

        return response()->json(["message" => "¡Tercera fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/fourth-phase/{id}",
            summary="Cuarta fase IF - Despues de intervención",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del IF",
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
                            property="products (1: Leña, 2: Madera)",
                            description="Productos y Posible uso",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="margin",
                            description="Margen (1: Derecha, 2: Izquierda)",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="end_treatment",
                            description="Fecha de finalización",
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

    public function fourthPhase(Request $request, ForestUnit $forestUnit)
    {
        $forestUnit->products            = $request->products == 1 ? "Leña" : "Madera";
        $forestUnit->margin              = $request->margin == 1 ? "Derecha" : "Izquierda";
        $forestUnit->after_image         = $request->after_image;
        $forestUnit->end_treatment       = $request->end_treatment;
        $forestUnit->note                = $request->note;
        $forestUnit->state               = $this->getState(1);
        $forestUnit->save();

        return response()->json(["message" => "¡Cuarta fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\Get(
            tags={"Individuos forestales"},
            path="/api/forest-unit/{id}",
            summary="Ver individuo forestal",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del individuo forestal",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
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
    public function show(ForestUnit $forestUnit)
    {
        $forestUnit->setAttribute('functional_unit', $forestUnit->functional_unit);

        return ( $forestUnit ) ? $forestUnit : response()->json(null, 204);
    }

    /**
        @OA\Get(
            tags={"Individuos forestales"},
            path="/api/forest-unit/pdf/{id}",
            summary="PDF del individuo forestal",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del individuo forestal",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),

            @OA\Response(
                response=200,
                description="Mostrar todos los proyectos."
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
    public function getPdf($id)
    {
        $forestUnit = ForestUnit::find($id);
        $forestUnit->setAttribute('functional_unit', $forestUnit->functional_unit);
        $forestUnit->setAttribute('project', $forestUnit->functional_unit->project);
        if ($forestUnit->updated_at)
            $forestUnit->setAttribute('date', $forestUnit->updated_at->format("d/m/Y"));
        else
            $forestUnit->setAttribute('date', date("d/m/Y", $forestUnit->updated_at));
        $forestUnit->setAttribute('dap', round(($forestUnit->cap_cm / pi()) / 100, 2));
        $basalArea = (pi() / 4) * pow($forestUnit->dap, 2);
        $forestUnit->setAttribute('commercial_volume_m3', round($forestUnit->commercial_heigth_m * $basalArea * 0.7, 2));
        $forestUnit->setAttribute('total_volume_m3', round($forestUnit->total_heigth_m * $basalArea * 0.7, 2));
        $pdf = PDF::loadView('DownloadTemplates/pdf', $forestUnit);

        return $pdf->download('FichaTecnicaIndividuo' . $forestUnit->code . '.pdf');
    }

    public function edit(ForestUnit $forestUnit)
    {
        //
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/{id}",
            summary="Editar individuo forestal",
            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                description="Id (Primary key) del IF",
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
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="species",
                            description="Especie del individuo",
                            example="Alchornea sp.",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="family",
                            description="Familia del individuo",
                            example="Euphorbiaceac",
                            nullable=true,
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
                            description="Estado fisico (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="health_status",
                            description="Estado Sanitario (1: Malo, 2: Regular, 3: Bueno)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="products (1: Leña, 2: Madera)",
                            description="Productos y Posible uso",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="margin",
                            description="Margen (1: Derecha, 2: Izquierda)",
                            example="2",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="treatment",
                            description="Tipo de manejo (1: Tala, 2: Perman. Y/poda, 3: Bloque y T. , 4: Plantar)",
                            example="1",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="state",
                            description="Estado (1: Talado, 2: No Talado, 3: En proceso, 4: Sin Iniciar, 5: Inhabilitado, 6: Sin definir)",
                            example="4",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="resolution",
                            description="Resolución",
                            example="0366",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="before_image",
                            description="Foto del antes",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues",
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
                            description="Fecha de finalización",
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

    public function update(Request $request, ForestUnit $forestUnit)
    {
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
        $forestUnit->condition           = $this->getCondition($request->condition);
        $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        $forestUnit->origin              = $request->origin == 1 ? "Nativa" : "Exotica";
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->products            = $request->products == 1 ? "Leña" : "Madera";
        $forestUnit->margin              = $request->margin == 1 ? "Derecha" : "Izquierda";
        $forestUnit->treatment           = $this->getTreatment($request->treatment);
        $forestUnit->state               = $this->getState($request->state);
        $forestUnit->resolution          = $request->resolution;
        $forestUnit->general_image       = $request->general_image;
        $forestUnit->before_image        = $request->before_image;
        $forestUnit->after_image         = $request->after_image;
        $forestUnit->start_treatment     = $request->start_treatment;
        $forestUnit->end_treatment       = $request->end_treatment;
        $forestUnit->note                = $request->note;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();

        return response()->json(["message" => "¡Individuo forestal editado correctamente!", "id" => $forestUnit->id], 200);
    }

    public function destroy(ForestUnit $forestUnit)
    {
        //
    }

    public function validateCode($functional_unit_id, $code)
    {
        foreach (FunctionalUnit::find($functional_unit_id)->forest_units as $unit) {
            if ($code == $unit->code) return false;
        }
        return true;
    }

    public function getCondition($condition)
    {
        switch ($condition) {
            case 1:
                return "Malo";
            case 2:
                return "Regular";
            case 3:
                return "Bueno";
        }
    }

    public function getHealthStatus($healthStatus)
    {
        switch ($healthStatus) {
            case 1:
                return "Malo";
            case 2:
                return "Regular";
            case 3:
                return "Bueno";
        }
    }

    public function getCupDensity($cupDensity)
    {
        switch ($cupDensity) {
            case 1:
                return "Clara";
            case 2:
                return "Media";
            case 3:
                return "Espesa";
        }
    }

    public function getTreatment($treatment)
    {
        switch ($treatment) {
            case 1:
                return "Tala";
            case 2:
                return "Perman. Y/poda";
            case 3:
                return "Bloque y T.";
            case 4:
                return "Plantar";
        }
    }

    public function getState($state)
    {
        switch ($state) {
            case 1:
                return "Talado";
            case 2:
                return "No Talado";
            case 3:
                return "En proceso";
            case 4:
                return "Sin iniciar";
            case 5:
                return "Inhabilitado";
            case 6:
                return "Sin definir";
        }
    }
}
