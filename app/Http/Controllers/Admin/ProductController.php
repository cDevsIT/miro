<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Color;
use App\Models\ReflectorColor;
use App\Models\DimensionOption;
use App\Models\FamilyProduct;
use App\Models\Accessory;
use App\Models\InstallationMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'images']);

        if ($request->filled('search')) {
            $query->where('model_number', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('order', 'desc')->paginate(8);
        // Keep the search term in pagination links
        $products->appends($request->only('search'));
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('order')->get();
        $attributes = Attribute::orderBy('order')->get();
        $colors = Color::orderBy('order')->get();
        $reflectorColors = ReflectorColor::orderBy('order')->get();
        $dimensionOptions = DimensionOption::orderBy('order')->get();
        $familyProducts = FamilyProduct::orderBy('id')->get();
        $accessories = Accessory::orderBy('order')->get();
        $installationMethods = InstallationMethod::orderBy('order')->get();

        return view('admin.products.create', compact(
            'categories',
            'attributes',
            'colors',
            'reflectorColors',
            'dimensionOptions',
            'familyProducts',
            'accessories',
            'installationMethods'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_suffix' => 'nullable|string|max:255',
            'model_number' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|max:2048',
            'brochure' => 'nullable|file|mimes:pdf',
            'view_3d' => 'nullable|file|mimes:pdf',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'product_attributes' => 'nullable|array',
            'product_attributes.*' => 'nullable|string',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'reflector_colors' => 'nullable|array',
            'reflector_colors.*' => 'exists:reflector_colors,id',
            'dimension_options' => 'nullable|array',
            'dimension_options.*' => 'exists:dimension_options,id',
            'family_products' => 'nullable|array',
            'family_products.*' => 'exists:family_products,id',
            'accessories' => 'nullable|array',
            'accessories.*' => 'exists:accessories,id',
            'installation_methods' => 'nullable|array',
            'installation_methods.*' => 'exists:installation_methods,id',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|max:2048'
        ]);


        try {
            DB::beginTransaction();

            // Store thumbnail
            if ($request->hasFile('thumbnail')) {
                $validated['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
            }

            // Store brochure
            if ($request->hasFile('brochure')) {
                $validated['brochure'] = $request->file('brochure')->store('products/brochures', 'public');
            }

            // Store 3D view    
            if ($request->hasFile('view_3d')) {
                $validated['view_3d'] = $request->file('view_3d')->store('products/view_3d', 'public');
            }

            // Create product
            $product = Product::create([
                'title' => $validated['title'],
                'title_suffix' => $validated['title_suffix'],
                'model_number' => $validated['model_number'],
                'description' => $validated['description'],
                'thumbnail' => $validated['thumbnail'],
                'brochure' => $validated['brochure'] ?? null,
                'view_3d' => $validated['view_3d'] ?? null,
                'is_active' => $request->boolean('is_active', true),
                'order' => $validated['order'] ?? 0
            ]);

            // Attach relationships
            if ($request->filled('categories')) {
                $product->categories()->attach($request->categories);
            }


            // Handle attributes
            if ($request->filled('product_attributes')) {
                foreach ($request->product_attributes as $attributeId => $value) {
                    if (!empty($value)) {
                        $product->attributes()->attach($attributeId, ['value' => $value]);
                    }
                }
            }

            // Handle colors
            if ($request->filled('colors')) {
                $product->colors()->attach($request->colors);
            }

            if ($request->filled('reflector_colors')) {
                $product->reflectorColors()->attach($request->reflector_colors);
            }

            if ($request->filled('dimension_options')) {
                $product->dimensionOptions()->attach($request->dimension_options);
            }

            if ($request->filled('family_products')) {
                $product->familyProducts()->attach($request->family_products);
            }

            if ($request->filled('accessories')) {
                $product->accessories()->attach($request->accessories);
            }

            if ($request->filled('installation_methods')) {
                $product->installationMethods()->attach($request->installation_methods);
            }

            // Store product images
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $index => $image) {
                    $path = $image->store('products/images', 'public');
                    $product->images()->create([
                        'image_path' => $path,
                        'order' => $index
                    ]);
                }
            }


            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product creation error: ' . $e->getMessage());
            return back()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load([
            'categories',
            'attributes',
            'colors',
            'reflectorColors',
            'dimensionOptions',
            'familyProducts',
            'accessories',
            'installationMethods',
            'images'
        ]);

        $categories = Category::orderBy('order')->get();
        $attributes = Attribute::orderBy('order')->get();
        $colors = Color::orderBy('order')->get();
        $reflectorColors = ReflectorColor::orderBy('order')->get();
        $dimensionOptions = DimensionOption::orderBy('order')->get();
        $familyProducts = FamilyProduct::orderBy('id')->get();
        $accessories = Accessory::orderBy('order')->get();
        $installationMethods = InstallationMethod::orderBy('name')->get();

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'attributes',
            'colors',
            'reflectorColors',
            'dimensionOptions',
            'familyProducts',
            'accessories',
            'installationMethods'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_suffix' => 'nullable|string|max:255',
            'model_number' => 'required|string|max:255|unique:products,model_number,' . $product->id,
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'brochure' => 'nullable|file|mimes:pdf',
            'view_3d' => 'nullable|file|mimes:pdf',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'product_attributes' => 'nullable|array',
            'product_attributes.*' => 'nullable|string',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'reflector_colors' => 'nullable|array',
            'reflector_colors.*' => 'exists:reflector_colors,id',
            'dimension_options' => 'nullable|array',
            'dimension_options.*' => 'exists:dimension_options,id',
            'family_products' => 'nullable|array',
            'family_products.*' => 'exists:family_products,id',
            'accessories' => 'nullable|array',
            'accessories.*' => 'exists:accessories,id',
            'installation_methods' => 'nullable|array',
            'installation_methods.*' => 'exists:installation_methods,id',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id'
        ]);

        try {
            DB::beginTransaction();

            // Update thumbnail if new one is uploaded
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                $validated['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
            }

            // Update brochure
            if ($request->hasFile('brochure')) {
                if ($product->brochure) {
                    Storage::disk('public')->delete($product->brochure);
                }
                $validated['brochure'] = $request->file('brochure')->store('products/brochures', 'public');
            }

            // Update 3D view
            if ($request->hasFile('view_3d')) {
                if ($product->view_3d) {
                    Storage::disk('public')->delete($product->view_3d);
                }
                $validated['view_3d'] = $request->file('view_3d')->store('products/view_3d', 'public');
            }

            // Update product
            $product->update([
                'title' => $validated['title'],
                'title_suffix' => $validated['title_suffix'],
                'model_number' => $validated['model_number'],
                'description' => $validated['description'],
                'thumbnail' => $validated['thumbnail'] ?? $product->thumbnail,
                'brochure' => $validated['brochure'] ?? $product->brochure,
                'view_3d' => $validated['view_3d'] ?? $product->view_3d,
                'is_active' => $validated['is_active'] ?? true,
                'order' => $validated['order'] ?? 0
            ]);

            // Sync relationships
            if (!empty($validated['categories'])) {
                $product->categories()->sync($validated['categories']);
            } else {
                $product->categories()->detach();
            }

            // Handle attributes
            if (!empty($validated['product_attributes'])) {
                $attributes = [];
                foreach ($validated['product_attributes'] as $attributeId => $value) {
                    if (!empty($value)) {
                        $attributes[$attributeId] = ['value' => $value];
                    }
                }
                $product->attributes()->sync($attributes);
            } else {
                $product->attributes()->detach();
            }

            if (!empty($validated['colors'])) {
                $product->colors()->sync($validated['colors']);
            } else {
                $product->colors()->detach();
            }

            if (!empty($validated['reflector_colors'])) {
                $product->reflectorColors()->sync($validated['reflector_colors']);
            } else {
                $product->reflectorColors()->detach();
            }

            if (!empty($validated['dimension_options'])) {
                $product->dimensionOptions()->sync($validated['dimension_options']);
            } else {
                $product->dimensionOptions()->detach();
            }

            if (!empty($validated['family_products'])) {
                $product->familyProducts()->sync($validated['family_products']);
            } else {
                $product->familyProducts()->detach();
            }

            if (!empty($validated['accessories'])) {
                $product->accessories()->sync($validated['accessories']);
            } else {
                $product->accessories()->detach();
            }

            if (!empty($validated['installation_methods'])) {
                $product->installationMethods()->sync($validated['installation_methods']);
            } else {
                $product->installationMethods()->detach();
            }

            // Handle product images
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $index => $image) {
                    $path = $image->store('products/images', 'public');
                    $product->images()->create([
                        'image_path' => $path,
                        'order' => $index
                    ]);
                }
            }

            // Delete selected images
            if (!empty($validated['delete_images'])) {
                $imagesToDelete = $product->images()->whereIn('id', $validated['delete_images'])->get();
                foreach ($imagesToDelete as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            // Delete thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Delete product images
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Delete the product (this will also delete all relationships due to cascade)
            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    /**
     * Get product details by model number
     */
    public function getByModelNumber($modelNumber)
    {
        try {
            $product = Product::with([
                'categories',
                'attributes',
                'colors',
                'reflectorColors',
                'dimensionOptions',
                'familyProducts',
                'accessories',
                'installationMethods',
                'images'
            ])->where('model_number', $modelNumber)->first();

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found'
                ], 404);
            }

            // Get related products from the same category
            $relatedProducts = Product::with(['images'])
                ->whereHas('categories', function($query) use ($product) {
                    $query->where('categories.id', $product->categories[0]->id);
                })
                ->where('id', '!=', $product->id)
                ->limit(8)
                ->get()
                ->map(function($relatedProduct) {
                    return [
                        'id' => $relatedProduct->id,
                        'title' => $relatedProduct->title,
                        'model_number' => $relatedProduct->model_number,
                        'path' => $relatedProduct->thumbnail ? '/storage/' . $relatedProduct->thumbnail : null
                    ];
                });

            // Format the response
            $formattedProduct = [
                'id' => $product->id,
                'title' => $product->title,
                'title_suffix' => $product->title_suffix,
                'model_number' => $product->model_number,
                'description' => $product->description,
                'thumbnail' => $product->thumbnail,
                'brochure' => $product->brochure,
                'view_3d' => $product->view_3d,
                'is_active' => $product->is_active,
                'categories' => $product->categories->map(function($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'type' => $category->type
                    ];
                }),
                'specifications' => $product->attributes->mapWithKeys(function($attribute) {
                    return [$attribute->name => $attribute->pivot->value];
                }),
                'colors' => $product->colors->map(function($color) {
                    return [
                        'id' => $color->id,
                        'name' => $color->name,
                        'code' => $color->color_code
                    ];
                }),
                'reflector_colors' => $product->reflectorColors->map(function($color) {
                    return [
                        'id' => $color->id,
                        'name' => $color->name,
                        'thumbnail' => $color->thumbnail
                    ];
                }),
                'dimension_options' => $product->dimensionOptions->map(function($option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'thumbnail' => $option->thumbnail,
                        'diagram' => $option->diagram
                    ];
                }),
                'family_products' => $product->familyProducts->map(function($family) {
                    return [
                        'id' => $family->id,
                        'model_number' => $family->model_no,
                        'power' => $family->power,
                        'slot' => $family->slot,
                        'dimensions_lwh' => $family->dimensions_lwh,
                        'dimensions_qh' => $family->dimensions_qh,
                        'cut_hole_in_mm' => $family->cut_hole_in_mm,
                        'cut_hole_in_diameter' => $family->cut_hole_in_diameter,
                        'voltage' => $family->voltage,
                        'mounting_type' => $family->mounting_type,
                    ];
                }),
                'accessories' => $product->accessories->map(function($accessory) {
                    return [
                        'id' => $accessory->id,
                        'name' => $accessory->name,
                        'thumbnail' => $accessory->thumbnail,
                    ];
                }),
                'installation_methods' => $product->installationMethods->map(function($method) {
                    return [
                        'id' => $method->id,
                        'name' => $method->name,
                        'thumbnail' => $method->thumbnail
                    ];
                }),
                'images' => $product->images->map(function($image) {
                    return [
                        'id' => $image->id,
                        'path' => $image->image_path,
                        'order' => $image->order
                    ];
                }),
                'relatedProducts' => $relatedProducts
            ];

            return response()->json($formattedProduct);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching product details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
    
        // Delete the image file from storage
        Storage::disk('public')->delete($image->image_path);
    
        // Delete the database record
        $image->delete();
    
        // If the request expects JSON (AJAX), return JSON
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
    
        // Otherwise, fallback to redirect (for non-AJAX)
        return back()->with('success', 'Product image deleted successfully.');
    }
}
