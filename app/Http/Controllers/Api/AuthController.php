<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contractor;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
        @OA\POST(
            tags={"Usuario"},
            path="/api/login",
            summary="Login de usuarios",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={"email"},
                        @OA\Property(
                            property="email",
                            description="Correo del usuario",
                            type="string"
                        ),
                        @OA\Property(
                            property="password",
                            description="Contraseña del usuario",
                            type="string",
                            format="password"
                        ),
                    )
                )
            ),
            @OA\Response(
                response=200,
                description="Login realizado."
            ),
            @OA\Response(
                response=400,
                description="Request mal mandado."
            ),
            @OA\Response(
                response=401,
                description="Intento de login rechazado."
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

    public function login(Request $request)
    {
        /*$validator = Validator::make($data, [
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);

        if($validator->fails()) {

            $validatorErrors = array();

            foreach ($validator->errors()->getMessages() as $item) {
                array_push($validatorErrors, $item[0]);
            }

            return response()->json($validatorErrors, 400);
        }*/

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
               'message' => 'Unauthorized'
           ], 401);
        }
        else
            $usuario = User::where('email', '=', $request->email)->get()->first();

        $usuario->setAttribute('risk', Contractor::where('user_id', $usuario->id)->where('role_id', 7)->count() ? true : false);        

        return response()->json(
            $usuario
        );
    }

    /**
        @OA\Get(
            tags={"Usuario"},
            path="/api/users",
            summary="Mostrar usuarios",
            @OA\Response(
                response=200,
                description="Mostrar todos los usuarios."
            ),
            @OA\Response(
                response="default",
                description="Ha ocurrido un error."
            )
        )
    */

    public function index()
    {
        return User::all();
    }

    /**
        @OA\POST(
            tags={"Usuario"},
            path="/api/users/risk-assignation",
            summary="Asignacion de usuarios a proyectos de riesgos",
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),
                        @OA\Property(
                            property="users",
                            type="array",
                            @OA\Items(
                                type="integer",
                                @OA\Items()
                            ),
                            description="Users ID's"
                        ),
                        example={"project_id": 1, "users": {1, 2}}
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

    public function riskAssignation(Request $request)
    {  
        foreach ($request->users as $user) {
            $contractor = new Contractor;
            $contractor->project_id = $request->project_id;
            $contractor->role_id    = 7;
            $contractor->user_id    = $user;
            $contractor->save();
        }
        return response()->json(["message" => "¡Usuarios asignados exitosamente al proyecto de riesgos: " . $request->project_id . "!", "usuarios" => $request->users], 200);
    }

    /**
        @OA\POST(
            tags={"Usuario"},
            path="/api/users/assignation",
            summary="Asignacion de usuarios a proyectos",
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),
                        @OA\Property(
                            property="users",
                            type="array",
                            @OA\Items(
                                type="integer",
                                @OA\Items()
                            ),
                            description="Users ID's"
                        ),
                        example={"project_id": 1, "users": {1, 2}}
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

    public function assignation(Request $request)
    {  
        foreach ($request->users as $user) {
            $contractor = new Contractor;
            $contractor->project_id = $request->project_id;
            $contractor->role_id    = 6;
            $contractor->user_id    = $user;
            $contractor->save();
        }
        return response()->json(["message" => "¡Usuarios asignados exitosamente al proyecto " . $request->project_id . "!", "usuarios" => $request->users], 200);
    }

    /**
        @OA\POST(
            tags={"Usuario"},
            path="/api/users",
            summary="Registrar usuario",
            @OA\RequestBody(
                required=false,
                @OA\MediaType(
                    mediaType="application/x-www-form-urlencoded",
                    @OA\Schema(
                        type="object",
                        required={},

                        @OA\Property(
                            property="document",
                            description="Documento del usuario",
                            example="ASD123",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="name",
                            description="Nombre del usuario",
                            example="CA",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="lastname",
                            description="Apellido del usuario",
                            example="MC",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="phone",
                            description="Telefono del usuario",
                            example="3145586963",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="address",
                            description="Direccion del usuario",
                            example="Cra 1 Call 12",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="position_id",
                            description="Cargo del usuario",
                            example="1",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="email",
                            description="Email del usuario",
                            example="camc@gmail.com",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="password",
                            description="Password del usuario",
                            example="123456",
                            type="string",
                            format="string"
                        ),
                        @OA\Property(
                            property="document_type_id",
                            description="Tipo de documento",
                            example="1",
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
    
    public function store(Request $request)
    {        
        $user = new User;
        $user->document         = $request->document;
        $user->name             = $request->name;
        $user->lastname         = $request->lastname;
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->position_id      = $request->position_id;
        $user->email            = $request->email;
        $user->password         = bcrypt('$request->password');
        $user->document_type_id = $request->document_type_id;
        $user->save();

        return response()->json(["message" => "¡Proyecto registrado!", "id" => $user->id], 200);
    }

    /**
        @OA\POST(
            tags={"Usuario"},
            path="/api/users/unassign",
            summary="Desasignacion de usuarios de proyectos",
            @OA\RequestBody(
                @OA\MediaType(
                    mediaType="application/json",
                    @OA\Schema(
                        @OA\Property(
                            property="project_id",
                            type="integer",
                            description="Id del proyecto",
                        ),
                        @OA\Property(
                            property="users",
                            type="array",
                            @OA\Items(
                                type="integer",
                                @OA\Items()
                            ),
                            description="Users ID's"
                        ),
                        example={"project_id": 1, "users": {1, 2}}
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

    public function unassign(Request $request)
    {  
        Contractor::where('project_id', $request->project_id)->whereIn('user_id', $request->users)->delete();
        return response()->json(["message" => "¡Usuarios desasignados exitosamente del proyecto " . $request->project_id . "!", "usuarios" => $request->users], 200);
    }

    /**
        @OA\Get(
            tags={"Usuario"},
            path="/api/users/projects/{id}",
            summary="Listado de proyectos por usuario",
            @OA\Parameter(
                name="id",
                in="path",
                description="id del usuario",
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

    public function getProjects($id)
    {
        $contractors = Contractor::where('user_id', $id)->get();
        $projects = [];
        foreach ($contractors as $contractor)
        {
            if (!in_array($contractor->project, $projects))
                $projects[] = $contractor->project;
        }
        return ( $projects ) ? $projects : response()->json(null, 204);
    }
}
