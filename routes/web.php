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
//Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes(['verify' => true]);
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
Route::get('/legal', function() {
    return view('legal');
})->name('legal');

Route::get('/privacy', function() {
    return view('privacy');
})->name('privacy');

Route::get('/posts/all','PostController@all')->name('posts.all')->middleware('verified');
Route::post('/posts/all','PostController@all_filtered')->name('posts.allfilter')->middleware('verified');
Route::get('/users','UserController@index')->name('users.index')->middleware('verified');
Route::get('/users/{user}','UserController@profile')->name('users.profile')->middleware('verified');
Route::put('/users/{user}','UserController@update')->name('users.update')->middleware('verified');
Route::get('/posts/drafts','PostController@index_draft')->name('posts.draft')->middleware('verified');
Route::get('/posts/reviews','PostController@index_review')->name('posts.review')->middleware('verified');
Route::get('/posts/declined','PostController@index_declined')->name('posts.declined')->middleware('verified');
Route::get('/posts/explore/{current_post}','PostController@explorer')->name('posts.explorer')->middleware('verified');
Route::get('/posts/unpublish/{post}','PostController@unpublish')->name('posts.unpublish')->middleware('verified');
Route::get('/reviews/delete/{review_id}','ReviewController@destroy')->name('review.delete')->middleware('verified');
Route::resource('posts','PostController');
Route::resource('cuisines','CuisineController')->middleware('verified');

//Revisions
Route::get('/revisions','RevisionController@index')->name('revisions.index')->middleware('verified');
Route::get('/revisions/{post}','RevisionController@review')->name('revisions.review')->middleware('verified');
Route::get('/revisions/{post}/decline','RevisionController@decline')->name('revisions.decline')->middleware('verified');
Route::get('/revisions/{post}/approve','RevisionController@approve')->name('revisions.approve')->middleware('verified');
Route::get('/revisions/{post}/edit','RevisionController@edit')->name('revisions.edit')->middleware('verified');
Route::post('/revisions/{post}/new','RevisionController@new')->name('revisions.store')->middleware('verified');

//Route::get('admin/posts/edit/{id}','PostController@edit')->name('post.edit');

//Route::get('/admin/posts','PostController@index')->name('post.index');

//Route::post('/admin/new','PostController@store')->name('post.store');

Route::get('/test','TestController@tojs');