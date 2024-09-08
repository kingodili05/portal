<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/settings.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="tabs">
            <div data-tab="redirect">Redirect</div>
            <div data-tab="telegram">Telegram</div>
        </div>


        <div id="redirect" class="tab-content active">
            <form class="form-section" method="post">
                <h2>Update Redirection</h2>
                <label for="enable_redirect">Enable Redirect:</label>
                <input type="checkbox" id="enable_redirect" name="enable_redirect"
                    <?php echo $config['enable_redirect'] ? 'checked' : ''; ?>>
                <br>
                <label for="refresh_count_threshold">Rediract Time (sec):</label>
                <input type="number" id="refresh_count_threshold" name="refresh_count_threshold"
                    value="<?php echo $config['refresh_count_threshold']; ?>" required>
                <br>
                <input type="submit" name="update_config" value="Update">
            </form>
        </div>

        <div id="telegram" class="tab-content">
            <form class="form-section" method="post">
                <h2>Telegram Update</h2>
                <label for="telegram_bot_token">Telegram Bot Token:</label>
                <input type="text" class="form-input" id="telegram_bot_token" name="telegram_bot_token"
                    value="<?php echo $tele['telegram_bot_token']; ?>" required>
                <br>
                <label for="telegram_chat_id">Telegram Chat ID:</label>
                <input type="text" class="form-input" id="telegram_chat_id" name="telegram_chat_id"
                    value="<?php echo $tele['telegram_chat_id']; ?>" required>
                <br>
                <input type="submit" class="form-btn" name="update_tele" value="Update">
            </form>
        </div>
    </div>

    <script>
    $('.tabs div').on('click', function() {
        var tab = $(this).data('tab');
        $('.tabs div').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').removeClass('active');
        $('#' + tab).addClass('active');
    });
    </script>

</body>

</html>