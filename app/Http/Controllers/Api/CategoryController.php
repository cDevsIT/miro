<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function getByType($type)
    {
        return Category::with('banners')
            ->where('type', $type)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();
    }

    public function getSubcategories($type, $parentId)
    {
        return Category::with('banners')
            ->where('type', $type)
            ->where('parent_id', $parentId)
            ->orderBy('order')
            ->get();
    }

    public function getCategoryDetails($id)
    {
        $category = Category::with(['parent.banners', 'banners'])->findOrFail($id);
        
        $products = Product::whereHas('categories', function($query) use ($id) {
            $query->where('categories.id', $id);
        })
        ->orderBy('order')
        ->paginate(12);
        
        return response()->json([
            'category' => $category,
            'products' => $products->items(),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem()
            ]
        ]);
    }

    public function searchProducts(Request $request)
    {
        $search = $request->input('q');
        if (!$search) {
            return response()->json([]);
        }
        $products = Product::where('model_number', 'like', "%$search%")
            ->orderBy('model_number')
            ->limit(10)
            ->get(['id', 'model_number', 'title', 'thumbnail']);
        return response()->json($products);
    }
}



