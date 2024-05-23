<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="reset.css">
</head>
<body>
    <script src="reset.js" defer></script>
    <div class="form-container">
        <form action="/reset-password" method="post" id="reset-password-form">
            <h2>Reset Password</h2>

            <div class="form-group">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
    
    
</body>
</html>
