<?php

use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
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

Auth::routes();


Route::get('/email',function(){
    return new NewUserWelcomeMail();
});


Route::post('follow/{user}', [FollowsController::class, 'store']);

Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::get('/p/create', [PostsController::class, 'create'])->name('posts.create');
Route::get('/p/{post}', [PostsController::class, 'show'])->name('posts.show');
Route::post('/p', [PostsController::class, 'store'])->name('posts.store');
Route::get('/p/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
Route::patch('/p/{post}', [PostsController::class, 'update'])->name('posts.update');
Route::get('/p/{post}/delete', [PostsController::class, 'delete'])->name('posts.delete');



Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/delete', [ProfilesController::class, 'deleteConfirmation'])->name('profile.delete.confirmation');
Route::post('/profile/delete', [ProfilesController::class, 'delete'])->name('profile.delete');

Route::get('/profiles/search', [ProfilesController::class, 'search'])->name('profiles.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
Route::put('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

Route::get('/change-email', [ChangeEmailController::class, 'showChangeEmailForm'])->name('email.change');
Route::put('/change-email', [ChangeEmailController::class, 'changeEmail'])->name('email.update');

Route::post('/posts/{post}/toggle-like', [PostsController::class,'toggleLike'])->name('posts.toggle-like');

Route::middleware(['auth'])->group(function () {
    Route::get('comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
