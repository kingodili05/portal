<form method="post">
    <h2>Reset Admin Credentials</h2>
    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" required>
    <br>
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" required>
    <br>
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>
    <br>
    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br>
    <input type="submit" name="reset_admin" value="Reset">
</form>