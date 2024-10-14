<?php

use App\Http\Controllers\TelegramChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('vot_tak_bot', [TelegramChatController::class, 'index'])->name('vot_tak_bot');
Route::get('set_webhook', [TelegramChatController::class, 'setWebHook']);

Route::post('vot/webhook/8152238174:AAEsWdDKUUdhyrG61R2SifhVtvxzqqJgTjE', [TelegramChatController::class, 'webhook'])->name('webhook');

Route::get('php', function () {phpinfo();})->name('phpinfo');
