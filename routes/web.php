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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//xxxxxxxxx BOOKS

Route::get('/books', 'BooksController@getBooks');

Route::get('/books/add', 'BooksController@getAddBooks');

Route::post('/books/add', 'BooksController@postAddBooks');

Route::get('/books/update/{book_code}', 'BooksController@getUpdateBooks');

Route::post('/books/update/{book_code}', 'BooksController@postUpdateBooks');

Route::get('/books/delete/{book_code}', 'BooksController@postDeleteBooks');


//xxxxxxxxx BOOKS REQUEST

Route::get('/request/books/user', 'BookRequestController@getUserBooksRequest');

Route::get('/request/books/admin', 'BookRequestController@getAdminBooksRequest');

Route::get('/request/books/add', 'BookRequestController@getRequestBooks');

Route::post('/request/books/add', 'BookRequestController@postRequestBooks');

Route::get('/books/approved/request/{request_code}/{book_code}', 'BookRequestController@getApproveBooksRequest');

Route::get('/books/decline/request/{request_code}/{book_code}', 'BookRequestController@getDeclineBooksRequest');

Route::get('/books/return/request/{request_code}', 'BookRequestController@getReturnBooksRequest');