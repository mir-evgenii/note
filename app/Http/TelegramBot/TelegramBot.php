<?php

namespace App\Http\TelegramBot;

use App\Models\NoteNotifications;
use App\Models\Telegram;
use App\Models\Note;
use App\Models\User;
use DateInterval;
use DateTime;

class TelegramBot
{
    private const TOKEN = 'TELEGRAM_BOT_TOKEN'; // this is variable name in .env file
    private const APILINK = "https://api.telegram.org/bot";

    private static function getApiLink() {
        return self::APILINK . env(self::TOKEN) . '/';
    }

    private static function getUpdate() {
        $update = file_get_contents(self::getApiLink() . 'getUpdates');
        $updateArray = json_decode($update, TRUE);

        return $updateArray;
    }

    private static function send($message, $chatId) {
        file_get_contents(self::getApiLink() . "sendmessage?chat_id={$chatId}&text={$message}");
    }

    public static function runBot() {
        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');
        $date->add(new DateInterval('PT1M'));
        $future = $date->format('Y-m-d H:i:s');

        $notifications = NoteNotifications::whereBetween('notify_at', [$now, $future])->get();

        if ($notifications != null) {
            foreach ($notifications as $value) {
                $note = Note::find($value->note_id);
                $telegram = Telegram::where('user_id', $note->user_id)->first();
                if ($note != null && $telegram != null) {
                    $message = $note->title.' '.$note->content;
                    $chatId = $telegram->chat_id;
                    self::send($message, $chatId);
                }
            }
        }
    }
}