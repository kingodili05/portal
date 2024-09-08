<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin | Live Panel</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.ico">
    <script src="scripts.js"></script>
    <style>
    @keyframes scroll-left {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="../images/logo.ico" alt="Pulumbu" style="width: 180px; height: 105px; padding: 10px;"><br>
        <button onclick="showSection('dashboard')" id="dashboardBtn">Dashboard</button>
        <button onclick="showSection('settings')" id="settingsBtn">Settings</button>
        <button onclick="showSection('account')" id="accountBtn">Account</button>
    </div>
    <div class="content">
        <div id="dashboard" class="section">
            <?php include('dashboard.php'); ?>
        </div>
        <div id="settings" class="section" style="display:none;">
            <?php include('settings.php'); ?>
        </div>
        <div id="account" class="section" style="display:none;">
            <?php include('account.php'); ?>
        </div>
    </div>
    <div class="footer">
        <p
            style="position: relative; white-space: nowrap; overflow: hidden; width: 100%; box-sizing: border-box; animation: scroll-left 30s linear infinite;">
            For more
            <span style="color: red;">Pages </span> -
            <span style="color: lime;">Sender </span>-
            <span style="color: green;">Mailer </span>-
            <span style="color: cyan;">Cracker </span>-
            <span style="color: coral;">Checker </span>-
            <span style="color: teal;">RDP </span>-
            <span style="color: magenta;">Custom sites </span>-
            <span style="color: orange;">Updates </span><br>
            <span style="color: white;">Contact us on </span>
            <span style="color: olive;">=> </span>
            <span style="color: white;">Telegram: </span>
            <span style="color: cyan;">pulumbuinc </span>|
            <span style="color: white;">Channel: </span>
            <span style="color: lime;">pulumbuchannel</span>
        </p>
        <p>© 2024 Pulumbu Inc. | All rights reserved.</p>
    </div>

    <div class="overlay" id="overlay" onclick="hideDetails()"></div>
    <div class="popup" id="popup">
        <h2 id="popupTitle"></h2>
        <p id="popupContent"></p>
        <button class="close" onclick="hideDetails()">Close</button>
    </div>

    <div class="overlay" id="resultsOverlay" onclick="hideResults()"></div>
    <div class="popup" id="resultsPopup">
        <h2>Results</h2>
        <div id="resultsContent"></div>
        <button class="close" onclick="hideResults()">Close</button>
    </div>

    <div class="overlay" id="actionOverlay" onclick="hideAction()"></div>
    <div class="popup" id="actionPopup">
        <h2>Action</h2>
        <div id="actionContent"></div>
        <button class="close" onclick="hideAction()">Close</button>
    </div>
</body>

</html>