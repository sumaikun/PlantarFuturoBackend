<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://localhost:8000")
*/

class CustomerController extends Controller
{
    /**
        @OA\Get(
            tags={"Cliente"},
            path="/api/customer",
            summary="Mostrar lista de clientes",
            @OA\Response(
                response=200,
                description="Mostrar todos los clientes."
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
        $customers = Customer::all();
        return ( $customers ) ? $customers : response()->json(null, 204);
    }

    /**
        @OA\POST(
            tags={"Cliente"},
            path="/api/customer",
            summary="Registrar Cliente",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre del cliente",
                            example="Codensa",
                            type="string",
                            format="string"
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
        $customer = new Customer;
        $customer->name       = $request->name;
        $customer->save();

        return response()->json(["message" => "¡Cliente registrado!", "id" => $customer->id], 200);
    }

    /**
        @OA\Get(
            tags={"Cliente"},
            path="/api/customer/{id}",
            summary="Ver Cliente",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del cliente",
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

    public function show(Customer $customer)
    {
        return ( $customer ) ? $customer : response()->json(null, 204);
    }

    /**
        @OA\PUT(
            tags={"Cliente"},
            path="/api/customer/{id}",
            summary="Editar Cliente",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del cliente",
                example= "1",
                required= true,
                @OA\Schema(type="integer", format="int32")
            ),
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},
                        @OA\Property(
                            property="name",
                            description="Nombre del cliente",
                            example="Codensa S.A.",
                            type="string",
                            format="string"
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

    public function update(Request $request, Customer $customer)
    {
        $customer->name       = $request->name;
        $customer->save();

        return response()->json(["message" => "¡Cliente editado!", "id" => $customer->id], 200);
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
