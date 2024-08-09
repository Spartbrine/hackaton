<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Controller;
use app\Models\Analysistest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnalysistestController extends Controller
{
    public function index()
    {
        $analysistests = Analysistest::with(['email', 'idquestion', 'idanswer'])->get();

        $data = [
            'analysistests' => $analysistests,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idtest' => 'required',
            'idquestion' => 'required',
            'idanswer' => 'required',
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
                'message' => 'Test no encontrado',
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
                'message' => 'Test no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'idquestion' => 'required',
            'idanswer' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $analysistest->update($request->all());

        return response()->json([
            'message' => 'Test actualizado',
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $idtest)
    {
        $analysistest = Analysistest::find($idtest);

        if (!$analysistest) {
            return response()->json([
                'message' => 'Test no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'idquestion' => 'required',
            'idanswer' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $analysistest->update($request->only('idquestion', 'idanswer', 'email'));

        return response()->json([
            'message' => 'Test actualizado',
            'analysistest' => $analysistest,
            'status' => 200
        ], 200);
    }
}

