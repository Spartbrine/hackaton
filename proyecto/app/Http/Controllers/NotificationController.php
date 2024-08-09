<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        if ($notifications->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron notificaciones',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'notifications' => $notifications,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
            'type' => $request->type
        ]);

        return response()->json([
            'notification' => $notification,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notificación no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'notification' => $notification,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notificación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $notification->user_id = $request->user_id;
        $notification->content = $request->content;
        $notification->type = $request->type;
        $notification->save();

        return response()->json([
            'message' => 'Notificación actualizada',
            'notification' => $notification,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notificación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'integer|exists:users,id',
            'content' => 'string',
            'type' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('user_id')) {
            $notification->user_id = $request->user_id;
        }

        if ($request->has('content')) {
            $notification->content = $request->content;
        }

        if ($request->has('type')) {
            $notification->type = $request->type;
        }

        $notification->save();

        return response()->json([
            'message' => 'Notificación actualizada parcialmente',
            'notification' => $notification,
            'status' => 200
        ], 200);
    }
}
