<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontEndController@index');
Route::get('products/{id}','FrontEndController@showSubmenuItem');
Route::get('products/{slug}/details','FrontEndController@showProductDetail')->name('products.details');

Auth::routes();

// Route::get('/test',function(){
//     dd(App\Post::find(14)->category);
// });


Route::group(['prefix' => 'admin','middleware'=>'auth'], function () { 
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/posts/trashed','PostsController@trashed')->name('posts.trashed');
    Route::get('/posts/trash/{id}','PostsController@trash')->name('posts.trash');
    Route::get('/posts/restore/{id}','PostsController@restore')->name('posts.restore');
    Route::resource('/posts', 'PostsController');
    Route::resource('main_menus', 'MainmenusController');
    Route::resource('submenus', 'SubmenusController');
    Route::resource('tags', 'TagsController');
    Route::resource('users','UsersController');
    Route::resource('profiles', 'ProfilesController');
    Route::get('/settings','SettingsController@index')->name('settings');
    Route::post('/settings','SettingsController@update')->name('settings.update');
});

