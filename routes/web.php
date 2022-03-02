<?php

use Illuminate\Support\Facades\Route;
use App\Services\Races;
use App\DocumentType;
use App\Product;
use App\Stock;

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

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', function () { return view('auth.login'); });
    Route::get('verify', function () { return view('auth.verify'); });  
    Route::get('activate/{code}', 'UserController@activate');
    Route::post('complete/{id}', 'UserController@complete');  
});

Route::group([
    'middleware' => 'verified',
], function () {
    Route::get('profile', function () { return view('auth.profile'); })->name('profile');
    Route::get('password', function () { return view('auth.passwords.update'); })->name('password');
    Route::post('updateAccount', 'UserController@updateAccount')->name('updateAccount');
    Route::post('changePassword', 'Auth\ChangePasswordController@store')->name('changePassword');
    
    Route::resource('customers', 'CustomerController');
    Route::resource('locations', 'LocationController');
    Route::resource('pets', 'PetController');
    Route::resource('productions', 'ProductionController');
    Route::resource('distributions', 'DistributionController');
    Route::resource('inventories', 'InventoryController');
    Route::resource('receptions', 'ReceptionController');
    Route::resource('sales', 'SaleController');
    Route::resource('saledetails', 'SaleDetailController', ['only' => ['store','destroy']]);

    Route::post('proddetails.update', 'ProductionDetailController@update')->name('proddetails.update');
    Route::post('proddetails.change/{id}', 'ProductionDetailController@change')->name('proddetails.change');

    Route::post('distdetails.update', 'DistributionDetailController@update')->name('distdetails.update');
    Route::post('distdetails.change/{org}/{dst}', 'DistributionDetailController@change')->name('distdetails.change');

    Route::post('invdetails.update', 'InventoryDetailController@update')->name('invdetails.update');
    Route::post('invdetails.change/{id}', 'InventoryDetailController@change')->name('invdetails.change');

    Route::post('recdetails.update', 'ReceptionDetailController@update')->name('recdetails.update');
    Route::get('receptions/verify/{code}', 'ReceptionController@verify')->name('receptions/verify');

    Route::get('races.getByType/{type}', function ($type) { return (new Races)->getJSON($type); });
    Route::get('documentType/{id}', function ($id) { return DocumentType::find($id); });
    Route::get('products.getById/{id}', function ($id) { return Product::find($id); });
    Route::get('stocks.getByCenterId/{id}', function ($id) {
        $details = [];
        $stock = Stock::where('center_id',$id)->latest('date')->first();
        if ($stock)
            foreach ($stock->details as $det)
                $details[] = [
                    'product' => $det->product->name,
                    'code' => $det->product->code,
                    'quantity' => $det->quantity
                ];
        else
            foreach (Product::orderBy('name')->get() as $prod)
                $details[] = [
                    'product' => $prod->name,
                    'code' => $prod->code,
                    'quantity' => 0
                ];
        return $details;
    });
    Route::get('products.getByCode/{code}', 'ProductController@getByCode')->name('products.getByCode');
    Route::get('customers.getByDocument/{doc}', 'CustomerController@getByDocument')->name('customers.getByDocument');
    Route::get('customers.getByMobile/{mob}', 'CustomerController@getByMobile')->name('customers.getByMobile');
    Route::get('customers.searchByFilter', 'CustomerController@searchByFilter')->name('customers.searchByFilter');    
    Route::post('customers.storeFromSale', 'CustomerController@storeFromSale')->name('customers.storeFromSale');    
    Route::post('customers.updateFromSale', 'CustomerController@updateFromSale')->name('customers.updateFromSale');    
    Route::get('customers.getFromSale/{id}', 'CustomerController@getFromSale')->name('customers.getFromSale');    
    Route::get('locations.searchByFilter', 'LocationController@searchByFilter')->name('locations.searchByFilter');
    Route::get('centers.getClosest/{lat}/{lng}', 'CenterController@getClosest')->name('centers.getClosest');
    Route::get('centers.getById/{id}', 'CenterController@getById')->name('centers.getById');
    Route::get('saledetails.getByCode/{code}', 'SaleDetailController@getByCode')->name('saledetails.getByCode');
    Route::post('saledetails.removeDetails', 'SaleDetailController@removeDetails')->name('saledetails.removeDetails');
});

Route::group([
    'middleware' => 'isnt_admin',
], function () {
    Route::get('home', 'HomeController@home')->name('home');
});

Route::group([
    'middleware' => 'is_admin',
    'prefix' => 'admin'
], function () {
    Route::get('home', 'HomeController@adminHome')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('dependents', 'DependentController');
    Route::resource('variations', 'VariationController');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('parameters', 'ParameterController');
    Route::resource('products', 'ProductController');
    Route::resource('centers', 'CenterController');
    Route::resource('promos', 'PromoController');
    Route::resource('promdetails', 'PromoDetailController', ['only' => ['store','destroy']]);
    
    Route::get('documentType/{id}', function ($id) { return DocumentType::find($id); });
    Route::get('products.getById/{id}', function ($id) { return Product::find($id); });
});