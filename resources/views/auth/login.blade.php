<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UniAds</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">
    <div class="auth-form">
        <img src="{{ asset('images/logo.png') }}" alt="UniAds Logo" class="form-logo">
        <h2>Welcome Back!</h2>
        <p>Log in to continue exploring educational opportunities.</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="auth-button">Log In</button>
        </form>

        <p class="redirect">Don't have an account? <a href="{{ route('register') }}">Register here</a>.</p>
        @if (Route::has('password.request'))
                <div class="form-group">
                    <a href="{{ route('password.resetForm') }}" class="forgot-password-link">Forgot Password?</a>
                </div>
            @endif
    </div>
</div>

</body>
</html>
