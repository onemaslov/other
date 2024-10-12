<?php

declare(strict_types=1);

namespace App\Http\Telegraph;

use App\Services\TelegramBotService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function __construct(
        private readonly TelegramBotService $telegramBotService,
    ) {
    }

    public function start(): void
    {
        $this->reply('Здарова я бот');

//        Telegraph::message('Спасибо за ответ')->send();
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Неизвестная команда');
    }

    protected function handleChatMessage(Stringable $text): void
    {
//        $this->message;
    }

    public function subscribe(): void
    {
        $this->data->get('quiz_id');
    }
}
