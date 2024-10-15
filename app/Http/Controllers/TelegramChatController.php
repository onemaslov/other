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

        Log::debug(
            'updateData',
            [
                'update' => $update,
            ]
        );

        if (isset($update['poll'])) {
            Log::debug(
                'poll',
                [
                    'update' => $update['poll'],
                ]
            );
            return response()->json(['status' => 'ok']);
        }

        if (isset($update['poll_answer'])) {
            Log::debug(
                'poll_answer',
                [
                    'update' => $update['poll_answer'],
                ]
            );
            return response()->json(['status' => 'ok']);
        }

        if (!isset($update['message'])) {
            return response()->json(['status' => 'ok']);
        }

        return $this->telegramBotService->sendTelegramQuiz($update);
    }

    public function setWebHook(): JsonResponse
    {
        Telegram::setWebhook(['url' => 'https://oneferov.ru/vot/webhook/' . config('telegram.bots.botTakBot.token')]);

        return response()->json(['status' => 'ok']);
    }
}
