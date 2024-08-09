<?php

namespace App\Http\Controllers;

use App\Models\Psychological;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PsychologicalController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'professional_cell' => 'required|numeric',
            'whatsapp_link' => 'required|url',
            'review' => 'required|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological = Psychological::create($request->all());

        if (!$psychological) {
            return response()->json([
                'message' => 'Error al crear el registro psicológico',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'psychological' => $psychological,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $psychologicals = Psychological::all();

        if ($psychologicals->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros psicológicos',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'psychologicals' => $psychologicals,
            'status' => 200
        ], 200);
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
}
