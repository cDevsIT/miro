<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccessoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Accessory::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $accessories = $query->orderBy('id', 'desc')->paginate(8);
        $accessories->appends($request->only('search'));
        return view('admin.products.accessories.index', compact('accessories'));
    }

    public function create()
    {
        return view('admin.products.accessories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('upload/product/accessories', 'public');
            $validated['thumbnail'] = $path;
        }

        Accessory::create($validated);

        return redirect()->route('admin.accessories.index')
            ->with('success', 'Accessory created successfully');
    }

    public function edit(Accessory $accessory)
    {
        return view('admin.products.accessories.edit', compact('accessory'));
    }

    public function update(Request $request, Accessory $accessory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($accessory->thumbnail) {
                Storage::disk('public')->delete($accessory->thumbnail);
            }
            
            // Store new thumbnail
            $path = $request->file('thumbnail')->store('upload/product/accessories', 'public');
            $validated['thumbnail'] = $path;
        }

        $accessory->update($validated);

        return redirect()->route('admin.accessories.index')
            ->with('success', 'Accessory updated successfully');
    }

    public function destroy(Accessory $accessory)
    {
        // Delete thumbnail
        if ($accessory->thumbnail) {
            Storage::disk('public')->delete($accessory->thumbnail);
        }

        $accessory->delete();

        return redirect()->route('admin.accessories.index')
            ->with('success', 'Accessory deleted successfully');
    }
}
