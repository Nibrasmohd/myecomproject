<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatogoryController;
use App\Http\Controllers\Admin\CoupemController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColourController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CostomerController;
use App\Http\Controllers\Admin\HomeBannerController;


use App\Http\Controllers\front\FrontController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontController::class,'index']);
Route::get('product/{id}', [FrontController::class,'product']);
Route::get('search/{id}', [FrontController::class,'search']);
Route::get('category/{id}', [FrontController::class,'category']);
Route::post('/addtocart', [FrontController::class,'add_to_cart']);
Route::get('/deletecart', [FrontController::class,'delete_cart']);
Route::get('/cart', [FrontController::class,'cart']);
Route::get('/registration', [FrontController::class,'registration']);
Route::post('/registration_process', [FrontController::class,'registration_process']);
Route::post('/login_process', [FrontController::class,'login_process']);
Route::get('/logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    return redirect('/');   
});

Route::get('/admin', [AdminController::class,'index']);
Route::post('/admin/auth', [AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
    Route::get('/admin/Catogory', [CatogoryController::class,'index']);
    Route::get('/admin/Catogory/manage_category', [CatogoryController::class,'manage_category']);
    Route::get('/admin/Catogory/manage_category/{id}', [CatogoryController::class,'manage_category']);
    Route::post('/admin/manage_category_process', [CatogoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('/admin/Catogory/delete/{id}', [CatogoryController::class,'delete_catogory']);
    Route::get('/admin/Catogory/status/{type}/{id}', [CatogoryController::class,'status_catogory']);
    
   
    Route::get('/admin/Coupem', [CoupemController::class,'index']);
    Route::get('/admin/Coupem/manage_coupen', [CoupemController::class,'manage_coupen']);
    Route::get('/admin/Coupem/manage_coupen/{id}', [CoupemController::class,'manage_coupen']);
    Route::post('/admin/Coupem/manage_coupen_process', [CoupemController::class,'manage_coupen_process'])->name('coloumaddanupdateprocess');
    Route::get('/admin/Coupem/delete/{id}', [CoupemController::class,'delete_colum']);
    Route::get('/admin/Coupem/status/{type}/{id}', [CoupemController::class,'status_coupen']);



    Route::get('/admin/Size', [SizeController::class,'index']);
    Route::get('/admin/Size/size_manage', [SizeController::class,'manage_size']);
    Route::get('/admin/Size/size_manage/{id}', [SizeController::class,'manage_size']);
    Route::post('/admin/Size/manage_size_process', [SizeController::class,'manage_size_process'])->name('sizeprocess');
    Route::get('/admin/Size/delete/{id}', [SizeController::class,'delete_size']);
    Route::get('/admin/Size/status/{type}/{id}', [SizeController::class,'status_size']);

    Route::get('/admin/Colour', [ColourController::class,'index']);
    Route::get('/admin/Colour/Colour_manage', [ColourController::class,'manage_Colour']);
    Route::get('/admin/Colour/Colour_manage/{id}', [ColourController::class,'manage_Colour']);
    Route::post('/admin/Colour/manage_Colour_process', [ColourController::class,'manage_Colour_process'])->name('Colourprocess');
    Route::get('/admin/Colour/delete/{id}', [ColourController::class,'delete_Colour']);
    Route::get('/admin/Colour/status/{type}/{id}', [ColourController::class,'status_Colour']);

    Route::get('/admin/Product', [ProductController::class,'index']);
    Route::get('/admin/Product/manage_Product', [ProductController::class,'manage_Product']);
    Route::get('/admin/Product/Product_manage/{id}', [ProductController::class,'manage_Product']);
    Route::post('/admin/Product/manage_Product_process', [ProductController::class,'manage_Product_process'])->name('Productprocess');
    Route::get('/admin/Product/delete/{id}', [ProductController::class,'delete_Product']);
    Route::get('/admin/Product/status/{type}/{id}', [ProductController::class,'status_Product']);

    Route::get('/admin/Product_attr_delete/{id}/{pid}', [ProductController::class,'delete_Product_attr']);
    Route::get('/admin/Product_attr_image_delete/{id}/{pid}', [ProductController::class,'delete_Product_image']);
    

    Route::get('/admin/Brand', [BrandController::class,'index']);
    Route::get('/admin/Brand/manage_Brand', [BrandController::class,'manage_Brand']);
    Route::get('/admin/Brand/Brand_manage/{id}', [BrandController::class,'manage_Brand']);
    Route::post('/admin/Brand/manage_Brand_process', [BrandController::class,'manage_Brand_process'])->name('Brandprocess');
    Route::get('/admin/Brand/delete/{id}', [BrandController::class,'delete_Brand']);
    Route::get('/admin/Brand/status/{type}/{id}', [BrandController::class,'status_Brand']);

    Route::get('/admin/Tax', [TaxController::class,'index']);
    Route::get('/admin/Tax/manage_Tax', [TaxController::class,'manage_Tax']);
    Route::get('/admin/Tax/Tax_manage/{id}', [TaxController::class,'manage_Tax']);
    Route::post('/admin/Tax/manage_Tax_process', [TaxController::class,'manage_Tax_process'])->name('Taxprocess');
    Route::get('/admin/Tax/delete/{id}', [TaxController::class,'delete_Tax']);
    Route::get('/admin/Tax/status/{type}/{id}', [TaxController::class,'status_Tax']);

    Route::get('/admin/Costomer', [CostomerController::class,'index']);
    Route::get('/admin/Costomer/delete/{id}', [CostomerController::class,'delete_Costomer']);
    Route::get('/admin/Costomer/status/{type}/{id}', [CostomerController::class,'status_Costomer']);
    Route::get('/admin/Costomer/view/{id}', [CostomerController::class,'view_Costomer']);
    
    Route::get('/admin/HomeBanner', [HomeBannerController::class,'index']);
    Route::get('/admin/HomeBanner/manage_HomeBanner', [HomeBannerController::class,'manage_HomeBanner']);
    Route::get('/admin/HomeBanner/HomeBanner_manage/{id}', [HomeBannerController::class,'manage_HomeBanner']);
    Route::post('/admin/HomeBanner/manage_HomeBanner_process', [HomeBannerController::class,'manage_HomeBanner_process'])->name('HomeBannerprocess');
    Route::get('/admin/HomeBanner/delete/{id}', [HomeBannerController::class,'delete_HomeBanner']);
    Route::get('/admin/HomeBanner/status/{type}/{id}', [HomeBannerController::class,'status_HomeBanner']);
    
   







    Route::get('/admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_id');
        session()->flash('error','Logot succefully');
        return redirect('admin');
        
    });
   
});

