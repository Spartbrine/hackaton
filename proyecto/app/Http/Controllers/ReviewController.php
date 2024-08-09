<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('email')->get();

        $data = [
            'reviews' => $reviews,
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
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $review = Review::create([
            'description' => $request->description,
            'email' => $request->email
        ]);

        if (!$review) {
            $data = [
                'message' => 'Error al crear la reseña',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'review' => $review,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $review = Review::with('email')->find($id);

        if (!$review) {
            $data = [
                'message' => 'Reseña no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'review' => $review,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            $data = [
                'message' => 'Reseña no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $review->description = $request->description;
        $review->email = $request->email;

        $review->save();

        $data = [
            'message' => 'Reseña actualizada',
            'review' => $review,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            $data = [
                'message' => 'Reseña no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('description')) {
            $review->description = $request->description;
        }

        if ($request->has('email')) {
            $review->email = $request->email;
        }

        $review->save();

        $data = [
            'message' => 'Reseña actualizada',
            'review' => $review,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
