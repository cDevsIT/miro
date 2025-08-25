<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();
        return view('admin.products.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.products.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'banners.*' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
            'type' => 'required|in:indoor,outdoor',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('categories/thumbnails', 'public');
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('categories/banners', 'public');
        }

        $category = Category::create($validated);

        // Handle multiple banner uploads
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $index => $bannerFile) {
                $imagePath = $bannerFile->store('categories/banners', 'public');
                CategoryBanner::create([
                    'category_id' => $category->id,
                    'image_path' => $imagePath,
                    'alt_text' => $category->name . ' Banner ' . ($index + 1),
                    'order' => $index
                ]);
            }
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();
        return view('admin.products.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'banners.*' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
            'type' => 'required|in:indoor,outdoor',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:categories,id',
            'remove_thumbnail' => 'nullable|boolean',
            'remove_banner' => 'nullable|boolean'
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('categories/thumbnails', 'public');
        } elseif ($request->input('remove_thumbnail')) {
            if ($category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
            }
            $validated['thumbnail'] = null;
        }

        if ($request->hasFile('banner')) {
            if ($category->banner) {
                Storage::disk('public')->delete($category->banner);
            }
            $validated['banner'] = $request->file('banner')->store('categories/banners', 'public');
        } elseif ($request->input('remove_banner')) {
            if ($category->banner) {
                Storage::disk('public')->delete($category->banner);
            }
            $validated['banner'] = null;
        }

        $category->update($validated);

        // Handle multiple banner uploads
        if ($request->hasFile('banners')) {
            $existingBanners = $category->banners()->count();
            foreach ($request->file('banners') as $index => $bannerFile) {
                $imagePath = $bannerFile->store('categories/banners', 'public');
                CategoryBanner::create([
                    'category_id' => $category->id,
                    'image_path' => $imagePath,
                    'alt_text' => $category->name . ' Banner ' . ($existingBanners + $index + 1),
                    'order' => $existingBanners + $index
                ]);
            }
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->thumbnail) {
            Storage::disk('public')->delete($category->thumbnail);
        }
        if ($category->banner) {
            Storage::disk('public')->delete($category->banner);
        }

        // Delete all banner images
        foreach ($category->banners as $banner) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function deleteBanner(Category $category, CategoryBanner $banner)
    {
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return response()->json(['success' => true]);
    }

    public function deleteImage(Category $category, $type)
    {
        try {
            if ($type === 'thumbnail' && $category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
                $category->update(['thumbnail' => null]);
            } elseif ($type === 'banner' && $category->banner) {
                Storage::disk('public')->delete($category->banner);
                $category->update(['banner' => null]);
            } else {
                return response()->json(['message' => 'Image not found'], 404);
            }

            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete image'], 500);
        }
    }

    public function reorderBanners(Request $request, Category $category)
    {
        $request->validate([
            'banner_ids' => 'required|array',
            'banner_ids.*' => 'exists:category_banners,id'
        ]);

        foreach ($request->banner_ids as $index => $bannerId) {
            CategoryBanner::where('id', $bannerId)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
} 