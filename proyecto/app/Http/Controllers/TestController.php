<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'option1' => 'required|max:255',
            'option2' => 'required|max:255',
            'option3' => 'max:255',
            'option4' => 'max:255',
            'option5' => 'max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $test = Test::create($request->all());

        if (!$test) {
            return response()->json([
                'message' => 'Error al crear el test',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'test' => $test,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $tests = Test::all();

        if ($tests->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron tests',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'tests' => $tests,
            'status' => 200
        ], 200);
    }

    public function show($id)
    {
        $test = Test::find($id);

        if (!$test) {
            return response()->json([
                'message' => 'Test no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'test' => $test,
            'status' => 200
        ], 200);
    }
}
