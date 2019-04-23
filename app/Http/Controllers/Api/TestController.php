<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Validator;
/**
* @OA\Server(url="http://localhost:8000")
*/

class TestController extends Controller
{

    /**
    * @OA\POST(
    *     path="/api/testExcel",
    *     summary="Probar como llegan los datos de excel desde angular",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="id",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 example={"id": 10, "name": "Jessica Smith"}
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Muestra el resultado."
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Indica que no se mandarón bien los parametros."
    *     ),
    *     @OA\Response(
    *         response=405,
    *         description="Metodo no permitido."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

    public function testExcel(Request $request)
    {
      $validator = Validator::make($request->all(), [
         'excelData' => 'required|array',
         'userId'  => 'required|integer'
       ]);

       if($validator->fails()) {

         $validatorErrors = array();

         foreach ($validator->errors()->getMessages() as $item) {
                 array_push($validatorErrors, $item[0]);
         }

         return response()->json($validatorErrors, 400);

       }

       print_r($request->excelData);

       for($request->excelData in $data)
       {
         //iterar cada objeto y hacer algo con el
       }

    }
}
