<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FamilyProduct;
use Illuminate\Http\Request;

class FamilyProductController extends Controller
{
    public function index(Request $request)
    {
        $query = FamilyProduct::query();
        if ($request->filled('search')) {
            $query->where('model_no', 'like', '%' . $request->search . '%');
        }
        $familyProducts = $query->orderBy('id', 'desc')->paginate(10);
        $familyProducts->appends($request->only('search'));
        return view('admin.products.family-products.index', compact('familyProducts'));
    }

    public function create()
    {
        return view('admin.products.family-products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_no' => 'required|string|max:255',
            'power' => 'nullable|string|max:255',
            'slot' => 'nullable|string|max:255',
            'dimensions_lwh' => 'nullable|string|max:255',
            'dimensions_qh' => 'nullable|string|max:255',
            'cut_hole_in_mm' => 'nullable|string|max:255',
            'cut_hole_in_diameter' => 'nullable|string|max:255',
            'mounting_type' => 'nullable|string|max:255',
            'voltage' => 'nullable|string|max:255'
        ]);

        FamilyProduct::create($validated);

        return redirect()->route('admin.family-products.index')
            ->with('success', 'Family product created successfully');
    }

    public function edit(FamilyProduct $familyProduct)
    {
        return view('admin.products.family-products.edit', compact('familyProduct'));
    }

    public function update(Request $request, FamilyProduct $familyProduct)
    {
        $validated = $request->validate([
            'model_no' => 'required|string|max:255',
            'power' => 'nullable|string|max:255',
            'slot' => 'nullable|string|max:255',
            'dimensions_lwh' => 'nullable|string|max:255',
            'dimensions_qh' => 'nullable|string|max:255',
            'cut_hole_in_mm' => 'nullable|string|max:255',
            'cut_hole_in_diameter' => 'nullable|string|max:255',
            'mounting_type' => 'nullable|string|max:255',
            'voltage' => 'nullable|string|max:255'
        ]);

        $familyProduct->update($validated);

        return redirect()->route('admin.family-products.index')
            ->with('success', 'Family product updated successfully');
    }

    public function destroy(FamilyProduct $familyProduct)
    {
        $familyProduct->delete();

        return redirect()->route('admin.family-products.index')
            ->with('success', 'Family product deleted successfully');
    }
}
