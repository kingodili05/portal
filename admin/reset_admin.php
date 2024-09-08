<?php

function updateAdminConfig($newAdminConfig) {
    $adminConfigFile = 'admin_config.php';
    $adminConfigContent = "<?php\nreturn " . var_export($newAdminConfig, true) . ";\n?>";
if (file_put_contents($adminConfigFile, $adminConfigContent)) {
$_SESSION['message'] = 'Admin credentials updated successfully.';
} else {
$_SESSION['error'] = 'Failed to update admin credentials.';
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_admin'])) {
$adminConfig = include('admin_config.php');
$currentPassword = $_POST['current_password'];
$newUsername = $_POST['new_username'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

if (password_verify($currentPassword, $adminConfig['admin_password'])) {
if ($newPassword === $confirmPassword) {
$adminConfig['admin_username'] = $newUsername;
$adminConfig['admin_password'] = password_hash($newPassword, PASSWORD_DEFAULT);
updateAdminConfig($adminConfig);
} else {
$_SESSION['error'] = 'New passwords do not match.';
}
} else {
$_SESSION['error'] = 'Current password is incorrect.';
}
}
?>