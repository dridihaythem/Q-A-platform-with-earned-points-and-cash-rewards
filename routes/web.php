<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\WithdrawRequestController;
use App\Http\Controllers\Auth\ProviderAuthController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\WithdrawRequestController as AdminWithdrawRequestController;
use App\Http\Controllers\UploadImage;

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

Route::prefix('auth/provider')->as('auth.')->group(function () {
    Route::get('/{provider}', [ProviderAuthController::class, 'redirect'])->name('redirect');
    Route::get('/{provider}/callback', [ProviderAuthController::class, 'callback']);
});

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/category/{slug}', [QuestionController::class, 'indexByCategory'])->name('category');

Route::resource('questions', QuestionController::class)->only(['create', 'store', 'show']);
Route::post('questions/{question}/answer', [QuestionController::class, 'answer'])->name('questions.answer');
Route::post('/questions/{question}/{answer}/choose_best_answer', [QuestionController::class, 'chooseBestAnswer'])->name('questions.choose_best_answer');

Route::get('/banned', [MainController::class, 'banned'])->name('banned');

Route::resource('/request/withdraw', WithdrawRequestController::class)->only(['index', 'create', 'store']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::prefix('pages')->as('pages.')->group(function () {
    Route::get('/privacy', [MainController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [MainController::class, 'terms'])->name('terms');
});

Route::post('/api/upload-image', [UploadImage::class, 'markdownUploadImage'])->name('markdown.upload-image');

Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('index');
    Route::resource('categories', CategoryController::class)->except('show');

    Route::put('/questions/{question}/publish', [AdminQuestionController::class, 'publish'])->name('questions.publish');
    Route::resource('questions', AdminQuestionController::class)->except(['show', 'create', 'store']);

    Route::resource('answers', AnswerController::class)->except(['show', 'create', 'store']);
    Route::put('/answers/{answer}/publish', [AnswerController::class, 'publish'])->name('answers.publish');

    Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
    Route::resource('payment_methods', PaymentMethodController::class)->except('show');

    Route::resource('/withdraw', AdminWithdrawRequestController::class)->except(['show', 'create', 'store']);

    Route::prefix('settings')->group(function () {
        Route::get('/{slug}', [SettingController::class, 'show'])->name('setting');
        Route::post('/{slug}', [SettingController::class, 'save']);
    });
});
