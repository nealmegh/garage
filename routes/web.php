<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('reports', 'ReportController@index')->name('reports.index');
        Route::get('reports/vehicle_all', 'ReportController@vehicleAll')->name('reports.vehicle.all');
        Route::get('reports/vehicle_rent', 'ReportController@vehicleRent')->name('reports.vehicle.rent');
        Route::get('reports/vehicle_maintenance', 'ReportController@vehicleMaintenance')->name('reports.vehicle.maintenance');
        Route::get('reports/vehicle_details', 'ReportController@vehicleDetails')->name('reports.vehicle.detail');
        Route::get('reports/driver_all', 'ReportController@driverAll')->name('reports.driver.all');
        Route::get('reports/driver_rents', 'ReportController@driverRents')->name('reports.driver.rent');
        Route::get('reports/driver_finance', 'ReportController@driverFinance')->name('reports.driver.finance');
        Route::get('reports/driver_detail', 'ReportController@driverDetail')->name('reports.driver.detail');
        Route::get('reports/sales_all', 'ReportController@salesAll')->name('reports.sales.all');
        Route::get('reports/inventory_sales', 'ReportController@inventorySales')->name('reports.inventory.sales');
        Route::get('reports/inventory_purchase', 'ReportController@inventoryPurchase')->name('reports.inventory.purchase');
        Route::get('reports/inventory_stock', 'ReportController@inventoryStock')->name('reports.inventory.stock');
        Route::get('reports/transaction_debit', 'ReportController@transactionDebit')->name('reports.transaction.debit');
        Route::get('reports/transaction_credit', 'ReportController@transactionDebit')->name('reports.transaction.credit');
        Route::get('reports/transaction_all', 'ReportController@transactionAll')->name('reports.transaction.all');
    });


});
    Route::get('vehicle/create', 'VehicleController@create')->name('vehicle.create');
    Route::get('vehicles', 'VehicleController@index')->name('vehicle.index');
    Route::post('vehicle/store', 'VehicleController@store')->name('vehicle.store');
    Route::get('vehicle/show/{id}', 'VehicleController@show')->name('vehicle.show');
    Route::get('vehicle/edit/{id}', 'VehicleController@edit')->name('vehicle.edit');
    Route::get('vehicle/sales/create/{id}', 'SalesDetailController@vehicle')->name('vehicle.sales.create');
    Route::post('vehicle/sales/store/{id}', 'SalesDetailController@vehicleSalesStore')->name('vehicle.sales.store');
    Route::post('vehicle/update/{id}', 'VehicleController@update')->name('vehicle.update');
    Route::get('rent/create', 'RentController@create')->name('rent.create');
    Route::get('rent/delete/{id}', 'RentController@destroy')->name('rent.delete');
    Route::post('rent/endTrip', 'RentController@endTrip')->name('rent.end');
    Route::get('rents/', 'RentController@index')->name('rent.index');
    Route::get('rents/archived', 'RentController@archived')->name('rent.archived');
    Route::post('rent/store', 'RentController@store')->name('rent.store');
    Route::get('driver/create', 'DriverController@create')->name('driver.create');
    Route::post('driver/store', 'DriverController@store')->name('driver.store');
    Route::get('drivers/', 'DriverController@index')->name('driver.index');
    Route::get('driver/show/{id}', 'DriverController@show')->name('driver.show');
    Route::get('driver/edit/{id}', 'DriverController@edit')->name('driver.edit');
    Route::post('driver/update/{id}', 'DriverController@update')->name('driver.update');
    Route::get('owner/create', 'OwnerController@create')->name('owner.create');
    Route::post('owner/store', 'OwnerController@store')->name('owner.store');
    Route::get('owner/edit/{id}', 'OwnerController@edit')->name('owner.edit');
    Route::post('owner/update/{id}', 'OwnerController@update')->name('owner.update');
    Route::get('owners/', 'OwnerController@index')->name('owner.index');
    Route::get('transactions', 'TransactionController@index')->name('transaction.index');
    Route::post('transactions/store', 'TransactionController@store')->name('transaction.store');
    Route::get('cases/index', 'IncidentController@index')->name('case.index');
    Route::get('cases/update/{id}', 'IncidentController@update')->name('case.update');
    Route::get('damages/index', 'DamageController@index')->name('damage.index');

Route::group(['prefix' => 'inventory'], function () {
    Route::group(['prefix' => 'supplier'], function () {

        Route::get('/create', 'SupplierController@create')->name('supplier.create');
        Route::post('/store', 'SupplierController@store')->name('supplier.store');
        Route::get('/view', 'SupplierController@view')->name('supplier.view');
        Route::get('/index', 'SupplierController@index')->name('supplier.index');
        Route::get('/show/{id}', 'SupplierController@show')->name('supplier.show');
        Route::get('/edit/{id}', 'SupplierController@edit')->name('supplier.edit');
        Route::post('/update/{id}', 'SupplierController@update')->name('supplier.update');
        Route::get('/destroy/{id}', 'SupplierController@destroy')->name('supplier.destroy');

    });

    Route::group(['prefix' => 'category'], function () {

        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/view', 'CategoryController@view')->name('category.view');
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/show/{id}', 'CategoryController@show')->name('category.show');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');

    });

    Route::group(['prefix' => 'stock'], function () {

        Route::get('/create', 'StockDetailController@create')->name('stock.create');
        Route::post('/store', 'StockDetailController@store')->name('stock.store');
        Route::get('/view', 'StockDetailController@view')->name('stock.view');
        Route::get('/index', 'StockDetailController@index')->name('stock.index');
        Route::get('/show/{id}', 'StockDetailController@show')->name('stock.show');
        Route::get('/edit/{id}', 'StockDetailController@edit')->name('stock.edit');
        Route::post('/update/{id}', 'StockDetailController@update')->name('stock.update');
        Route::get('/destroy/{id}', 'StockDetailController@destroy')->name('stock.destroy');
        Route::get('/view/availability', 'StockDetailController@view_availability')->name('stock.view_availability');
        Route::get('/get/availability', 'StockDetailController@get_availability')->name('stock.get_availability');
        Route::get('/get_stock_count', 'StockDetailController@get_stock_count')->name('stock.get_stock_count');

    });

    Route::group(['prefix' => 'purchase'], function () {

        Route::get('/create', 'PurchaseDetailController@create')->name('purchase.create');
        Route::post('/store', 'PurchaseDetailController@store')->name('purchase.store');
        Route::get('/view', 'PurchaseDetailController@view')->name('purchase.view');
        Route::get('/index', 'PurchaseDetailController@index')->name('purchase.index');
        Route::get('/show/{id}', 'PurchaseDetailController@show')->name('purchase.show');
        Route::get('/edit/{id}', 'PurchaseDetailController@edit')->name('purchase.edit');
        Route::post('/update/{id}', 'PurchaseDetailController@update')->name('purchase.update');
        Route::get('/destroy/{id}', 'PurchaseDetailController@destroy')->name('purchase.destroy');

    });

    Route::group(['prefix' => 'sales'], function () {

        Route::get('/create', 'SalesDetailController@create')->name('sales.create');
        Route::post('/store', 'SalesDetailController@store')->name('sales.store');
        Route::get('/view', 'SalesDetailController@view')->name('sales.view');
        Route::get('/index', 'SalesDetailController@index')->name('sales.index');
        Route::get('/show/{id}', 'SalesDetailController@show')->name('sales.show');
        Route::get('/edit/{id}', 'SalesDetailController@edit')->name('sales.edit');
        Route::post('/update/{id}', 'SalesDetailController@update')->name('sales.update');
        Route::get('/destroy/{id}', 'SalesDetailController@destroy')->name('sales.destroy');

    });
    Route::group(['prefix' => 'customer'], function () {

        Route::get('/create', 'CustomerDetailController@create')->name('customer.create');
        Route::post('/store', 'CustomerDetailController@store')->name('customer.store');
        Route::get('/view', 'CustomerDetailController@view')->name('customer.view');
        Route::get('/index', 'CustomerDetailController@index')->name('customer.index');
        Route::get('/show/{id}', 'CustomerDetailController@show')->name('customer.show');
        Route::get('/edit/{id}', 'CustomerDetailController@edit')->name('customer.edit');
        Route::post('/update/{id}', 'CustomerDetailController@update')->name('customer.update');
        Route::get('/destroy/{id}', 'CustomerDetailController@destroy')->name('customer.destroy');

    });

});
Route::group(['prefix' => 'search'], function () {

    Route::any('/supplier_name', 'PurchaseDetailController@supplier_name');

    Route::any('/stock_name', 'SearchController@stock_name');

    Route::any('/customer_name', 'SalesDetailController@customer_name');

    Route::any('/category_name', 'StockDetailController@category_name');

    Route::any('/purchase_category_name', 'PurchaseDetailController@purchase_category_name');

});
