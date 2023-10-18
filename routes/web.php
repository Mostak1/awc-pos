<?php

use App\Http\Controllers\CardProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPrepaidCardController;
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
use App\Models\Category;
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

// Route::get('/linkstorage', function () {
//     $targetFolder = base_path().'/storage/app/public';
//     $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
//     symlink($targetFolder, $linkFolder);
    
//  });

// Public User Route
Route::get('cardinfo', [CustomerController::class, 'cardinfo']);
Route::post('getcardinfo', [CustomerController::class, 'getcardinfo'])->name('getcardinfo');
// Route::group(['middleware' => ['auth', 'permission']], function() {
Route::middleware(['auth'])->group(function () {
Route::get('/catorder', function () {
    $cats = Category::get();
    return view('offorder.catorder', compact('cats'));
});
    Route::get('/',[HomeController::class, 'adminHome'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('offorderdaily', [OffOrderController::class, 'dailyreport']);
    Route::get('dailyreport', [OffOrderDetailsController::class, 'dailyreport']);
    Route::get('subcats/{cid}', [SubcategoryController::class, 'subcats']);
    Route::get('order', [MenuController::class, 'order']);
    Route::get('catmenu/{id}', [MenuController::class, 'catmenu']);
    Route::get('menu', [MenuController::class, 'menu']);
    Route::post('cardcheck', [CustomerController::class, 'cardcheck'])->name('cardcheck');
   

    // all logs
    Route::get('offorderlog', [OffOrderController::class, 'logs']);
    Route::get('menulog', [MenuController::class, 'logs']);

    Route::post('order',[OffOrderController::class, '']);
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
        'card' => CustomerPrepaidCardController::class,
        'cardp' => CardProductController::class,
        'customer' => CustomerController::class
    ]);

   
});

require __DIR__.'/auth.php';
