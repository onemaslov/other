<?php

declare(strict_types=1);

namespace App\Http\Telegraph;

use App\Services\TelegramBotService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function __construct(
        private readonly TelegramBotService $telegramBotService,
    ) {
    }

    public function start(): void
    {
        Log::debug(
            __METHOD__,
            [
                'команда старт' => $this->message->toArray()
            ]
        );
        $this->reply('Здарова я бот');

//		Telegraph::message('hello world')
//			->keyboard(Keyboard::make()->buttons([
//				Button::make('Delete')->action('delete')->param('id', '42'),
//				Button::make('Login Url')->loginUrl('https://loginUrl.test.it'),
//			]))->send();

//		Telegraph::message('hello world')
//			->keyboard(function(Keyboard $keyboard){
//				return $keyboard
//					->button('Delete')->action('delete')->param('id', '42')
//					->button('open')->url('https://test.it')
//					->button('Web App')->webApp('https://web-app.test.it')
//					->button('Login Url')->loginUrl('https://loginUrl.test.it');
//			})->send();

//        Telegraph::message('Спасибо за ответ')->send();
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Неизвестная команда');
    }

    protected function handleChatMessage(Stringable $text): void
    {
//        $this->message;
        $chat = $this->message->getChat();
        $telegraphChat = TelegraphChat::where('chat_id', $chat->id)->first();

        if (!$telegraphChat) {
            TelegraphChat::create([
                'chat_id' => $chat->id,
                'name' => $chat->name,
                'telegraph_bot_id' => 1
            ]);
        }

        Log::debug(
            __METHOD__,
            [
                'инфа о сообщении' => $this->message->toArray()
            ]
        );

        Telegraph::message('hello world')
            ->keyboard(function(Keyboard $keyboard){
                return $keyboard
                    ->button('Delete')->action('delete')->param('id', '42')
                    ->button('open')->url('https://test.it')
                    ->button('Web App')->webApp('https://web-app.test.it')
                    ->button('Login Url')->loginUrl('https://loginUrl.test.it');
            })->send();
    }

    public function subscribe(): void
    {
        $this->data->get('quiz_id');
    }
}
