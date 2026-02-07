<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'intro' => 'required|string',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle feature image upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('blogs/features', 'public');
        }

        // Process sections
        $sections = [];
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $section) {
                $sectionData = [
                    'type' => $section['type'],
                    'order' => $index,
                ];

                if ($section['type'] === 'full_image') {
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('blogs/sections', 'public');
                    }
                } elseif ($section['type'] === 'text') {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                } elseif (in_array($section['type'], ['right_image', 'left_image'])) {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('blogs/sections', 'public');
                    }
                }

                $sections[] = $sectionData;
            }
        }

        $validated['sections'] = $sections;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'intro' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle feature image upload
        if ($request->hasFile('feature_image')) {
            // Delete old image
            if ($blog->feature_image) {
                Storage::disk('public')->delete($blog->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('blogs/features', 'public');
        }

        // Process sections
        $sections = [];
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $section) {
                $sectionData = [
                    'type' => $section['type'],
                    'order' => $index,
                ];

                if ($section['type'] === 'full_image') {
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('blogs/sections', 'public');
                    } elseif (isset($section['existing_image'])) {
                        $sectionData['image'] = $section['existing_image'];
                    }
                } elseif ($section['type'] === 'text') {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                } elseif (in_array($section['type'], ['right_image', 'left_image'])) {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('blogs/sections', 'public');
                    } elseif (isset($section['existing_image'])) {
                        $sectionData['image'] = $section['existing_image'];
                    }
                }

                $sections[] = $sectionData;
            }
        }

        $validated['sections'] = $sections;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete feature image
        if ($blog->feature_image) {
            Storage::disk('public')->delete($blog->feature_image);
        }

        // Delete section images
        if ($blog->sections) {
            foreach ($blog->sections as $section) {
                if (isset($section['image'])) {
                    Storage::disk('public')->delete($section['image']);
                }
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
