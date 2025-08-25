<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ReflectorColorController;
use App\Http\Controllers\Admin\DimensionOptionController;
use App\Http\Controllers\Admin\FamilyProductController;
use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\InstallationMethodController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route::get('/admin/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/products', function () {
//     return view('pages.products');
// })->name('products');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');

// Route::get('/my-miro', function () {
//     return view('pages.mymiro');
// })->name('mymiro');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Default Laravel Auth Routes
// Auth::routes();

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin Dashboard Route
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/navigation', function () {
        return view('admin.navigation');
    })->name('admin.navigation');
    
    Route::get('/insights', function () {
        return view('admin.insights');
    })->name('admin.insights');
    
    Route::get('/client', function () {
        return view('admin.client');
    })->name('admin.client');
    
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    
    Route::get('/activity', function () {
        return view('admin.activity');
    })->name('admin.activity');

    // Product Management Routes
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('reflector-colors', ReflectorColorController::class);
    Route::resource('dimension-options', DimensionOptionController::class);
    Route::resource('family-products', FamilyProductController::class);
    Route::resource('accessories', AccessoryController::class);
    Route::resource('installation-methods', InstallationMethodController::class);

    Route::delete('products/images/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');

    Route::delete('categories/{category}/delete-image/{type}', [CategoryController::class, 'deleteImage'])->name('categories.delete-image');
    Route::delete('categories/{category}/banners/{banner}', [CategoryController::class, 'deleteBanner'])->name('categories.banners.destroy');
    Route::post('categories/{category}/banners/reorder', [CategoryController::class, 'reorderBanners'])->name('categories.banners.reorder');

});

// MyMiro Routes
Route::prefix('mymiro')->group(function () {
    // Guest routes
    Route::get('/login', function () {
        return view('pages.mymiro.login');
    })->name('mymiro.login');

    Route::get('/signup', function () {
        return view('pages.mymiro.signup');
    })->name('mymiro.signup');

    // Auth routes for MyMiro
    Route::post('/login', [App\Http\Controllers\Auth\CustomerAuthController::class, 'login'])
        ->name('mymiro.login.submit');

    Route::post('/signup', [App\Http\Controllers\Auth\CustomerAuthController::class, 'register'])
        ->name('mymiro.signup.submit');

    Route::post('/logout', [App\Http\Controllers\Auth\CustomerAuthController::class, 'logout'])
        ->name('mymiro.logout');

    // Main MyMiro route with customer auth check
    Route::get('/', function () {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('mymiro.login');
        }
        return view('pages.mymiro');
    })->name('mymiro.dashboard');

    Route::get('/customer-data', [CustomerController::class, 'getCustomerData'])
        ->middleware('auth:customer');

    Route::post('/book-appointment', [AppointmentController::class, 'store'])
        ->middleware('auth:customer')
        ->name('mymiro.book-appointment');

    Route::post('/appointments/store', [AppointmentController::class, 'store'])
        ->name('mymiro.appointments.store');

    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('mymiro.appointments.index');
});

Route::post('/api/appointments', [AppointmentController::class, 'store'])
    ->middleware('auth:customer');

Route::get('/api/categories/{type}', [ApiCategoryController::class, 'getByType'])
    ->name('api.categories.by-type');

Route::get('/api/categories/{type}/{parentId}', [ApiCategoryController::class, 'getSubcategories'])
    ->name('api.categories.subcategories');

Route::get('/api/product-category/details/{id}', [ApiCategoryController::class, 'getCategoryDetails'])
    ->name('api.categories.details');

Route::get('/api/products/search', [ApiCategoryController::class, 'searchProducts']);
Route::get('/api/products/{modelNumber}', [ProductController::class, 'getByModelNumber']);

require __DIR__.'/auth.php';

Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::get('/blog/{id}', function ($id) {
    return view('pages.blog-details', ['id' => $id]);
})->name('blog.show');

Route::get('installation', function () {
    return view('pages.blog-installation');
})->name('blog.installation');

Route::get('/products/category-details/{id}', [FrontendCategoryController::class, 'show'])->name('category.show');

Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/products/{modelNumber}', function ($modelNumber) {
    return view('pages.product-details', ['modelNumber' => $modelNumber]);
})->name('products.show');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/api/messages', [MessageController::class, 'store'])
    ->middleware('auth:customer')
    ->name('messages.store');

Route::get('/auth-test', function () {
    return view('pages.auth-test');
})->name('auth.test');

Route::get('/about-us', function () {
    return view('pages.about-us');
})->name('about-us');

Route::get('/product-blog', function () {
    $productBlog = [
        'title' => 'Recessed Lighting That Elevates Every Room',
        'subtitle' => 'Minimal Form. Maximum Atmosphere',
        'description' => 'The Miro Recessed Adjustable Ceiling Luminaire isn\'t just another light fixture, it\'s a versatile solution designed to fit seamlessly into modern spaces.',
        'benefits' => 'When it comes to lighting that blends effortlessly into a space while delivering top-tier performance, the Miro Recessed Adjustable Ceiling Luminaire stands out.',
        'features' => 'Miro Lighting Solutions brings together innovation and design, creating lighting that\'s both advanced and beautifully crafted.'
    ];
    
    return view('pages.product-blog', compact('productBlog'));
})->name('product-blog');


Route::get('/products/category/{type}', function ($type) {
    return view('pages.products', ['type' => $type]);
})->name('products.category');