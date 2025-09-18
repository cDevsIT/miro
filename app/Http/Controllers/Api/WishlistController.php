<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $items = $customer->wishlist()->with('images')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'model_number' => $product->model_number,
                'thumbnail' => $product->thumbnail,
            ];
        });

        return response()->json($items);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $customer = auth('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $productId = (int) $request->input('product_id');

        $exists = $customer->wishlist()->where('product_id', $productId)->exists();
        if ($exists) {
            $customer->wishlist()->detach($productId);
            return response()->json(['status' => 'removed']);
        } else {
            $customer->wishlist()->attach($productId);
            return response()->json(['status' => 'added']);
        }
    }

    public function destroy(Product $product)
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $customer->wishlist()->detach($product->id);
        return response()->json(['status' => 'removed']);
    }
}


