<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users = User::get();
    return view('welcome', ['users' => $users]);
});
