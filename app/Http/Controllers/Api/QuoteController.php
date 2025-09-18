<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $customer = auth('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return DB::transaction(function () use ($customer, $request) {
            $code = 'MIRQ' . str_pad((string) (Quote::max('id') + 1), 2, '0', STR_PAD_LEFT);
            $quote = Quote::create([
                'customer_id' => $customer->id,
                'code' => $code,
                'status' => 'pending',
            ]);

            foreach ($request->items as $item) {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return response()->json(['code' => $quote->code], 201);
        });
    }

    public function latest()
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $quote = Quote::with(['items.product'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->first();

        if (!$quote) {
            return response()->json(null);
        }

        return response()->json([
            'code' => $quote->code,
            'status' => $quote->status,
            'items' => $quote->items->map(function ($qi) {
                return [
                    'id' => $qi->product->model_number,
                    'name' => $qi->product->title,
                    'image' => $qi->product->thumbnail ? '/storage/' . $qi->product->thumbnail : null,
                    'quantity' => $qi->quantity,
                ];
            }),
        ]);
    }
}


