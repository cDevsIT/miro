<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DimensionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DimensionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DimensionOption::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $dimensionOptions = $query->orderBy('id', 'desc')->paginate(8);
        $dimensionOptions->appends($request->only('search'));
        return view('admin.products.dimension-options.index', compact('dimensionOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.dimension-options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'diagram' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('dimension-options/thumbnails', 'public');
        }

        if ($request->hasFile('diagram')) {
            $validated['diagram'] = $request->file('diagram')->store('dimension-options/diagrams', 'public');
        }

        DimensionOption::create($validated);

        return redirect()->route('admin.dimension-options.index')
            ->with('success', 'Dimension option created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DimensionOption $dimensionOption)
    {
        return view('admin.products.dimension-options.edit', compact('dimensionOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DimensionOption $dimensionOption)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'diagram' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($dimensionOption->thumbnail) {
                Storage::disk('public')->delete($dimensionOption->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('dimension-options/thumbnails', 'public');
        }

        if ($request->hasFile('diagram')) {
            // Delete old diagram if exists
            if ($dimensionOption->diagram) {
                Storage::disk('public')->delete($dimensionOption->diagram);
            }
            $validated['diagram'] = $request->file('diagram')->store('dimension-options/diagrams', 'public');
        }

        $dimensionOption->update($validated);

        return redirect()->route('admin.dimension-options.index')
            ->with('success', 'Dimension option updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DimensionOption $dimensionOption)
    {
        // Delete associated files
        if ($dimensionOption->thumbnail) {
            Storage::disk('public')->delete($dimensionOption->thumbnail);
        }
        if ($dimensionOption->diagram) {
            Storage::disk('public')->delete($dimensionOption->diagram);
        }

        $dimensionOption->delete();

        return redirect()->route('admin.dimension-options.index')
            ->with('success', 'Dimension option deleted successfully.');
    }
}
