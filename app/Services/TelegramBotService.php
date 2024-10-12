<?php

namespace App\Services;

use App\Helper\ExceptionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Throwable;

class TelegramBotService
{
//    public function storeQuizAnswer(array $callbackData): JsonResponse
//    {
//        $userTelegramId = $callbackData['from']['id'];
//		$messageId = $callbackData['message']['message_id'];
//        $telegramChatId = $callbackData['message']['chat']['id'];
//        parse_str( $callbackData['data'], $params);
//        $quizFinish = $params['finish_quiz'] ?? null;
//        $quizId = $params['quiz_id'] ?? null;
//        $quizOptionId = $params['quiz_option_id'] ?? null;
//
//		if ($quizFinish) {
//			return $this->sendMessage(
//				[
//					'chat_id' => $telegramChatId,
//					'text' => 'Благодарим за ответ'
//				]
//			);
//		}
//
//        if ($quizId && $quizOptionId) {
//            return $this->sendTelegramQuiz($telegramChatId, $messageId);
//        }
//
//        return response()->json(['status' => 'ok']);
//    }

    public function storeQuizAnswer(array $callbackData): JsonResponse
    {
        $userTelegramId = $callbackData['from']['id'];
        $messageId = $callbackData['message']['message_id'];
        $telegramChatId = $callbackData['message']['chat']['id'];
        parse_str( $callbackData['data'], $params);
        $quizFinish = $params['finish_quiz'] ?? null;
        $quizId = $params['quiz_id'] ?? null;
        $quizOptionId = $params['quiz_option_id'] ?? null;

        if ($quizFinish) {
            return $this->sendMessage(
                [
                    'chat_id' => $telegramChatId,
                    'text' => 'Благодарим за ответ'
                ]
            );
        }

        if ($quizId && $quizOptionId) {
            return $this->sendTelegramQuiz($telegramChatId, $messageId);
        }

        return response()->json(['status' => 'ok']);
    }

    public function sendTelegramQuiz(int $telegramChatTelegramId, ?int $messageId= null): JsonResponse
//    public function sendTelegramQuiz(int $telegramChatTelegramId, ?int $userTelegramId = null): JsonResponse
    {
//        $keyboardButtons = [
//            [
//                'text' => 'Первая кнопка',
//                'callback_data' => 'quiz_id=1' . '&quiz_option_id=1',
//            ],
//            [
//                'text' => 'Вторая кнопка' . $messageId,
//                'callback_data' => 'quiz_id=1' . '&quiz_option_id=2',
//            ],
//            [
//                'text' => 'Третья кнопка',
//                'callback_data' => 'quiz_id=1' . '&quiz_option_id=3',
//            ],
//            [
//                'text' => 'Завершить',
//                'callback_data' => 'finish_quiz=1',
//            ]
//        ];

        $keyboardButtons = [
            [
                'text' => 'Первая кнопка',
            ],
            [
                'text' => 'Вторая кнопка',
            ],
            [
                'text' => 'Третья кнопка',
            ],
        ];

        $keyboard = Keyboard::make()
//            ->inline()
            ->remove()
//            ->setResizeKeyboard(true)
//			->setSelective(true)
//            ->setOneTimeKeyboard(true)
        ;

        foreach ($keyboardButtons as $keyboardButton) {
            $keyboard->row([$keyboardButton]);
        }

//        if (false) {
//			$keyboard->row([
//				'text' => 'Завершить',
//			]);
//        }

        $data = [
            'chat_id' => $telegramChatTelegramId,
            'text' => 'Такой вопрос',
            'reply_markup' => $keyboard,
        ];

//		if ($messageId) {
//			$data['reply_to_message_id'] = $messageId;
//		}

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
