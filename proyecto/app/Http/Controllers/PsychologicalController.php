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
        $psychological = Psychological::all();

        $data = [
            'psychological' => $psychological,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professional_cell' => 'required|unique:psychological',
            'whatsapp_link' => 'required|unique:psychological'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological = Psychological::create($request->all());

        return response()->json([
            'psychological' => $psychological,
            'status' => 201
        ], 201);
    }

    public function show($professional_cell)
    {
        $psychological = Psychological::find($professional_cell);

        if (!$psychological) {
            return response()->json([
                'message' => 'Psicólogo no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $professional_cell)
    {
        $psychological = Psychological::find($professional_cell);

        if (!$psychological) {
            return response()->json([
                'message' => 'Psicólogo no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'whatsapp_link' => 'unique:psychological'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological->update($request->all());

        return response()->json([
            'message' => 'Psicólogo actualizado',
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $professional_cell)
    {
        $psychological = Psychological::find($professional_cell);

        if (!$psychological) {
            return response()->json([
                'message' => 'Psicólogo no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'whatsapp_link' => 'unique:psychological'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $psychological->update($request->only('whatsapp_link'));

        return response()->json([
            'message' => 'Psicólogo actualizado',
            'psychological' => $psychological,
            'status' => 200
        ], 200);
    }
}
