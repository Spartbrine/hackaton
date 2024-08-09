<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'email' => 'required|email',
            'interaction' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication = Publication::create($request->all());

        if (!$publication) {
            return response()->json([
                'message' => 'Error al crear la publicación',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'publication' => $publication,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $publications = Publication::all();

        if ($publications->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron publicaciones',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'publications' => $publications,
            'status' => 200
        ], 200);
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
}
