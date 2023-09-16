<?php
header('Cache-Control: no-cache, no-store, must-revalidate');

/**
 * Load TELEGRAM_TOKEN stored in .env file
 */
if (file_exists('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($key, $value) = explode('=', $line, 2);
        putenv("$key=$value");
    }
}

/**
 * Includes
 */
require './src/SimplestTelegramBot.php';
use marianojwl\SimplestTelegramBot;

/**
 * Load language file
 */
$languageFile = 'lang/es.json';
if (file_exists($languageFile)) {
    $lang = json_decode(file_get_contents($languageFile), true);
} else {
    $lang = [
        "welcome" => "Welcome!"
    ];
}

/**
 * BEGINNING
 */

$tb = new SimplestTelegramBot( getenv('TELEGRAM_TOKEN') );
$msg = $tb->receiveMessage();

// abort if is not a message
if( !isset($msg['update_id']) )
    die();

$chat_id = $msg['message']['chat']['id'];

if( isset($msg['message']['text']) ) {
    $text = $msg['message']['text'];

    if (strpos($text, '/') === 0) {
        // Extract the command
        $command = strtok($text, ' ');
        switch($command) {
            case "/start":
                $tb->sendMessage($chat_id, $lang['welcome']);
                break;
            case "/soporte":
                $tb->sendMessage($chat_id, '<a href="https://t.me/'. getenv('SUPPORT_USER') .'">' . $lang['chat_with_support'] . '</a>');
                break;
            default:
                $tb->sendMessage($chat_id, $lang['unknown_command']);
                break;
        }
    } else {
        switch($text) {
            default:
            $tb->sendMessage($chat_id, $lang['no_answer']);
                break;
            case "hola":
            case "Hola":
                $tb->sendMessage($chat_id, $lang['welcome']);
                break;
        }

    }

} else {
    $tb->sendMessage($chat_id, $lang['not_supported']);
}
