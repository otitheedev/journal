<?php

use App\Http\Controllers\journal\HomepageUserController;
use Illuminate\Support\Facades\Route;
use App\Models\core\Permission; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\journal\JournalController;
use App\Http\Controllers\journal\ArticleController;


#export NODE_OPTIONS=--max-old-space-size=8192 
##### php artisan serve --host 192.168.68.231 --port 8000
#### php artisan migrate:refresh --path=/database/migrations/2024_03_16_102807_create_leave_application.php


# homepage
Route::get('/', [HomepageUserController::class, 'index']);
Route::get('/article/{articleId}', [HomepageUserController::class, 'article']);

Route::get('/admin', function () {
    //return view('webpages.dashboard');
    return redirect('/login');
});


# start maing code
Route::resource('journals', JournalController::class);

# Articles start
Route::resource('articles', ArticleController::class);
Route::post('articles/{article}/add-keywords', [ArticleController::class, 'addKeywords'])->name('articles.addKeywords');
Route::post('articles/{article}/add-editorial-decision', [ArticleController::class, 'addEditorialDecision'])->name('articles.addEditorialDecision');
Route::delete('articles/{article}/remove-keyword/{keyword}', [ArticleController::class, 'removeKeyword'])->name('articles.removeKeyword');

# dropdown ajax search keywords
Route::get('/keywords/search', [ArticleController::class, 'search'])->name('keywords.search');
# Articles end










// Prefix all routes with 'admin'
Route::prefix('admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {
#Admin Dashboard
#Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});


Route::group(['middleware' => ['auth', 'checkPermission:create']], function () {
Route::get('yamin', function () {return view('webpages.dashboard');});
});

Auth::routes();
