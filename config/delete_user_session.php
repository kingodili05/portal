<?php
function deleteUserSession($id) {
    $sessionFile = "../sessions/$id.json";
    if (file_exists($sessionFile)) {
        unlink($sessionFile);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteUserSession($id);
    header("Location: ../admin/index.php");
    exit();
}
?>