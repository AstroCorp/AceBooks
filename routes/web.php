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

Route::get('/', 'StaticController@index')->name('index');

Auth::routes(['verify' => true]);
Route::get('/conditions', 'StaticController@conditions')->name('conditions');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/library', 'HomeController@library')->name('library');

Route::get('/info', 'StaticController@info')->name('info');

Route::resource('collection', 'CollectionController')->except([
    'index'
]);

Route::resource('book', 'BookController')->except([
    'index'
]);

Route::prefix('bookmarks')->group(function()
{
    Route::post('/', 'BookmarkController@index')->name('bookmarks.index');
    Route::post('add', 'BookmarkController@add')->name('bookmarks.add');
    Route::post('update', 'BookmarkController@update')->name('bookmarks.update');
    Route::post('delete', 'BookmarkController@delete')->name('bookmarks.delete');
});

Route::prefix('settings')->group(function()
{
    Route::get('profile', 'UserController@edit_profile')->name('profile.edit');
    Route::post('profile', 'UserController@update_profile')->name('profile.update');

    Route::get('password', 'UserController@edit_password')->name('password.edit');
    Route::post('password', 'UserController@update_password')->name('password.update');

    Route::get('website', 'UserController@edit_website')->name('website.edit');
    Route::post('website', 'UserController@update_website')->name('website.update');
});


Route::prefix('storage')->group(function()
{
    Route::get('/', 'StorageController@index')->name('storage');
    Route::post('buy', 'StorageController@buy')->name('storage.buy');
});

Route::get('/cpanel', function()
{
    return redirect('admin');
})->name('cpanel');

// Dev
Route::get('/phpinfo', function()
{
    phpinfo();
});

Route::get('/test', 'StaticController@test');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
