<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReflectorColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReflectorColorController extends Controller
{
    public function index()
    {
        $reflectorColors = ReflectorColor::orderBy('order')->get();
        return view('admin.products.reflector-colors.index', compact('reflectorColors'));
    }

    public function create()
    {
        return view('admin.products.reflector-colors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('upload/product/reflector-color', 'public');
            $validated['thumbnail'] = $path;
        }

        ReflectorColor::create($validated);

        return redirect()->route('admin.reflector-colors.index')
            ->with('success', 'Reflector color created successfully');
    }

    public function edit(ReflectorColor $reflectorColor)
    {
        return view('admin.products.reflector-colors.edit', compact('reflectorColor'));
    }

    public function update(Request $request, ReflectorColor $reflectorColor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($reflectorColor->thumbnail) {
                Storage::disk('public')->delete($reflectorColor->thumbnail);
            }
            
            // Store new thumbnail
            $path = $request->file('thumbnail')->store('upload/product/reflector-color', 'public');
            $validated['thumbnail'] = $path;
        }

        $reflectorColor->update($validated);

        return redirect()->route('admin.reflector-colors.index')
            ->with('success', 'Reflector color updated successfully');
    }

    public function destroy(ReflectorColor $reflectorColor)
    {
        // Delete thumbnail
        if ($reflectorColor->thumbnail) {
            Storage::disk('public')->delete($reflectorColor->thumbnail);
        }

        $reflectorColor->delete();

        return redirect()->route('admin.reflector-colors.index')
            ->with('success', 'Reflector color deleted successfully');
    }
}
