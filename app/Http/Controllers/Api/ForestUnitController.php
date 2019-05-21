<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForestUnit;
use App\Models\FunctionalUnit;
use App\Models\Responsability;
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
        $forest = ForestUnit::select('code', 'common_name', 'scientific_name', 'family', 'cap_cm', 'total_heigth_m', 'commercial_heigth_m', 'condition', 'health_status', 'origin','cup_density', 'x_cup_diameter_m', 'y_cup_diameter_m', 'waypoint', 'epiphytes', 'products','margin','treatment','resolution','state','end_treatment','note')->get();
        foreach ($forest as $forestUnit)
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
            path="/api/forest-unit/first-phase",
            summary="Primera fase IF - INVENTARIO",
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
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
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
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="id_image",
                            description="Foto del id",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general del arbol",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="reference_image",
                            description="Foto de referencia para identificarlo",
                            nullable=true,
                            type="string",
                            format="string"
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
                            example="3",
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
        $forestUnit->origin              = $this->getOrigin($request->origin);
        $forestUnit->cap_cm              = $request->cap_cm;
        $forestUnit->total_heigth_m      = $request->total_heigth_m;
        $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        $forestUnit->condition           = $this->getCondition($request->condition);
        $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        $forestUnit->waypoint            = $request->waypoint;
        $forestUnit->state               = $this->getState(4);
        $forestUnit->id_image            = $request->id_image;
        $forestUnit->general_image       = $request->general_image;
        $forestUnit->reference_image     = $request->reference_image;
        $forestUnit->note                = $request->note;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Inventario")->where('user_id', $request->user_id)->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(1);
            $responsability->action         = $this->getAction(1);
            $responsability->save();
        }

        return response()->json(["message" => "¡Primera fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/first-phase/{id}",
            summary="Editar primera fase de individuo forestal (Inventario)",
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
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
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
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="id_image",
                            description="Foto del id",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general del arbol",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="reference_image",
                            description="Foto de referencia para identificarlo",
                            nullable=true,
                            type="string",
                            format="string"
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
                            example="3",
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

    public function firstPhaseUpdate(Request $request, ForestUnit $forestUnit)
    {
        $forestUnit->code                = $request->code;
        $forestUnit->common_name         = $request->common_name;
        $forestUnit->state               = $this->getState(4);
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        if(isset($request->scientific_name))     $forestUnit->scientific_name     = $request->scientific_name;
        if(isset($request->origin))              $forestUnit->origin              = $this->getOrigin($request->origin);
        if(isset($request->cap_cm))              $forestUnit->cap_cm              = $request->cap_cm;
        if(isset($request->total_heigth_m))      $forestUnit->total_heigth_m      = $request->total_heigth_m;
        if(isset($request->commercial_heigth_m)) $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        if(isset($request->cup_density))         $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        if(isset($request->epiphytes))           $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        if(isset($request->condition))           $forestUnit->condition           = $this->getCondition($request->condition);
        if(isset($request->health_status))       $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        if(isset($request->x_cup_diameter_m))    $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        if(isset($request->y_cup_diameter_m))    $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        if(isset($request->waypoint))            $forestUnit->waypoint            = $request->waypoint;
        if(isset($request->note))                $forestUnit->note                = $request->note;
        if(isset($request->id_image))            $forestUnit->id_image            = $request->id_image;
        if(isset($request->general_image))       $forestUnit->general_image       = $request->general_image;
        if(isset($request->reference_image))     $forestUnit->reference_image     = $request->reference_image;
        
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Inventario")->where('user_id', $request->user_id)->where('action', 'Editar')->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(1);
            $responsability->action         = $this->getAction(2);
            $responsability->save();
        }

        return response()->json(["message" => "¡Primera fase de individuo forestal editada correctamente!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\POST(
            tags={"Individuos forestales"},
            path="/api/forest-unit",
            summary="Segunda Fase IF - APROVECHAMIENTO",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="products",
                            description="Productos y Posible uso  (1: Leña, 2: Madera)",
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
                            property="id_image",
                            description="Foto del id",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general del arbol",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues del aprovechamiento",
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
        $forestUnit->family              = $request->family;
        $forestUnit->cap_cm              = $request->cap_cm;
        $forestUnit->total_heigth_m      = $request->total_heigth_m;
        $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        $forestUnit->waypoint            = $request->waypoint;
        $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        $forestUnit->condition           = $this->getCondition($request->condition);
        $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        $forestUnit->origin              = $this->getOrigin($request->origin);
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->products            = $this->getProducts($request->products);
        $forestUnit->margin              = $this->getMargin($request->margin);
        $forestUnit->treatment           = $this->getTreatment($request->treatment);
        $forestUnit->state               = $this->getState($request->state);
        $forestUnit->resolution          = $request->resolution;
        $forestUnit->id_image            = $request->id_image;
        $forestUnit->general_image       = $request->general_image;
        $forestUnit->after_image         = $request->after_image;
        $forestUnit->start_treatment     = $request->start_treatment;
        $forestUnit->end_treatment       = $request->end_treatment;
        $forestUnit->note                = $request->note;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Aprovechamiento")->where('user_id', $request->user_id)->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(2);
            $responsability->action         = $this->getAction(1);
            $responsability->save();
        }

        return response()->json(["message" => "¡Individuo forestal registrado!", "id" => $forestUnit->id], 200);
    }

        /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/{id}",
            summary="Editar segunda fase individuo forestal (Aprovechamiento)",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
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
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="products",
                            description="Productos y Posible uso (1: Leña, 2: Madera)",
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
                            property="id_image",
                            description="Foto del id",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="general_image",
                            description="Foto general del arbol",
                            nullable=true,
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="after_image",
                            description="Foto del despues del aprovechamiento",
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
        $state = $forestUnit->state;

        $forestUnit->code                = $request->code;
        $forestUnit->common_name         = $request->common_name;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        if(isset($request->scientific_name))     $forestUnit->scientific_name     = $request->scientific_name;
        if(isset($request->family))              $forestUnit->family              = $request->family;
        if(isset($request->cap_cm))              $forestUnit->cap_cm              = $request->cap_cm;
        if(isset($request->total_heigth_m))      $forestUnit->total_heigth_m      = $request->total_heigth_m;
        if(isset($request->commercial_heigth_m)) $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        if(isset($request->x_cup_diameter_m))    $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        if(isset($request->y_cup_diameter_m))    $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        if(isset($request->waypoint))            $forestUnit->waypoint            = $request->waypoint;
        if(isset($request->north_coord))         $forestUnit->north_coord         = $request->north_coord;
        if(isset($request->east_coord))          $forestUnit->east_coord          = $request->east_coord;
        if(isset($request->epiphytes))           $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        if(isset($request->condition))           $forestUnit->condition           = $this->getCondition($request->condition);
        if(isset($request->health_status))       $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        if(isset($request->origin))              $forestUnit->origin              = $this->getOrigin($request->origin);
        if(isset($request->cup_density))         $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        if(isset($request->products))            $forestUnit->products            = $this->getProducts($request->products);
        if(isset($request->margin))              $forestUnit->margin              = $this->getMargin($request->margin);
        if(isset($request->treatment))           $forestUnit->treatment           = $this->getTreatment($request->treatment);
        if(isset($request->state))               $forestUnit->state               = $this->getState($request->state);
        if(isset($request->resolution))          $forestUnit->resolution          = $request->resolution;
        if(isset($request->id_image))            $forestUnit->id_image            = $request->id_image;
        if(isset($request->general_image))       $forestUnit->general_image       = $request->general_image;
        if(isset($request->after_image))         $forestUnit->after_image         = $request->after_image;
        if(isset($request->start_treatment))     $forestUnit->start_treatment     = $request->start_treatment;
        if(isset($request->end_treatment))       $forestUnit->end_treatment       = $request->end_treatment;
        if(isset($request->note))                $forestUnit->note                = $request->note;
        
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Aprovechamiento")->where('user_id', $request->user_id)->where('action', 'Editar')->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(2);
            $responsability->action         = $this->getAction(2);
            $responsability->save();
        }

        return response()->json(["message" => "¡Individuo forestal editado correctamente!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\POST(
            tags={"Individuos forestales"},
            path="/api/forest-unit/third-phase",
            summary="Tercera fase IF - COMPENSACION",
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
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
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
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="compensation_site",
                            description="Sitio de compensacion",
                            example="El Tablon-Lote 10",
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
                            property="note",
                            description="Observaciones",
                            example="Sin observaciones",
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

    public function thirdPhase(Request $request)
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
        $forestUnit->origin              = $this->getOrigin($request->origin);
        $forestUnit->cap_cm              = $request->cap_cm;
        $forestUnit->total_heigth_m      = $request->total_heigth_m;
        $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        $forestUnit->condition           = $this->getCondition($request->condition);
        $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        $forestUnit->waypoint            = $request->waypoint;
        $forestUnit->compensation_site   = $request->compensation_site;
        $forestUnit->state               = $this->getState(7);
        $forestUnit->general_image       = $request->general_image;
        $forestUnit->note                = $request->note;
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Compensación")->where('user_id', $request->user_id)->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(1);
            $responsability->action         = $this->getAction(1);
            $responsability->save();
        }

        return response()->json(["message" => "¡Tercera fase de IF completada!", "id" => $forestUnit->id], 200);
    }

    /**
        @OA\PUT(
            tags={"Individuos forestales"},
            path="/api/forest-unit/third-phase/{id}",
            summary="Editar tercera fase de individuo forestal (Compensacion)",
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
                            property="origin",
                            description="Origen (1: Nativa, 2: Exotica)",
                            example="1",
                            type="integer",
                            format="int32"
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
                            property="cup_density",
                            description="Densidad de copa (1: Clara, 2: Media, 3: Espesa)",
                            example="3",
                            type="integer",
                            format="int32"
                        ),

                        @OA\Property(
                            property="epiphytes",
                            description="Epífitas (1: Si, 2: No)",
                            example="1",
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
                            property="x_cup_diameter_m",
                            description="Diametro de copa X (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="y_cup_diameter_m",
                            description="Diametro de copa Y (Medido en m)",
                            example="6.0",
                            type="number",
                            format="float"
                        ),

                        @OA\Property(
                            property="waypoint",
                            description="Waypoint",
                            example="968455",
                            type="string",
                            format="string"
                        ),

                        @OA\Property(
                            property="compensation_site",
                            description="Sitio de compensacion",
                            example="El Tablon-Lote 10",
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
                            property="note",
                            description="Observaciones",
                            example="Sin observaciones",
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

    public function thirdPhaseUpdate(Request $request, ForestUnit $forestUnit)
    {
        $forestUnit->code                = $request->code;
        $forestUnit->common_name         = $request->common_name;
        $forestUnit->state               = $this->getState(4);
        $forestUnit->functional_unit_id  = $request->functional_unit_id;
        if(isset($request->scientific_name))     $forestUnit->scientific_name     = $request->scientific_name;
        if(isset($request->origin))              $forestUnit->origin              = $this->getOrigin($request->origin);
        if(isset($request->cap_cm))              $forestUnit->cap_cm              = $request->cap_cm;
        if(isset($request->total_heigth_m))      $forestUnit->total_heigth_m      = $request->total_heigth_m;
        if(isset($request->commercial_heigth_m)) $forestUnit->commercial_heigth_m = $request->commercial_heigth_m;
        if(isset($request->cup_density))         $forestUnit->cup_density         = $this->getCupDensity($request->cup_density);
        if(isset($request->epiphytes))           $forestUnit->epiphytes           = $this->getEpiphytes($request->epiphytes);
        if(isset($request->condition))           $forestUnit->condition           = $this->getCondition($request->condition);
        if(isset($request->health_status))       $forestUnit->health_status       = $this->getHealthStatus($request->health_status);
        if(isset($request->x_cup_diameter_m))    $forestUnit->x_cup_diameter_m    = $request->x_cup_diameter_m;
        if(isset($request->y_cup_diameter_m))    $forestUnit->y_cup_diameter_m    = $request->y_cup_diameter_m;
        if(isset($request->waypoint))            $forestUnit->waypoint            = $request->waypoint;
        if(isset($request->compensation_site))   $forestUnit->compensation_site   = $request->compensation_site;
        if(isset($request->note))                $forestUnit->note                = $request->note;
        if(isset($request->general_image))       $forestUnit->general_image       = $request->general_image;
        $forestUnit->save();

        if (isset($request->user_id) && empty(Responsability::where('forest_unit_id', $forestUnit->id)->where('module', "Compensación")->where('user_id', $request->user_id)->where('action', 'Editar')->first()))
        {
            $responsability = new Responsability;
            $responsability->forest_unit_id = $forestUnit->id;
            $responsability->user_id        = $request->user_id;
            $responsability->module         = $this->getModule(3);
            $responsability->action         = $this->getAction(2);
            $responsability->save();
        }

        return response()->json(["message" => "¡Tercera fase de individuo forestal editada correctamente!", "id" => $forestUnit->id], 200);
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
            default:
                return null;
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
            default:
                return null;
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
            default:
                return null;
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
            default:
                return null;
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
            case 7:
                return "Plantado";
            default:
                return null;
        }
    }

    public function getEpiphytes($epiphytes)
    {
        switch ($epiphytes) {
            case 1:
                return "SI";
            case 2:
                return "NO";
            default:
                return null;
        }
    }

    public function getOrigin($origin)
    {
        switch ($origin) {
            case 1:
                return "Nativa";
            case 2:
                return "Exotica";
            default:
                return null;
        }
    }

    public function getProducts($products)
    {
        switch ($products) {
            case 1:
                return "Leña";
            case 2:
                return "Madera";
            default:
                return null;
        }
    }

    public function getMargin($margin)
    {
        switch ($margin) {
            case 1:
                return "Derecha";
            case 2:
                return "Izquierda";
            default:
                return null;
        }
    }

    public function getModule($module)
    {
        switch ($module) {
            case 1:
                return "Inventario";
            case 2:
                return "Aprovechamiento";
            case 3:
                return "Compensación";
            default:
                return null;
        }
    }

    public function getAction($action)
    {
        switch ($action) {
            case 1:
                return "Crear";
            case 2:
                return "Editar";
            default:
                return null;
        }
    }
}
