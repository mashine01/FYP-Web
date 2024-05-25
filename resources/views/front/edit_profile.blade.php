<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/css/editprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="abc.js"></script>
</head>

<body>
    <div class="form-container">
        <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Edit Profile</h2>
            <input type="text" name="email" value="{{ Auth::user()->email }}" style="display: none;">
            <div class="profile-picture-container">
                <div class="profile-picture">
                    <img id="profile-image" src="{{ asset(Auth::user()->avatar) }}" alt="Profile Picture">
                    <input type="file" id="profile-picture-input" name="avatar" accept="image/*"
                        onchange="loadFile(event)">
                </div>
            </div>

            <button type="submit">Save</button>
            <a href="reset.html" class="reset-password-link">Reset Password</a>
        </form>
    </div>
</body>

</html>
