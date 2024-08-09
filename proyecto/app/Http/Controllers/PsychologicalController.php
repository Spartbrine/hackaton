<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Psychological;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PsychologicalController extends Controller
{
    public function index()
    {
        $psychologicals = Psychological::all();

        if ($psychologicals->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros psicológicos',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'psychologicals' => $psychologicals,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological = Psychological::create([
            'description' => $request->description,
            'type' => $request->type
        ]);

        return response()->json([
            'psychological' => $psychological,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $psychological = Psychological::find($id);

        if (!$psychological) {
            return response()->json([
                'message' => 'Registro psicológico no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $psychological = Psychological::find($id);

        if (!$psychological) {
            return response()->json([
                'message' => 'Registro psicológico no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological->description = $request->description;
        $psychological->type = $request->type;
        $psychological->save();

        return response()->json([
            'message' => 'Registro psicológico actualizado',
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $psychological = Psychological::find($id);

        if (!$psychological) {
            return response()->json([
                'message' => 'Registro psicológico no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'string|max:255',
            'type' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('description')) {
            $psychological->description = $request->description;
        }

        if ($request->has('type')) {
            $psychological->type = $request->type;
        }

        $psychological->save();

        return response()->json([
            'message' => 'Registro psicológico actualizado parcialmente',
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }
}
