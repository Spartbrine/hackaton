<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|max:255',
            'email' => 'required|email',
            'professional_cell' => 'required|numeric',
            'read' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $notification = Notification::create($request->all());

        if (!$notification) {
            return response()->json([
                'message' => 'Error al crear la notificación',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'notification' => $notification,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $notifications = Notification::all();

        if ($notifications->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron notificaciones',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'notifications' => $notifications,
            'status' => 200
        ], 200);
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
}
