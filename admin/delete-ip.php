<?php
$listType = $_POST['list'];
$ip = $_POST['ip'];

if ($listType === 'whitelist') {
    $whitelist = include('../Antibot/good-ip-list.php');
    $whitelist = array_filter($whitelist, function($item) use ($ip) {
        return $item !== $ip;
    });
    file_put_contents('../Antibot/good-ip-list.php', '<?php return ' . var_export($whitelist, true) . ';');
} elseif ($listType === 'blacklist') {
    $blacklist = include('../Antibot/ip-list.php');
    $blacklist = array_filter($blacklist, function($item) use ($ip) {
        return $item !== $ip;
    });
    file_put_contents('../Antibot/ip-list.php', '<?php return ' . var_export($blacklist, true) . ';');
}
?>