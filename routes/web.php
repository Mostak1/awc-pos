<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OffOrderController;
use App\Http\Controllers\OffOrderDetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class, 'adminHome'])->name('dashboard');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('subcats/{cid}', [SubcategoryController::class, 'subcats']);
Route::get('order', [MenuController::class, 'order']);
Route::get('catmenu/{id}', [MenuController::class, 'catmenu']);
Route::resources([
    'category' => CategoryController::class,
    'subcategory' =>SubcategoryController ::class,
    'menus' => MenuController::class,
    'tab' => TabController::class,
    'offorder' => OffOrderController::class,
    'setting' => SettingController::class,
    'offorderdetails' => OffOrderDetailsController::class,
    'supplier' => SupplierController::class,
    'material' => MaterialController::class,
    'purchase' => PurchaseController::class,
    'role' => RoleController::class,
    'urole' => UserRoleController::class,
]);

require __DIR__.'/auth.php';
