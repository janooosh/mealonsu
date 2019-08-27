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
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::post('/','HomeController@filter')->name('filter.post');

Route::get('/restaurant',function() {
    return view('single_review');
})->name('single_review');

Route::get('/mapview',function() {
    return view('mapview');
})->name('map_view');

Route::get('/editor',function() {
    return view('editor');
});

Route::get('/users','UserController@index')->name('users.index');
Route::get('/users/{user}','UserController@profile')->name('users.profile');
Route::put('/users/{user}','UserController@update')->name('users.update');
Route::get('/posts/drafts','PostController@index_draft')->name('posts.draft');
Route::get('/posts/reviews','PostController@index_review')->name('posts.review');
Route::get('/posts/declined','PostController@index_declined')->name('posts.declined');
Route::get('/posts/explore/{current_post}','PostController@explorer')->name('posts.explorer');
Route::resource('posts','PostController');
Route::resource('cuisines','CuisineController');

//Revisions
Route::get('/revisions','RevisionController@index')->name('revisions.index');
Route::get('/revisions/{post}','RevisionController@review')->name('revisions.review');
Route::get('/revisions/{post}/decline','RevisionController@decline')->name('revisions.decline');
Route::get('/revisions/{post}/approve','RevisionController@approve')->name('revisions.approve');
Route::get('/revisions/{post}/edit','RevisionController@edit')->name('revisions.edit');
Route::post('/revisions/{post}/new','RevisionController@new')->name('revisions.store');

//Route::get('admin/posts/edit/{id}','PostController@edit')->name('post.edit');

//Route::get('/admin/posts','PostController@index')->name('post.index');



//Route::post('/admin/new','PostController@store')->name('post.store');

Route::get('/test','TestController@tojs');