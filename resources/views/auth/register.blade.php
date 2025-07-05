<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | UniAds</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">
    <div class="auth-form">
        
        <h2>Join UniAds</h2>
        <p>Create an account to start your educational journey.</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="auth-button">Register as Normal User</button>
        </form>

        <p class="redirect">Already have an account? <a href="{{ route('login') }}">Log in here</a>.</p>

        <!-- Institute Registration Button -->
        <div class="institute-section">
            <p class="institute-text">Are you an institute? Register your institution here:</p>
            <a href="{{ url('/institutionprofileadd') }}" class="institute-button">Institute Registration</a>
        </div>
    </div>
</div>

</body>
</html>
