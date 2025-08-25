<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('order')->get();
        return view('admin.products.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.products.colors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string|max:7',
            'order' => 'nullable|integer'
        ]);

        Color::create($validated);

        return redirect()->route('admin.colors.index')->with('success', 'Color created successfully');
    }

    public function edit(Color $color)
    {
        return view('admin.products.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string|max:7',
            'order' => 'nullable|integer'
        ]);

        $color->update($validated);

        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully');
    }
}
