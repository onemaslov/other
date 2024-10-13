<?php

namespace App\Services;

use App\Helper\ExceptionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;
use Throwable;

class TelegramBotService
{
    public function sendTelegramQuiz(Update $update): JsonResponse
    {
        $keyboardButtons = [
            [
                'text' => 'Первая кнопка',
                'callback_data' => 'quiz_id=1' . '&quiz_option_id=1',
            ],
            [
                'text' => 'Вторая кнопка',
                'callback_data' => 'quiz_id=1' . '&quiz_option_id=2',
            ],
            [
                'text' => 'Третья кнопка',
                'callback_data' => 'quiz_id=1' . '&quiz_option_id=3',
            ],
            [
                'text' => 'Завершить',
                'callback_data' => 'finish_quiz=1',
            ]
        ];

        $telegramChatId = $update->getMessage()->getChat()->getId();

        $keyboard = Keyboard::make()->inline();

        foreach ($keyboardButtons as $keyboardButton) {
            $keyboard->row([$keyboardButton]);
        }

        $data = [
            'chat_id' => $telegramChatId,
            'reply_markup' => $keyboard
        ];

        if (isset($update['callback_query'])) {
            $callbackData = $update['callback_query'];
            $userData = $callbackData['from'];

            $userTelegramId = $userData['id'];
            $userFullName = $userData['first_name'] . ' ' . ( $userData['last_name'] ?? '');
            $messageId = $callbackData['message']['message_id'];
            parse_str( $callbackData['data'], $params);
            $quizFinish = $params['finish_quiz'] ?? null;
            $quizId = $params['quiz_id'] ?? null;
            $quizOptionId = $params['quiz_option_id'] ?? null;

            if ($quizFinish) {
                $data['reply_markup'] = null;
                $data['text'] = $userFullName . ', спасибо за ответ';

                return $this->sendMessage($data);
            }

            $data['text'] = $userFullName . ' ответил ' . $quizOptionId . ' можно еще или нажать Завершить';
        } else {
            $data['text'] = 'Такой вопрос';
        }

        return $this->sendMessage($data, 'Telegram опрос не был отправлен: ');
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
