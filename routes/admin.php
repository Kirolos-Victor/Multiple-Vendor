<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth:admin','namespace'=>'admin'],function(){
    Route::get('/','AdminDashboardController@index')->name('admin.dashboard');
    Route::resource('languages','LangController');
    Route::resource('main_categories','MainCategoryController');
    Route::get('main_categories/active/{main_category}','MainCategoryController@status')->name('main_categories.status');

    Route::resource('vendors','VendorController');
    Route::get('vendors/active/{vendor}','VendorController@status')->name('vendors.status');

});
//middleware quest admin is soooo important so you dont go to loggin page again
// quest middleware connected to RedirectIfAuthenticated.php page
Route::group(['namespace'=>'Admin','middleware'=>'guest:admin'],function(){
    Route::get('/login','LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','LoginController@login');
});
