<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\PostsCommentsController;

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

Route::get('c/{slug}', [CommunityController::class, 'show'])->name('communities.show');

Route::get('p/{postId}', [CommunityPostController::class, 'show'])->name('communities.posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/', HomeController::class)->name('dashboard');

    Route::resource('communities', CommunityController::class)->except('show');

    Route::resource('communities.posts', CommunityPostController::class)->except('show');

    Route::resource('posts.comments', PostsCommentsController::class);

    Route::get('posts/{post_id}/{vote}', [CommunityController::class, 'vote'])->name('post_vote');

    Route::post('posts/{post_id}/report', [CommunityPostController::class, 'report'])->name('post_report');
});
