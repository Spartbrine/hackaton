<?php

namespace App\Http\Controllers;

use App\Models\Analysistest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnalysistestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'answer' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $analysistest = Analysistest::create($request->all());

        if (!$analysistest) {
            return response()->json([
                'message' => 'Error al crear el análisis del test',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'analysistest' => $analysistest,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $analysistests = Analysistest::all();

        if ($analysistests->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron análisis de test',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'analysistests' => $analysistests,
            'status' => 200
        ], 200);
    }

    public function show($id)
    {
        $analysistest = Analysistest::find($id);

        if (!$analysistest) {
            return response()->json([
                'message' => 'Análisis de test no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }
}
