<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CategorieController;

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

Route::get('/login', function (){
    return view('login');
})->middleware(['auth'])->name('login');


Route::resource('products', IndexController::class);
Route::controller(IndexController::class)->group(function () {

    Route::get('/', 'home');
    Route::get('/products', 'index')->name('products.index');
    Route::get('categorie/{name}/products', 'index')->name('products.categorie');
    Route::get('/product/{id}', 'show')->name('show');

    Route::get('/product/{id}/edit', 'edit')->name('edit')->middleware('is_admin');
    Route::get('/product/create', 'create')->name('create')->middleware('is_admin');


    Route::patch('/product/{id}', 'update')->middleware('is_admin');
    Route::post('/product', 'store')->middleware('is_admin');
    Route::post('/product/{id}/destroy', 'destroy')->name('products.destroy')->middleware('is_admin');
    Route::post('/product/{id}/actived', 'reactived')->name('products.actived')->middleware('is_admin');



});

Route::controller(RegisterController::class)->group(function () {

    Route::get('/user/register', 'Senregistrer')->name('Senregistrer');
    Route::post('/user/store', 'storeReg')->name('user.storeReg');

});

Route::controller(LoginController::class)->group(function () {

    Route::get('login','form')->name('login');
    Route::get('signout', 'signOut')->name('signout');
    Route::post('custom-login', 'customLogin')->name('login.custom');


});

Route::controller(PanierController::class)->group(function () {


    Route::post('/ajoutPanier/{id}','ajoutPanier')->name('panier.ajout');
    Route::post('/updatePanier/{id}','updatePanier')->name('panier.update');
    Route::get('showPanier','verifPanier')->name('panier.liste');

    Route::delete('destroyPanier','destroyPanier')->name('panier.remove');
    Route::delete('destroyPanierProduct/{id}','destroyPanierProduct')->name('panierProd.remove');



});

Route::controller(OrderController::class)->group(function () {

    Route::get('order/user','showOrder')->name('order.user');
    Route::get('order/list','listOrder')->name('order.list');
    Route::get('order/list/admin','listOrderAdmin')->name('order.admin');
    Route::post('/order/list/admin/update/{id}','orderStatus')->name('order.update');

    Route::post('order/store','addOrder')->name('order.store');


});

Route::controller(AdminController::class)->group(function () {

    Route::get('/admin', 'homeAdmin')->name('admin.home')->middleware('is_admin');
    Route::get('/admin/register', 'registerAdmin')->name('admin.register');
    Route::post('/admin/store', 'storeRegAdmin')->name('admin.storeReg');

    Route::get('/admin/listUser', 'indexUser')->name('admin.userList')->middleware('is_admin');
    Route::get('/admin/showUser/{id}', 'showUser')->name('admin.userShow')->middleware('is_admin');
    Route::get('/admin/product/archive', 'archiveIndex')->name('admin.archive')->middleware('is_admin');



});

Route::controller(ProfilController::class)->group(function () {

    Route::get('/user/profil', 'showProfil')->name('user.profil');
    Route::get('/user/profil/{id}/edit', 'editProfil')->name('user.edit');
    Route::post('/user/profil/{id}','updateProfil')->name('user.update');
    Route::get('/user/profil/{id}/mdp','editMdp')->name('user.identifiant');
    Route::post('/user/profil/{id}/mdp','updateIdentifiant')->name('user.updateId');

});


Route::controller(CategorieController::class)->group(function () {

    Route::get('/admin/categorie', 'indexCat')->name('admin.cat')->middleware('is_admin');
    Route::get('/admin/categorie/create', 'createCat')->name('admin.createCat')->middleware('is_admin');
    Route::get('/admin/categorie/{id}', 'showCat')->name('admin.showCat')->middleware('is_admin');
    Route::get('/admin/categorie/{id}/edit', 'editCat')->name('admin.editCat')->middleware('is_admin');
    Route::post('/admin/categorie/store','storeCat')->name('admin.storeCat')->middleware('is_admin');
    Route::post('/admin/categorie/{id}/update','updateCat')->name('admin.updateCat')->middleware('is_admin');
    Route::post('/admin/categorie/{id}/destroy', 'destroyCat')->name('categorie.destroy')->middleware('is_admin');
    Route::post('/admin/categorie/{id}/actived', 'reactivedCat')->name('categorie.actived')->middleware('is_admin');




});
