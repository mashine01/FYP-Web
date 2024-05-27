<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('front.partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/css/register.css">
</head>

@include('front.partials.messages')

<body>
    <div class="signup-container">
        <img src="/images/logo-white.png" alt="logo" class="auth-logo">
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
</body>

</html>
