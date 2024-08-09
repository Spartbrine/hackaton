<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_publication' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store = Store::create($request->all());

        if (!$store) {
            return response()->json([
                'message' => 'Error al crear la tienda',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'store' => $store,
            'status' => 201
        ], 201);
    }

    public function index()
    {
        $stores = Store::all();

        if ($stores->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron tiendas',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'stores' => $stores,
            'status' => 200
        ], 200);
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
}
