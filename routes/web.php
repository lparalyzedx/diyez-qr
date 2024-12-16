<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Back\AccountController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\CompanyController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LocaleController;
use App\Http\Controllers\Back\NotificationController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\SettingsController;
use App\Http\Controllers\Back\ThemeController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\VariantController;
use App\Http\Controllers\Front\MenuController;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('artisan',function(){
    Artisan::call('storage:link');
});

Route::middleware('account')->group(function(){
    Route::get('menu/{accountSlug}',[MenuController::class,'index'])->name('menu');
    Route::get('menu/{accountSlug}/kategori/{slug}',[MenuController::class,'category'])->name('category');
    Route::get('menu/{accountSlug}/urun/{slug}',[MenuController::class,'product'])->name('product');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
    Route::get('kaydol',[AuthController::class,'register'])->name('register');
    Route::post('kaydol', [AuthController::class, 'register_post'])->name('register.post');
    Route::get('sifremi-unuttum', [ResetPasswordController::class, 'forgot'])->name('forgot');
    Route::post('sifremi-unuttum', [ResetPasswordController::class, 'forgot_post'])->name('password.email');
    Route::get('sifreyi-sifirla/{token}', [ResetPasswordController::class, 'reset_request'])->name('password.reset');
    Route::post('sifreyi-sifirla', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('sifreyi/dogrula/{email}', [ResetPasswordController::class, 'password_send'])->name('password.send');
});


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'profile_update'])->name('profile.update');
    Route::put('profile/email', [ProfileController::class, 'email_update'])->name('profile.email');
    Route::put('profile/password', [ProfileController::class, 'password_update'])->name('profile.password');
   
    
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories-json', [CategoryController::class, 'json'])->name('categories.json');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::post('categories/sort', [CategoryController::class, 'sort'])->name('categories.sort');
    Route::post('categories/sorting',[CategoryController::class,'sorting'])->name('categories.sorting');
    Route::get('categories/list',[CategoryController::class,'list'])->name('categories.list');
    Route::get('categories/{id}',[CategoryController::class,'show'])->name('categories.show');
    Route::put('categories/{id}',[CategoryController::class,'update'])->name('categories.update');
    Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::post('update-category-name/{id}', [CategoryController::class, 'updateName'])->name('categories.updateName');
    Route::post('update-category-status/{id}', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('products/update-prices', [ProductController::class, 'updatePrices'])->name('products.updateprices');
    Route::post('products/sort', [ProductController::class, 'sort'])->name('products.sort');
    Route::post('products/sorting',[ProductController::class,'sorting'])->name('products.sorting');
    Route::get('categories/{id}/list',[ProductController::class,'list'])->name('products.list');
    Route::get('products/{id}',[ProductController::class,'show'])->name('products.show');
    Route::put('products/{id}',[ProductController::class,'update'])->name('products.update');
    Route::get('products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');
    Route::post('update-product-price/{id}', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
    Route::post('update-product-name/{id}', [ProductController::class, 'updateName'])->name('products.updateName');
    Route::post('update-product-status/{id}', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    Route::post('update-product-category/{id}',[ProductController::class,'updateCategory'])->name('products.updateCategory');

    Route::get('products/{productID}/variants',[VariantController::class,'index'])->name('variants.index');
    Route::post('products/{productID}/variants',[VariantController::class,'store'])->name('variants.store');
    Route::get('products/{productID}/variants/{variantID}',[VariantController::class,'show'])->name('variants.show');
    Route::put('products/{productID}/variants/{variantID}',[VariantController::class,'update'])->name('variants.update');
    Route::get('products/{productID}/variants/{variantID}/delete',[VariantController::class,'destroy'])->name('variants.delete');

    Route::get('locales',[LocaleController::class,'index'])->name('locales.index');



   Route::middleware(['role:root'])->group(function(){
       Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
       Route::post('accounts', [AccountController::class, 'store'])->name('accounts.store');
       Route::post('update-account-status/{id}', [AccountController::class, 'updateStatus'])->name('accounts.updateStatus');
       Route::get('accounts/{id}',[AccountController::class,'show'])->name('accounts.show');
       Route::put('accounts/{id}',[AccountController::class,'update'])->name('accounts.update');
       Route::get('accounts/{id}/delete', [AccountController::class, 'destroy'])->name('accounts.delete');
       
       Route::get('generate-token/{id}', [AuthController::class, 'generateToken']);
       Route::get('login-with-token', [AuthController::class, 'loginWithToken']);

       Route::get('settings', [SettingsController::class, 'index'])->name('setting.index');
       Route::put('settings', [SettingsController::class, 'update'])->name('setting.update');
   });

    Route::get('notifications', [NotificationController::class, 'notification'])->name('notification.notification');
    Route::get('notifications/check', [NotificationController::class, 'check'])->name('notification.check');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}',[UserController::class,'show'])->name('users.show');
    Route::put('users/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('company/general-settings', [CompanyController::class, 'index'])->name('company_settings.index');
    Route::put('company/general-settings', [CompanyController::class, 'update'])->name('company_settings.update');

    Route::get('company/theme-settings',[ThemeController::class,'index'])->name('theme_settings.index');
    Route::put('company/theme-settings',[ThemeController::class,'update'])->name('theme_settings.update');

    Route::post('district', [CompanyController::class, 'district'])->name('district');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
