<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    
    <!-- Displaying Errors -->
    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="login-container">
        <h1>Login</h1>
        <form id="login-form" action="{{ route('login') }}" method="post">
            @csrf
            @method('POST')
            <div class="input-group">
                <input type="text" id="email" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="input-group">
                <label for="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me"> Remember Me
                </label>
            </div>
            <div class="input-group">
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <div class="input-group">
                <input type="submit" value="Login">
            </div>
            <div class="input-group">
                <div class="error-message" id="error-message"></div> <br>
                <a style="border-radius: 7px;" href="{{ route('register') }}">Sign up </a>
            </div>
        </form>
    </div>
</body>

</html>
