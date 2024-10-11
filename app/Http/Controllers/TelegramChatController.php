<?php


namespace App\Http\Controllers;

use App\Helper\ExceptionHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TelegramChatController extends Controller
{
//    public function __construct(
//        private TelegramChatService $telegramChatService,
//        private NotificationService $notificationService,
//        private Notice $notice,
//        private TelegramTalkingBotService $telegramTalkingBotService,
//    ) {
//    }

    public function index(Request $request): View
    {
        return view(
            'telegram.index',
            [
                'asd' => 123
            ]
        );
    }

    public  function send(Request $request)
    {

    }
}
