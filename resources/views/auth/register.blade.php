<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="/css/register.css">
</head>

<body>
    <!-- Displaying Errors -->
    @if ($errors->any())
        <div id="errorModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="signup-container">
        <img style="object-fit: contain;" height="250px" width="250px" src="/images/logo.png" alt="logo">
        <h2>Sign Up</h2>
        <form id="login-form" action="{{ route('register') }}" method="post">
            @csrf
            @method('POST')
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm password" required>
            </div>
            <input type="submit" value="Sign Up">
            <div class="error-message" id="error-message"></div> <br>
            <div class="login-link">Already have an account?<a href="{{ route('login') }}"> Log in</a></div>
        </form>
    </div>

    <script>
        // JavaScript to control the modal
        var modal = document.getElementById('errorModal');
        var closeBtn = document.getElementsByClassName("close")[0];

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
