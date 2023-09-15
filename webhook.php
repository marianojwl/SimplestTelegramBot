<?php
require './src/SimplestTelegramBot.php';
use marianojwl\SimplestTelegramBot;

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
 * BEGINING
 */

$tb = new SimplestTelegramBot(getenv('TELEGRAM_TOKEN'));