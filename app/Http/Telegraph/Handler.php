<?php

declare(strict_types=1);

namespace App\Http\Telegraph;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        Log::debug(
            __METHOD__,
            [
                'команда старт' => $this->message->toArray()
            ]
        );
        $this->reply('Здарова я бот');
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Неизвестная команда');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $chat = $this->message->chat();
//        $telegraphChat = TelegraphChat::where('chat_id', $chat->id())->first();
//
//        if (!$telegraphChat) {
//            TelegraphChat::create([
//                'chat_id' => $chat->id(),
//                'name' => $chat->title(),
//                'telegraph_bot_id' => 1
//            ]);
//        }

        $replyToMessage = $this->message->replyToMessage();
        if (isset($replyToMessage)) {

            $userFirstName = $this->message->from()->firstName();

            Log::debug(
                'ddddd',
                [
                    'епта' => $text
                ]
            );


            if ($text == 'Завершить') {
                Telegraph::message($userFirstName . ' Спасибо за ответ')
                    ->removeReplyKeyboard(true)
                    ->send();

                return;
            }

            $questionText =  $this->message->replyToMessage()->text();
            $userTelegramId = $this->message->from()->id();

            Log::debug(
                __METHOD__,
                [
                    'зашел' => $this->message->replyToMessage()->text()
                ]
            );

//			сохраняем ответ в бд

//			если немногоответный то

            if (false) {
                Telegraph::message($userFirstName . ', спасибо за ответ')
                    ->removeReplyKeyboard(true)
                    ->send();
            } else {
//				изменяем внешний вид кнопок

                Telegraph::deleteKeyboard((string)$this->message->id())->send();

                $this->chat->message($userFirstName . ', вы выбрали ' . $text . '. Можете выбрать еще варианты ответов или нажать кнопку Завершить')
                    ->replyKeyboard(
                        ReplyKeyboard::make()
                            ->buttons([
                                ReplyButton::make('bar1'),
                                ReplyButton::make('bar2'),
                                ReplyButton::make('bar3'),
                                ReplyButton::make('Завершить'),
                            ])
                            ->selective()
                    )->send();
            }

        } else {

            $this->chat->message('Начальный вопрос')
                ->replyKeyboard(
                    ReplyKeyboard::make()
                        ->buttons([
                            ReplyButton::make('bar1'),
                            ReplyButton::make('bar2'),
                            ReplyButton::make('bar3'),
                            ReplyButton::make('Завершить'),
                        ])
                )->send();
        }

//		$response->telegraphMessageId(); //4568
    }

    public function response(): void
    {
        $quizId = $this->data->get('quiz_id');
        $quizOptionId = $this->data->get('quiz_option_id');

        if (!$quizId || !$quizOptionId) {
            return;
        }

        Log::debug(
            __METHOD__,
            [
                'инфа о сообщении' => $this->message->toArray(),
            ]
        );
//		находим quiz по айдишнику сохраняем ответ в бд

        $chat = $this->message->chat();
        if (true) {
//		if (!$quiz->multiple_answers) {
            $this->reply('Спасибо за ответ');
        } else {
//			показываем клавиатуру с помеченными кнопками

            $response = Telegraph::message('Второй выбор вопроса')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Первый вариант2')->action('response')->param('quiz_id', 1)->param('quiz_option_id', 1),
                        Button::make('второй вариант2')->action('response')->param('quiz_id', 1)->param('quiz_option_id', 2),
                        Button::make('Третий вариант2')->action('response')->param('quiz_id', 1)->param('quiz_option_id', 3),
                    ])
                )->send();
        }
    }

    public function finish(): void
    {
        Log::debug(
            __METHOD__,
            [
                'chat' => $this,
//				'finish' => $this->message->toArray(),
            ]
        );
        if (!$this->data->get('quiz_id')) {
            return;
        }
//		$this->chat->message('Спасибо за ответ')
//			->deleteKeyboard($this->messageId)->send();


        $this->chat->deleteKeyboard($this->messageId)->send();
        $this->chat->message('Спасибо за ответ')->send();

    }
}
