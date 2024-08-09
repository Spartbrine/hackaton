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
        $stores = Store::all();

        if ($stores->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron tiendas',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'stores' => $stores,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'owner' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store = Store::create([
            'name' => $request->name,
            'location' => $request->location,
            'owner' => $request->owner
        ]);

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
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'owner' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $store->name = $request->name;
        $store->location = $request->location;
        $store->owner = $request->owner;
        $store->save();

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
            'name' => 'string|max:255',
            'location' => 'string',
            'owner' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('name')) {
            $store->name = $request->name;
        }

        if ($request->has('location')) {
            $store->location = $request->location;
        }

        if ($request->has('owner')) {
            $store->owner = $request->owner;
        }

        $store->save();

        return response()->json([
            'message' => 'Tienda actualizada parcialmente',
            'store' => $store,
            'status' => 200
        ], 200);
    }
}
