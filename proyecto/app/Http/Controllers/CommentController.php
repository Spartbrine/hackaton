<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Controller;
use app\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('email')->get();

        $data = [
            'comments' => $comments,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment = Comment::create($request->all());

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
            'description' => 'max:255',
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment->update($request->all());

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
            'description' => 'max:255',
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $comment->update($request->only('description', 'email'));

        return response()->json([
            'message' => 'Comentario actualizado',
            'comment' => $comment,
            'status' => 200
        ], 200);
    }
}
