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


Route::get('/test', function(){
    return view('welcome');
})->name('test');

Route::group(['middleware' => ['auth']], function(){  
    Route::post('/createFeedback', [App\Http\Controllers\ComplaintController::class, 'create'])->name('createFeedback');
    Route::get('/createFeedback', [App\Http\Controllers\ComplaintController::class, 'page'])->name('getFeedbackPage');
    Route::get('/complaints', [App\Http\Controllers\ComplaintController::class, 'show'])->name('all-complaints');
    Route::get('/allcomplaints', [App\Http\Controllers\ComplaintController::class, 'showAll'])->name('admin-all-complaints');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homei');
    Route::post('/feedback', [App\Http\Controllers\ComplaintController::class, 'showOne'])->name('feedback');
    Route::post('/pdffile', [App\Http\Controllers\ComplaintController::class, 'getPdf'])->name('pdffile');
});




