<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('front.partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/css/editprofile.css">
</head>
@include('front.partials.messages')
<body>
    <a href="{{ route('index') }}" class="back-btn">Back</a>
    <div class="form-container">
        <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Edit Profile</h2>
            <input type="text" name="email" value="{{ Auth::user()->email }}" style="display: none;">
            <div class="profile-picture-container">
                <div class="profile-picture">
                    <img id="profile-image" src="{{ asset(Auth::user()->avatar) }}" alt="Profile Picture">
                    <input type="file" id="profile-picture-input" name="avatar"
                        accept="image/jpeg, image/jpg, image/png" onchange="loadFile(event); checkFileSize(event)">
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</body>

<script>
    function loadFile(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profile-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function checkFileSize(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const maxSizeInBytes = 2097152; // 2 MB

        if (file.size > maxSizeInBytes) {
            alert('File size exceeds the limit. Please select a smaller file.');
            // Clear the file input
            fileInput.value = '';
        }
    }
</script>

</html>
