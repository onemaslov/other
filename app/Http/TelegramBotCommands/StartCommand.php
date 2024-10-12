<?php

namespace App\Http\TelegramBotCommands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = "start";
//    protected string $pattern = '{authKey}';
    protected string $description = "Команда для авторизации бота для отправки вам сообщений";

//    public function __construct(
//        private TelegramTalkingBotService $telegramTalkingBotService,
//        private UserRepository $userRepository
//    ) {
//    }

    public function handle($arguments = null): mixed
    {
        $update = Telegram::bot('botTakBot')->getWebhookUpdate();

        $telegramUserId = $update->getMessage()->getFrom()->getId();
        $message = 'Отвечаю тебе' . $telegramUserId;
//        if (!$user) {
//            return $this->replyWithMessage(['text' => $message]);
//        }

//        $notificationTypeId = $this->argument(
//            'notificationTypeId'
//        );
//
//        if (!in_array((int)$notificationTypeId, $this->notificationService->getList($user->company), true)) {
//            return $this->replyWithMessage(['text' => 'Введите актуальный тип уведомления']);
//        }
//
//        $activeNotification = $this->notificationRepository->findActiveNotification($user, $notificationTypeId);
//
//        if ($activeNotification) {
//            $activeNotification->delete();
//
//            $message = 'Уведомление выключено';
//        } else {
//            $user->notifications()->create(['type_id' => $notificationTypeId]);
//
//            $message = 'Уведомление включено';
//        }

        return $this->replyWithMessage(['text' => $message]);
    }
}

