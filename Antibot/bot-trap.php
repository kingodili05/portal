<?php
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Log the IP address
file_put_contents('blocked_ips.txt', $ipAddress . PHP_EOL, FILE_APPEND);

// Read the current IP list
$ipListFile = 'ip-list.php';
$ipList = include($ipListFile);

// Check if the IP is already in the list
if (!in_array($ipAddress, $ipList)) {
    // Add the new IP to the list
    $ipList[] = $ipAddress;

    // Write the updated list back to the file
    $ipListContent = "<?php\nreturn [\n";
    foreach ($ipList as $ip) {
        $ipListContent .= "    '$ip',\n";
    }
    $ipListContent .= "];\n?>";

file_put_contents($ipListFile, $ipListContent);
}

// Block the IP address
header('HTTP/1.0 403 Forbidden');
exit('Access denied');
?>