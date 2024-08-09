<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:500',
            'professional_cell' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment = Comment::create($request->all());

        if (!$comment) {
            return response()->json([
                'message' => 'Error al crear el comentario',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'comment' => $comment,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $comments = Comment::all();

        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron comentarios',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'comments' => $comments,
            'status' => 200
        ], 200);
    }

    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comentario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'comment' => $comment,
            'status' => 200
        ], 200);
    }
}
