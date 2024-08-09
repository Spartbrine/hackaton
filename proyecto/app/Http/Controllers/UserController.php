<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();

        $data = [
            'users' => $users,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user = Users::create($request->all());

        return response()->json([
            'user' => $user,
            'status' => 201
        ], 201);
    }

    public function show($email)
    {
        $user = Users::find($email);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $email)
    {
        $user = Users::find($email);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'lastname' => 'max:255',
            'password' => 'min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado',
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $email)
    {
        $user = Users::find($email);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'lastname' => 'max:255',
            'password' => 'min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user->update($request->only('name', 'lastname', 'password'));

        return response()->json([
            'message' => 'Usuario actualizado',
            'user' => $user,
            'status' => 200
        ], 200);
    }
}
