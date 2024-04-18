<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register_author',[AuthorController::class, 'registeration'])->name('register');
Route::post('/author-registeration', [AuthorController::class, 'create_author'])->name('register.author');
Route::get('/login', [AuthorController::class, 'login'])->name('login');
Route::post('/login_author', [AuthorController::class, 'login_author'])->name('login.author');


// book storing route

Route::group(['middleware'=>['auth']], function (){
   
    Route::get('/books-inventory', [BookController::class, 'stored_books'])->name('stored.books');
    Route::get('/download-book-pdf/{id}', [BookController::class, 'download']);
    Route::get('/dashboard', [AuthorController::class, 'dashboard'])->name('dashboard');
    Route::get('logOut', [AuthorController::class, 'logOut'])->name('logOut');
    Route::get('/book_detail/{id}', [BookController::class, 'book_details']);
    Route::get('/downloaded_books', [AuthorController::class, 'download_list'])->name('download.list');

});

Route::group(['middleware'=>['auth','admin']], function (){
    Route::get('/add-book', [BookController::class, 'add_new_book'])->name('add.book');
    Route::post('/submit-book', [BookController::class, 'submit_book'])->name('submit.book');
    Route::get('/book_delete/{id}', [BookController::class, 'book_delete']);
    Route::get('/users-history', [AuthorController::class, 'users_history'])->name('users.history');
});
