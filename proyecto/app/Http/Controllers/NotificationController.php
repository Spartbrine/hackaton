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
        $data = [
            'notifications' => $notifications,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|max:255',
            'email' => 'required|email|exists:users,email',
            'read' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $notification = Notification::create([
            'type' => $request->type,
            'email' => $request->email,
            'read' => $request->read
        ]);

        if (!$notification) {
            $data = [
                'message' => 'Error al crear la notificación',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'notification' => $notification,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'notification' => $notification,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'max:255',
            'email' => 'email|exists:users,email',
            'read' => 'boolean'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('type')) {
            $notification->type = $request->type;
        }

        if ($request->has('email')) {
            $notification->email = $request->email;
        }

        if ($request->has('read')) {
            $notification->read = $request->read;
        }

        $notification->save();

        $data = [
            'message' => 'Notificación actualizada',
            'notification' => $notification,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        return $this->update($request, $id);
    }
}
