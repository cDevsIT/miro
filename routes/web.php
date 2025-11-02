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
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\InsightsController as AdminInsightsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\WishlistController as ApiWishlistController;
use App\Http\Controllers\Api\QuoteController as ApiQuoteController;

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

// Admin Routes - Redirect /dashboard to /admin/dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// Guest Routes (redirect to dashboard if already logged in)
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.auth.login');
})->name('login');

// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin Dashboard Route
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/navigation', function () {
        return view('admin.navigation');
    })->name('navigation');
    
    // Insights Routes
    Route::get('/insights', [AdminInsightsController::class, 'index'])->name('insights');
    Route::get('/insights/messages', [AdminInsightsController::class, 'listMessages'])->name('insights.messages');
    Route::get('/insights/appointments', [AdminInsightsController::class, 'listAppointments'])->name('insights.appointments');
    Route::get('/insights/quotes', [AdminInsightsController::class, 'listQuotes'])->name('insights.quotes');
    Route::get('/insights/message/{id}', [AdminInsightsController::class, 'showMessage'])->name('insights.message');
    Route::post('/insights/message/{id}/read', [AdminInsightsController::class, 'markMessageAsRead'])->name('insights.message.read');
    Route::post('/insights/message/{id}/reply', [AdminInsightsController::class, 'replyToMessage'])->name('insights.message.reply');
    Route::get('/insights/appointment/{id}', [AdminInsightsController::class, 'showAppointment'])->name('insights.appointment');
    Route::put('/insights/appointment/{id}', [AdminInsightsController::class, 'updateAppointment'])->name('insights.appointment.update');
    Route::get('/insights/quote/{id}', [AdminInsightsController::class, 'showQuote'])->name('insights.quote');
    
    // Settings Routes
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password.update');
    
    // Activity Log Routes
    Route::get('/activity', [AdminActivityController::class, 'index'])->name('activity.index');
    Route::post('/activity/clear', [AdminActivityController::class, 'clear'])->name('activity.clear');
    Route::delete('/activity/{id}', [AdminActivityController::class, 'destroy'])->name('activity.destroy');

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

    // Customer Management Routes
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

    // User Management Routes
    Route::resource('users', AdminUserController::class);

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

    Route::post('/profile/update', [CustomerController::class, 'update'])
        ->middleware('auth:customer')
        ->name('mymiro.profile.update');

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

// Wishlist API (customer auth)
Route::middleware('auth:customer')->group(function () {
    Route::get('/api/wishlist', [ApiWishlistController::class, 'index']);
    Route::post('/api/wishlist/toggle', [ApiWishlistController::class, 'toggle']);
    Route::delete('/api/wishlist/{product}', [ApiWishlistController::class, 'destroy']);

    // Quotes
    Route::post('/api/quotes', [ApiQuoteController::class, 'create']);
    Route::get('/api/quotes/latest', [ApiQuoteController::class, 'latest']);
});

require __DIR__.'/auth.php';


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