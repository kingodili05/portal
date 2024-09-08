<?php

function updateConfig($newConfig) {
    $configFile = 'config.php';
    $configContent = "<?php\nreturn " . var_export($newConfig, true) . ";\n?>";
if (file_put_contents($configFile, $configContent)) {
$_SESSION['message'] = 'Configuration updated successfully.';
} else {
$_SESSION['error'] = 'Failed to update configuration.';
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_config'])) {
$config = include('config.php');
$config['refresh_count_threshold'] = intval($_POST['refresh_count_threshold']);
$config['enable_redirect'] = isset($_POST['enable_redirect']) ? true : false;
updateConfig($config);
}
?>