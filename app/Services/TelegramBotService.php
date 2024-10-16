<?php

namespace App\Services;

use App\Helper\ExceptionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;
use Throwable;

class TelegramBotService
{
    public function sendTelegramQuiz(Update $update): JsonResponse
    {
        $keyboardButtons = [
            'Первая кнопка',
            'Вторая кнопка',
            'Третья кнопка',
        ];

        $telegramChatId = $update->getMessage()->getChat()->getId();
        $data = [
            'chat_id' => $telegramChatId,
            'question' => 'Вопрос викторины',
            'options' => $keyboardButtons,
            'explanation_parse_mode' => 'html',
            'is_anonymous' => false,
            'quiz' => true,
            'allows_multiple_answers' => false
        ];

        try {
            $resp = Telegram::sendPoll($data);
        } catch (Throwable $throwable) {
            Log::error(
                'Ошибка отправки телеграм опроса: ' . $throwable->getMessage(),
                [
                    'trace' => ExceptionHelper::getTrace($throwable)
                ]
            );
        }
        Log::debug(
            'data',
            $data
        );

        if (isset($resp['poll'])) {
            //сохраняем $resp['poll']['id'] в quiz
            //сохраняем опции айди в квиз оптионс
            Log::debug(
                '$RRRRresp',
                [
                    'pollid' => $resp['poll']['id'],
                    'pollopt' => $resp['poll']['options'],
                ]
            );
        }
        return response()->json(['status' => 'ok']);
    }

    public function sendMessage(array $payload, ?string $errorMessage = ''): JsonResponse
    {
        try {
            Telegram::bot('botTakBot')->sendMessage($payload);
        } catch (Throwable $throwable) {
            Log::warning(
                $errorMessage . $throwable->getMessage(),
                ['trace' => ExceptionHelper::getTrace($throwable)]
            );
        }

        return response()->json(['status' => 'ok']);
    }
}
