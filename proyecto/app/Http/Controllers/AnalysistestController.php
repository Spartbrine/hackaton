<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Analysistest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnalysistestController extends Controller
{
    public function index()
    {
        $analysistests = Analysistest::all();

        if ($analysistests->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron pruebas de análisis',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'analysistests' => $analysistests,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'result' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $analysistest = Analysistest::create([
            'name' => $request->name,
            'result' => $request->result
        ]);

        return response()->json([
            'analysistest' => $analysistest,
            'status' => 201
        ], 201);
    }

    public function show($idtest)
    {
        $analysistest = Analysistest::find($idtest);

        if (!$analysistest) {
            return response()->json([
                'message' => 'Prueba de análisis no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $idtest)
    {
        $analysistest = Analysistest::find($idtest);

        if (!$analysistest) {
            return response()->json([
                'message' => 'Prueba de análisis no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'result' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $analysistest->name = $request->name;
        $analysistest->result = $request->result;
        $analysistest->save();

        return response()->json([
            'message' => 'Prueba de análisis actualizada',
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $idtest)
    {
        $analysistest = Analysistest::find($idtest);

        if (!$analysistest) {
            return response()->json([
                'message' => 'Prueba de análisis no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'result' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('name')) {
            $analysistest->name = $request->name;
        }

        if ($request->has('result')) {
            $analysistest->result = $request->result;
        }

        $analysistest->save();

        return response()->json([
            'message' => 'Prueba de análisis actualizada parcialmente',
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }
}
