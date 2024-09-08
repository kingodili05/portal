<?php
session_start();
$_SESSION['passed_security'] = true;
echo json_encode(['status' => 'session_set']);
?>