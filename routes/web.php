<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'check.banned'])->group(function () {
// Post Routes
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/readmore/{id}', [PostController::class, 'readmore']);
Route::get('/post/createAndUpload', [PostController::class, 'add']);
Route::post('/post/createAndUpload', [PostController::class, 'createAndUpload'])->name('post.createAndUpload');
Route::get('/post/delete/{id}', [PostController::class, 'delete']);

// Comment Routes
Route::post('/comments/add', [CommentController::class, 'create'])->name('comments.create');
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);
Route::get('/chat/delete/{id}', [CommentController::class, 'deletechat']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('user.profile');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('user.profile.store');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');

Route::get('/profileC', [ProfileController::class, 'indexC'])->name('userc.profile');
Route::put('/profileC/update', [ProfileController::class, 'storeC'])->name('profilec.update');


// Route to handle the update request
Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::get('/admin',function(){
    return view('post/admin');
});
// In routes/web.php
Route::get('/profileU/{id}', [PostController::class, 'profile'])->name('post.profile');
// In your routes file (web.php)
Route::get('/profileU/{userId}', [ProfileController::class, 'showProfile'])->name('profile.show');


Route::post('/profile/follow/{id}', [ProfileController::class, 'follow'])->name('profile.follow');
Route::post('/profile/unfollow/{id}', [ProfileController::class, 'unfollow'])->name('profile.unfollow');

Route::post('/user/{id}/follow', [FollowController::class, 'follow'])->name('user.follow');
Route::post('/user/{id}/unfollow', [FollowController::class, 'unfollow'])->name('user.unfollow');

Route::get('/post/following', [PostController::class, 'index'])->name('post.following');
// web.php
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// In routes/web.php

Route::get('/chat', [ChatController::class, 'index'])->middleware('auth')->name('chat.index');
Route::get('/chat/messages/{receiverId}', [ChatController::class, 'showMessages'])->middleware('auth')->name('chatp');
Route::post('/send-message', [ChatController::class, 'sentMessage'])->name('send.message');
Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
Route::get('/chat/active', [ChatController::class, 'activeUsers'])->name('chat.active');

Route::get('/admin/view', [PostController::class, 'view']);
Route::get('/admin/delete/{id}', [PostController::class, 'deleteAdmin']);
Route::get('/admin/user', [PostController::class, 'showUser'])->name('show.user');

Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        return view('admin.admin');
    } else {
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}); 
Route::post('/user/{userId}/ban', [ProfileController::class, 'banUser'])->name('user.ban');
Route::post('/user/{userId}/unban', [ProfileController::class, 'unbanUser'])->name('user.unban');


Route::get('/unread-count', [ChatController::class, 'getTotalUnreadCount'])->name('unread.count')->middleware('auth');
Route::post('/mark-messages-as-read/{receiverId}', [ChatController::class, 'markMessagesAsRead'])->name('mark.messages.as.read')->middleware('auth');
Route::get('/unread-counts-by-sender', [ChatController::class, 'getUnreadCountsBySender'])->name('unread.counts.by.sender')->middleware('auth');

Route::post('/admin/user/promote/{user}', [ProfileController::class, 'promoteToAdmin'])->name('user.promote');
Route::post('/user/demote/{userId}', [ProfileController::class, 'demoteFromAdmin'])->name('user.demote');

Route::post('/user/{userId}/block', [ProfileController::class, 'blockUser'])->name('user.block');
Route::post('/user/{userId}/unblock', [ProfileController::class, 'unblockUser'])->name('user.unblock');
Route::get('/blocked-users', [ProfileController::class, 'blockedUsers'])->name('user.blocked');
});
