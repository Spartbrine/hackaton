<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user', // Verifica el nombre de tu tabla.
            'name' => 'required|max:255',
            'lastname' => 'required|max:255', 
            'password' => [
                'required',
                'regex:/^(?=.*[A-Za-z])(?=.*\d{4})([A-Za-z\d]){8,10}$/'
            ]
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $user = Users::create([
            'email' => $request->email,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => bcrypt($request->password) 
        ]);

        if (!$user) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'user' => $user,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function index()
    {
        $users = Users::all();

        if ($users->isEmpty()) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $data = [
            'users' => $users,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $user = Users::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}