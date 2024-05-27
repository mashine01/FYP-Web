<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('front.partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/register.css">
</head>
@include('front.partials.messages')

<body>
    <div class="signup-container">
        <img style="object-fit: contain;" height="250px" width="250px" src="/images/logo.png" alt="logo">
        <h2>Login</h2>
        <form id="login-form" action="{{ route('login') }}" method="post">
            @csrf
            @method('POST')
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Login">
            <div class="error-message" id="error-message"></div> <br>
            <div class="login-link">Don't have an account?<a href="{{ route('register') }}"> Register</a></div>
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
