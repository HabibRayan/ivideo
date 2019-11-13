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
    return view('welcome');
});

Route::get('/test', function () {

  echo Hash::make('11223344');

    $data = \App\Subcategory::all();

});

Auth::routes();

Route::get('/admin/dashboard', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('category','CategoryController@index')->name('admin.category');
    Route::post('category/add','CategoryController@storeCategory')->name('add.category');
    Route::get('category/edit','CategoryController@editCategory')->name('edit.category');
    Route::get('category/delete','CategoryController@deleteCategory')->name('category.delete');
    Route::get('category/search','CategoryController@searchCategory')->name('category.search');


    Route::get('subcategory','SubcategoryController@subcategory')->name('admin.subcategory');
    Route::post('subcategory','SubcategoryController@storeSubcategory')->name('add.subcategory');
    Route::get('subcategory/edit','SubcategoryController@editSubcategory')->name('edit.subcategory');
    Route::get('subcategory/delete','SubcategoryController@deleteSubcategory')->name('subcategory.delete');
    Route::get('subcategory/search','SubcategoryController@searchSubCategory')->name('subcategory.search');


    Route::get('post','PostController@index')->name('admin.post');
    Route::get('post/form','PostController@form')->name('post.form');
    Route::get('getCategory','PostController@getcategory')->name('get.category');
    Route::post('post/add','PostController@storePost')->name('add.post');






});

