<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/login', [AuthController::class,'loginPage'])->name('loginPage')->middleware("visit_site");
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/register', [AuthController::class,'registerPage'])->name('registerPage')->middleware("visit_site");
Route::post('/register',[UserController::class,'store'])->name('register');

Route::middleware(["auth:sanctum","panel"])->group(function (){
    Route::get('/dashboard', [DashboardController::class,'dashboardPage'])->name('dashboardPage');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    /** Province **/
    Route::group(['prefix' => 'provinces','as' => 'provinces.'],function (){
        Route::get('/',[ProvinceController::class,"index"])->name('index');
        Route::get('/create',[ProvinceController::class,"create"])->name('create');
        Route::post("/store",[ProvinceController::class,"store"])->name('store');
        Route::get('/edit/{id}',[ProvinceController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[ProvinceController::class,"update"])->name('update');
        Route::get("/delete/{id}",[ProvinceController::class,"destroy"])->name('destroy');
    });
    /** City **/
    Route::group(['prefix' => 'cities','as' => 'cities.'],function (){
        Route::get('/',[CityController::class,"index"])->name('index');
        Route::get('/create',[CityController::class,"create"])->name('create');
        Route::post("/store",[CityController::class,"store"])->name('store');
        Route::get('/edit/{id}',[CityController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[CityController::class,"update"])->name('update');
        Route::get("/delete/{id}",[CityController::class,"destroy"])->name('destroy');
    });
    /** Category **/
    Route::group(['prefix' => 'categories','as' => 'categories.'],function (){
        Route::get('/info',[CategoryController::class,"index"])->name('index');
        Route::get('/create',[CategoryController::class,"create"])->name('create');
        Route::post("/store",[CategoryController::class,"store"])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[CategoryController::class,"update"])->name('update');
        Route::get("/delete/{id}",[CategoryController::class,"destroy"])->name('destroy');
        Route::post("/total/delete",[CategoryController::class,"totalDelete"])->name('totalDelete');
    });

    /** User **/
    Route::group(['prefix' => 'users','as' => 'users.'],function (){
        Route::get('/',[UserController::class,"index"])->name('index');
        Route::get('/create',[UserController::class,"create"])->name('create');
        Route::post("/store",[UserController::class,"store"])->name('store');
        Route::get('/edit/{id}',[UserController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[UserController::class,"update"])->name('update');
        Route::get("/delete/{id}",[UserController::class,"destroy"])->name('destroy');
    });

    /** Admin **/
    Route::group(['prefix' => 'admins','as' => 'admins.'],function (){
        Route::get('/',[AdminController::class,"index"])->name('index');
        Route::get('/create',[AdminController::class,"create"])->name('create');
        Route::post("/store",[AdminController::class,"store"])->name('store');
        Route::get('/edit/{id}',[AdminController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[AdminController::class,"update"])->name('update');
        Route::get("/delete/{id}",[AdminController::class,"destroy"])->name('destroy');
    });

    /** Profile **/
    Route::group(['prefix' => 'profile','as' => 'profile.'],function (){
        Route::get('/',[ProfileController::class,"index"])->name('index');
        Route::post("/update/{id}",[ProfileController::class,"update"])->name('update');
    });

    /** Permission **/
    Route::group(['prefix' => 'permissions','as' => 'permissions.'],function (){
        Route::get('/user/{id}',[PermissionController::class,"userPermissions"])->name('userPermissions');
        Route::get('/edit/{id}',[PermissionController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[PermissionController::class,"update"])->name('update');
        Route::get("/delete/{name}/{id}",[PermissionController::class,"destroy"])->name('destroy');
    });

    /** News **/
    Route::group(['prefix' => 'news','as' => 'news.'],function (){
        Route::get('/',[NewsController::class,"index"])->name('index');
        Route::get('/create',[NewsController::class,"create"])->name('create');
        Route::post("/store",[NewsController::class,"store"])->name('store');
        Route::get('/edit/{id}',[NewsController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[NewsController::class,"update"])->name('update');
        Route::get("/delete/{id}",[NewsController::class,"destroy"])->name('destroy');
    });

    /** Activity Log **/
    Route::group(['prefix' => 'logs','as' => 'logs.'],function (){
        Route::get('/',[ActivityLogController::class,"index"])->name('index');
    });

    /** Site Visit **/
    Route::group(['prefix' => 'visits','as' => 'visits.'],function (){
        Route::get('/',[VisitController::class,"index"])->name('index');
        Route::get('/latest/download',[VisitController::class,"downloadList"])->name('downloadList');
    });

    /** Comment **/
    Route::group(['prefix' => 'comments','as' => 'comments.'],function (){
        Route::get('/',[CommentController::class,"index"])->name('index');
    });

    /** Favorite **/
    Route::group(['prefix' => 'favorites','as' => 'favorites.'],function (){
        Route::get('/',[FavoriteController::class,"index"])->name('index');
        Route::post('/',[FavoriteController::class,"store"])->name('store');
        Route::get('/delete/{id}',[FavoriteController::class,"destroy"])->name('destroy');
    });

});

/** City **/
Route::group(['prefix' => 'cities','as' => 'cities.'],function (){
    Route::get('/by/province/{cityId}',[CityController::class,"citiesByProvince"])->name('citiesByProvince');
});

/** Site Pages **/
Route::get('/',[SiteController::class,"index"])->name('site.index')->middleware("visit_site");
Route::get('/detail/{id}/{slug}',[SiteController::class,"detail"])->name('site.detail')->middleware("visit_site");

/** Comment **/
Route::group(['prefix' => 'comments','as' => 'comments.'],function (){
    Route::post('/',[CommentController::class,"store"])->name('store');
});
