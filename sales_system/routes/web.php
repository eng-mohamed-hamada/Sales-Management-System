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

Route::get('/', function () {
    return view('auth/login');
});
Route::group(['middleware' => 'check_permission'], function () {
    Route::get('/employees', 'employee@get_employees');
    Route::post('/employees/add', 'employee@add');
    Route::post('/employees/delete/{national_number}', 'employee@Delete');
    Route::post('/employees/search', 'employee@search');
    Route::post('/employees/get/employee/{national_number}', 'employee@get_employee_data');
    Route::post('/employees/update/{national_number}', 'employee@update');

    Route::get('/suppliers', 'supplier@get_suppliers');
    Route::post('/suppliers/add', 'supplier@add');
    Route::post('/suppliers/delete/{number}', 'supplier@Delete');
    Route::post('/suppliers/search', 'supplier@search');
    Route::post('/suppliers/get/supplier/{number}', 'supplier@get_supplier_data');
    Route::post('/suppliers/update/{number}', 'supplier@update');

    Route::get('/products', 'product@get_products');
    Route::post('/products/add', 'product@add');
    Route::post('/products/delete/{number}', 'product@Delete');
    Route::post('/products/search', 'product@search');
    Route::post('/products/get/product/{number}', 'product@get_product_data');
    Route::post('/products/update/{number}', 'product@update');

    Route::get('/purchases', 'purchase@get_purchases');
    Route::post('/purchases/add', 'purchase@add_bell_product');
    Route::post('/purchases/delete/purchase{number}', 'purchase@Delete_purchase');
    Route::post('/purchases/search', 'purchase@search');
    Route::post('/purchases/get/purchase/{number}', 'purchase@get_purchase_data');
    Route::post('/purchases/update/purchase/{number}', 'purchase@update_purchase');
    Route::post('/purchases/create/bell', 'purchase@create_purchase_bell');

    

    Route::get('/costs', 'cost@get_costs');
    Route::post('/costs/add', 'cost@add');
    Route::post('/costs/delete/{number}', 'cost@Delete');
    Route::post('/costs/search', 'cost@search');
    Route::post('/costs/get/cost/{number}', 'cost@get_cost_data');
    Route::post('/costs/update/{number}', 'cost@update');

    Route::get('/borrows', 'borrow@get_borrows');
    Route::post('/borrows/add', 'borrow@add');
    Route::post('/borrows/delete/{number}', 'borrow@Delete');
    Route::post('/borrows/search', 'borrow@search');
    Route::post('/borrows/get/borrow/{number}', 'borrow@get_borrow_data');
    Route::post('/borrows/update/{number}', 'borrow@update');

    Route::get('/installments', 'installment@get_installments');
    Route::post('/installments/add', 'installment@add');
    Route::post('/installments/search', 'installment@search');
    Route::post('/installments/get/installment/{number}', 'installment@get_installment_data');
    Route::post('/installments/update/{number}', 'installment@update');

    Route::get('/attendees', 'attend@get_attendees');
    Route::post('/attendees/add', 'attend@add');
    Route::post('/attendees/search', 'attend@search');
    Route::post('/attendees/delete/{number}', 'attend@Delete');

    Route::get('/departments', 'department@get_departments');
    Route::post('/departments/add', 'department@add');
    Route::post('/departments/delete/{number}', 'department@Delete');
    Route::post('/departments/search', 'department@search');
    Route::post('/departments/get/department/{number}', 'department@get_department_data');
    Route::post('/departments/update/{number}', 'department@update');

    Route::get('/degrees', 'degrees@get_degrees');
    Route::post('/degrees/add', 'degrees@add');
    Route::post('/degrees/delete/{number}', 'degrees@Delete');
    Route::post('/degrees/search', 'degrees@search');
    Route::post('/degrees/get/degree/{number}', 'degrees@get_degree_data');
    Route::post('/degrees/update/{number}', 'degrees@update');


    Route::get('/categories', 'category@get_categories');
    Route::post('/categories/add', 'category@add');
    Route::post('/categories/delete/{number}', 'category@Delete');
    Route::post('/categories/search', 'category@search');
    Route::post('/categories/get/category/{number}', 'category@get_category_data');
    Route::post('/categories/update/{number}', 'category@update');

    Route::get('/debtes', 'debtes@get_debtes');
    Route::post('/debtes/add', 'debtes@add');
    Route::post('/debtes/delete/{number}', 'debtes@Delete');
    Route::post('/debtes/search', 'debtes@search');
    Route::post('/debtes/get/debtes/{number}', 'debtes@get_debtes_data');
    Route::post('/debtes/update/{number}', 'debtes@update');
    /////
    Route::get('/dues', 'dues@get_dues');
    Route::post('/dues/add', 'dues@add');
    Route::post('/dues/delete/{number}', 'dues@Delete');
    Route::post('/dues/search', 'dues@search');
    Route::post('/dues/get/dues/{number}', 'dues@get_dues_data');
    Route::post('/dues/update/{number}', 'dues@update');
    /////

    Route::get('/accounts', 'account@get_accounts');
    Route::post('/accounts/add', 'account@add');
    Route::post('/accounts/delete/{national_number}', 'account@Delete');
    Route::post('/accounts/search', 'account@search');
    Route::post('/accounts/get/account/{national_number}', 'account@get_account_data');
    Route::post('/accounts/update/{national_number}', 'account@update');

    
    Route::get("/charts", "charts@get_charts");

    Route::get("/info", "info@get_info");
    
});

Route::group(['middleware' => 'auth'], function () {
    Route::post("/get/department/categories", "product@get_department_categories");
    Route::post("/get/category/products", "product@get_category_products");

    Route::get('/sales', 'sales@get_sales');
    Route::post('/sales/add', 'sales@add_bell_product');
    Route::post('/sales/delete/sales{number}', 'sales@Delete_sales');
    Route::post('/sales/delete/bell{number}', 'sales@Delete_bell');
    Route::post('/sales/search', 'sales@search');
    Route::post('/sales/get/sales/{number}', 'sales@get_sales_data');
    Route::post('/sales/update/sales/{number}', 'sales@update_sales');
    Route::post('/sales/create/bell', 'sales@create_sales_bell');
    Route::get("/settings","HomeController@update_get");
    Route::post("/settings","HomeController@update_post");
});
Route::get("/logout", function(){
    Auth::logout();
    return redirect("/login");
});
Auth::routes();


