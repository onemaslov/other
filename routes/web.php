<?php

use App\Http\Controllers\TelegramChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('bot', [TelegramChatController::class, 'index']);
Route::get('set_webhook', [TelegramChatController::class, 'setWebHook']);

Route::post('vot/webhook', [TelegramChatController::class, 'webhook'])->name('webhook');

Route::get('php', function () {phpinfo();});
