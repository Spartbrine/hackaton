<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('email')->get();

        $data = [
            'publications' => $publications,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'email' => 'required|email',
            'interaction' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication = Publication::create($request->all());

        return response()->json([
            'publication' => $publication,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $publication = Publication::find($id);

        if (!$publication) {
            return response()->json([
                'message' => 'Publicación no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'publication' => $publication,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::find($id);

        if (!$publication) {
            return response()->json([
                'message' => 'Publicación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'max:255',
            'email' => 'email',
            'interaction' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication->update($request->all());

        return response()->json([
            'message' => 'Publicación actualizada',
            'publication' => $publication,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $publication = Publication::find($id);

        if (!$publication) {
            return response()->json([
                'message' => 'Publicación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'max:255',
            'email' => 'email',
            'interaction' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication->update($request->only('description', 'email', 'interaction'));

        return response()->json([
            'message' => 'Publicación actualizada',
            'publication' => $publication,
            'status' => 200
        ], 200);
    }
}
