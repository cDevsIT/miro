<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallationMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstallationMethodController extends Controller
{
    public function index()
    {
        $installationMethods = InstallationMethod::orderBy('order')->get();
        return view('admin.products.installation-methods.index', compact('installationMethods'));
    }

    public function create()
    {
        return view('admin.products.installation-methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('upload/product/installation-methods', $thumbnailName, 'public');
            $data['thumbnail'] = $path;
        }

        InstallationMethod::create($data);

        return redirect()->route('admin.installation-methods.index')
            ->with('success', 'Installation method created successfully.');
    }

    public function edit(InstallationMethod $installationMethod)
    {
        return view('admin.products.installation-methods.edit', compact('installationMethod'));
    }

    public function update(Request $request, InstallationMethod $installationMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($installationMethod->thumbnail) {
                Storage::disk('public')->delete($installationMethod->thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('upload/product/installation-methods', $thumbnailName, 'public');
            $data['thumbnail'] = $path;
        }

        $installationMethod->update($data);

        return redirect()->route('admin.installation-methods.index')
            ->with('success', 'Installation method updated successfully.');
    }

    public function destroy(InstallationMethod $installationMethod)
    {
        if ($installationMethod->thumbnail) {
            Storage::disk('public')->delete($installationMethod->thumbnail);
        }

        $installationMethod->delete();

        return redirect()->route('admin.installation-methods.index')
            ->with('success', 'Installation method deleted successfully.');
    }
}
