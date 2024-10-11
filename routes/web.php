<?php

use App\Http\Controllers\TelegramChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('bot', [TelegramChatController::class, 'index']);
