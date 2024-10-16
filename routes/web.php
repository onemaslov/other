<?php

use App\Http\Controllers\TelegramChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('bot', [TelegramChatController::class, 'index']);
Route::post('bot/send', [TelegramChatController::class, 'sendQuiz'])->name('bot.send');
Route::get('set_webhook', [TelegramChatController::class, 'setWebHook']);

Route::post('vot/webhook/8152238174:AAEsWdDKUUdhyrG61R2SifhVtvxzqqJgTjE', [TelegramChatController::class, 'webhook'])->name('webhook');

Route::get('php', function () {phpinfo();});
