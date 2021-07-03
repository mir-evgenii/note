<?php

namespace App\Http\TelegramBot;

class TelegramBot
{
    private const TOKEN = 'TELEGRAM_BOT_TOKEN'; // this is variable name in .env file
    private const APILINK = "https://api.telegram.org/bot";

    private static function getApiLink() {
        return self::APILINK . env(self::TOKEN) . '/';
    }

    public static function getUpdate() {
        $update = file_get_contents(self::getApiLink() . 'getUpdates');
        $updateArray = json_decode($update, TRUE);

        return $updateArray;
    }

    public static function send($message, $chatId) {
        file_get_contents(self::getApiLink() . "sendmessage?chat_id={$chatId}&text={$message}");
    }

}