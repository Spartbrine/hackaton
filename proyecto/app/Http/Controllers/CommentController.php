<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron comentarios',
                'status' => 404
            ], 404);
        }

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'email' => 'required|string',
            'publication_id' => 'required|integer|exists:publications,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment = Comment::create([
            'description' => $request->description,
            'email' => $request->email,
            'publication_id' => $request->publication_id
        ]);

        return response()->json([
            'comment' => $comment,
            'status' => 201
        ], 201);
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

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comentario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'publication_id' => 'required|integer|exists:publications,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->publication_id = $request->publication_id;
        $comment->save();

        return response()->json([
            'message' => 'Comentario actualizado',
            'comment' => $comment,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comentario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'string',
            'user_id' => 'integer|exists:users,id',
            'publication_id' => 'integer|exists:publications,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('content')) {
            $comment->content = $request->content;
        }

        if ($request->has('user_id')) {
            $comment->user_id = $request->user_id;
        }

        if ($request->has('publication_id')) {
            $comment->publication_id = $request->publication_id;
        }

        $comment->save();

        return response()->json([
            'message' => 'Comentario actualizado parcialmente',
            'comment' => $comment,
            'status' => 200
        ], 200);
    }
}
