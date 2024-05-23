<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="abc.css">
    <script src="abc.js"></script>
</head>
<body>
    <div class="form-container">
        <form action="/submit-profile" method="post" enctype="multipart/form-data">
            <h2>Edit Profile</h2>
            
            <div class="profile-picture">
                <img id="profile-image" src="icon.jpg" alt="Profile Picture">
                <input type="file" id="profile-picture-input" name="profile-picture" accept="image/*" onchange="loadFile(event)">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
            </div>

            <button type="submit">Save</button>
            <a href="reset.html" class="reset-password-link">Reset Password</a>
        </form>
    </div>
</body>
</html>
