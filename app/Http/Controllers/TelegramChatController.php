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
        return $this->telegramBotService->sendTelegramQuiz($update);
    }

    public function setWebHook(): JsonResponse
    {
        Telegram::setWebhook(['url' => 'https://oneferov.ru/vot/webhook/' . config('telegram.bots.botTakBot.token')]);

        return response()->json(['status' => 'ok']);
    }
}
