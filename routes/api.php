<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServiceItemController;
use App\Http\Controllers\Api\BlogCategoryController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\NftBarrierController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\BerriesStructureController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TokenController;

// 1. Service
Route::get('service', [ServiceController::class, 'index']);
Route::post('service', [ServiceController::class, 'store']);
Route::patch('service/{id}', [ServiceController::class, 'update']);
Route::delete('service/{id}', [ServiceController::class, 'destroy']);

// 2. Service Item
Route::get('service_item', [ServiceItemController::class, 'index']);
Route::get('service_item/service_id/{service_id}', [ServiceItemController::class, 'getByServiceId']);
Route::post('service_item', [ServiceItemController::class, 'store']);
Route::patch('service_item/{id}', [ServiceItemController::class, 'update']);
Route::delete('service_item/{id}', [ServiceItemController::class, 'destroy']);

// 3. Blog Categories
Route::get('blog_categories', [BlogCategoryController::class, 'index']);
Route::post('blog_categories', [BlogCategoryController::class, 'store']);
Route::patch('blog_categories/{id}', [BlogCategoryController::class, 'update']);
Route::delete('blog_categories/{id}', [BlogCategoryController::class, 'destroy']);

// 4. Blog
Route::get('blog', [BlogController::class, 'index']);
Route::get('blog/{id}', [BlogController::class, 'show']);
Route::post('blog', [BlogController::class, 'store']);
Route::patch('blog/{id}', [BlogController::class, 'update']);
Route::delete('blog/{id}', [BlogController::class, 'destroy']);

// 5. NFT Barriers
Route::get('nft_barriers', [NftBarrierController::class, 'index']);
Route::post('nft_barriers', [NftBarrierController::class, 'store']);
Route::patch('nft_barriers/{id}', [NftBarrierController::class, 'update']);
Route::delete('nft_barriers/{id}', [NftBarrierController::class, 'destroy']);

// 6. Contact Us
Route::get('contact_us', [ContactUsController::class, 'index']);
Route::post('contact_us', [ContactUsController::class, 'store']);
Route::patch('contact_us/{id}', [ContactUsController::class, 'update']);
Route::delete('contact_us/{id}', [ContactUsController::class, 'destroy']);

// 7. Berries Structure
Route::get('berries_structure', [BerriesStructureController::class, 'index']);
Route::post('berries_structure', [BerriesStructureController::class, 'store']);
Route::patch('berries_structure/{id}', [BerriesStructureController::class, 'update']);
Route::delete('berries_structure/{id}', [BerriesStructureController::class, 'destroy']);

// 8. Admin Login
Route::post('/admin/register', [AdminController::class, 'register']);
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout']);
});

// 9. Ad
Route::get('ad', [AdController::class, 'index']);
Route::post('ad', [AdController::class, 'store']);
Route::patch('ad/{id}', [AdController::class, 'update']);
Route::delete('ad/{id}', [AdController::class, 'destroy']);

// 10. User
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::patch('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

// 11. Token
Route::get('token', [TokenController::class, 'index']);
Route::post('token', [TokenController::class, 'store']);
Route::patch('token/{id}', [TokenController::class, 'update']);
Route::delete('token/{id}', [TokenController::class, 'destroy']);
