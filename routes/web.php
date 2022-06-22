<?php

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\QuestionController;
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

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::resource('questions', QuestionController::class)->only(['create', 'store', 'show']);
Route::post('questions/{question}/answer', [QuestionController::class, 'answer'])->name('questions.answer');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::resource('categories', CategoryController::class)->except('show');

    Route::put('/questions/{question}/publish', [AdminQuestionController::class, 'publish'])->name('questions.publish');
    Route::resource('questions', AdminQuestionController::class)->except(['show', 'create', 'store']);

    Route::resource('answers', AnswerController::class)->except(['show', 'create', 'store']);
    Route::put('/answers/{answer}/publish', [AnswerController::class, 'publish'])->name('answers.publish');
});
