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
        $reviews = Review::all();

        if ($reviews->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron reseñas',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'reviews' => $reviews,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $review = Review::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'review' => $review,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'message' => 'Reseña no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'review' => $review,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'message' => 'Reseña no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $review->user_id = $request->user_id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json([
            'message' => 'Reseña actualizada',
            'review' => $review,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'message' => 'Reseña no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'integer|exists:users,id',
            'product_id' => 'integer|exists:products,id',
            'rating' => 'integer|min:1|max:5',
            'comment' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('user_id')) {
            $review->user_id = $request->user_id;
        }

        if ($request->has('product_id')) {
            $review->product_id = $request->product_id;
        }

        if ($request->has('rating')) {
            $review->rating = $request->rating;
        }

        if ($request->has('comment')) {
            $review->comment = $request->comment;
        }

        $review->save();

        return response()->json([
            'message' => 'Reseña actualizada parcialmente',
            'review' => $review,
            'status' => 200
        ], 200);
    }
}
