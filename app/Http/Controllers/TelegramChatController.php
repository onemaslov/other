<?php


namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramChatController extends Controller
{
    public function __construct(
        private readonly TelegramBotService $telegramBotService,
    ) {
    }

    public function index(Request $request): View
    {
        return view(
            'telegram.index',
            [
                'asd' => 1234
            ]
        );
    }

    public  function webhook(): JsonResponse
    {
        $update = Telegram::bot('botTakBot')->commandsHandler(true);

        if ($update->hasCommand()) {
            return response()->json(['status' => 'ok']);
        }

        $message = $update->getMessage();

        Log::debug(
            __METHOD__,
            [
                'update' => $update,
            ]
        );

        $telegramChatId = $message->getChat()->getId();



        if (isset($message['reply_to_message'])) {

            Log::debug(
                'кейс ответа на нажатие клавиатуры',
                [
                    'reply_to_message' => $message['reply_to_message']
                ]
            );
//			$this->telegramBotService->sendTelegramQuiz($telegramChatId);
        } else {

            Log::debug(
                'кейс сообщения в чате',
                [
                    '$message' => $message
                ]
            );
            $this->telegramBotService->sendTelegramQuiz($telegramChatId);
        }


//        if (!isset($update['callback_query'])) {
//            $telegramChatId = $message->getChat()->getId();
//            Log::debug(
//                'кейс первого сообщения',
//                [
//                    '$message' => $message
//                ]
//            );
//            $this->telegramBotService->sendTelegramQuiz($telegramChatId);
//        } else {
//            $data = $update['callback_query']['data'];
//            $callback_query = $update['callback_query'];
//            Log::debug(
//                'кейс обработки ответа пользователей на опросы',
//                [
//                    'callbackQueryData' => $callback_query
//                ]
//            );
//            return $this->telegramBotService->storeQuizAnswer($update['callback_query']);
//        }

        return response()->json(['status' => 'ok']);
    }

    public function setWebHook(): JsonResponse
    {
        Telegram::setWebhook(['url' => 'https://oneferov.ru/vot/webhook/' . config('telegram.bots.botTakBot.token')]);

        return response()->json(['status' => 'ok']);
    }
}
