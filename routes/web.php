<?php

use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users = User::get();

    return view('welcome', ['users' => $users]);
});

Route::get('/profile/{id}', function ($id) {
    $user = User::find($id);

    $posts = $user -> posts()
        ->with('category', 'image', 'tags')
        ->withCount('comments')->get();

    $videos = $user->videos()
        ->with('category', 'image', 'tags')
        ->withCount('comments')->get();

    return view('profile', [
        'user' => $user,
        'posts' => $posts,
        'videos' => $videos]);

})->name('profile');

Route::get('/level/{id}', function ($id) {
    $level = Level::find($id);

    $posts = $level -> posts()
        ->with('category', 'image', 'tags')
        ->withCount('comments')->get();

    $videos = $level->videos()
        ->with('category', 'image', 'tags')
        ->withCount('comments')->get();

    return view('level', [
        'level' => $level,
        'posts' => $posts,
        'videos' => $videos]);

})->name('level');
