<?php

function updateTele($newTele) {
    $teleFile = 'tele.php';
    $teleContent = "<?php\nreturn " . var_export($newTele, true) . ";\n?>";
if (file_put_contents($teleFile, $teleContent)) {
$_SESSION['message'] = 'Telegram settings updated successfully.';
} else {
$_SESSION['error'] = 'Failed to update Telegram settings.';
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_tele'])) {
$tele = include('tele.php');
$tele['telegram_bot_token'] = trim($_POST['telegram_bot_token']);
$tele['telegram_chat_id'] = trim($_POST['telegram_chat_id']);
updateTele($tele);
}
?>