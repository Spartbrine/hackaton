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

    $publications = Publication::orderBy('created_at', 'desc')->get();

    if ($publications->isEmpty()) {
        return response()->json([
            'message' => 'No se encontraron publicaciones',
            'status' => 404
        ], 404);
    }

    return response()->json($publications);
}


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'email' => 'required|string',
            'id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication = Publication::create([
            'description' => $request->description,
            'email' => $request->email,
            'id' => $request->id
        ]);

        return response()->json([
            'publication' => $publication,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        // $publication = Publication::find($id);
        $publication = Publication::with('comments')->findOrFail($id);

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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $publication->title = $request->title;
        $publication->content = $request->content;
        $publication->user_id = $request->user_id;
        $publication->save();

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
            'title' => 'string|max:255',
            'content' => 'string',
            'user_id' => 'integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('title')) {
            $publication->title = $request->title;
        }

        if ($request->has('content')) {
            $publication->content = $request->content;
        }

        if ($request->has('user_id')) {
            $publication->user_id = $request->user_id;
        }

        $publication->save();

        return response()->json([
            'message' => 'Publicación actualizada parcialmente',
            'publication' => $publication,
            'status' => 200
        ], 200);
    }
}
