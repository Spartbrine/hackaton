<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('email')->get();

        $data = [
            'stores' => $stores,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_publication' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store = Store::create($request->all());

        return response()->json([
            'store' => $store,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $store = Store::find($id);

        if (!$store) {
            return response()->json([
                'message' => 'Tienda no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'store' => $store,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $store = Store::find($id);

        if (!$store) {
            return response()->json([
                'message' => 'Tienda no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_publication' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store->update($request->all());

        return response()->json([
            'message' => 'Tienda actualizada',
            'store' => $store,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $store = Store::find($id);

        if (!$store) {
            return response()->json([
                'message' => 'Tienda no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_publication' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store->update($request->only('id_publication', 'email'));

        return response()->json([
            'message' => 'Tienda actualizada',
            'store' => $store,
            'status' => 200
        ], 200);
    }
}
