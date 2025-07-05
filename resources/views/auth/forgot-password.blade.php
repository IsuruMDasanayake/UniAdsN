<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #6A11CB, #2575FC);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            font-weight: bold; /* Bold heading */
            color: #1877f2;
            margin-bottom: 10px;
        }

        p.subtitle {
            font-size: 14px;
            font-weight: bold; /* Bold subtitle */
            color: #606770;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-size: 15px;
            color: #444;
            display: block;
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            background-color: #f7f9fc;
            margin-left: -10px
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #1877f2;
            background-color: #ffffff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
        }

        button:hover {
            background-color: #0056b3;
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #1877f2;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
    body {
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        flex-direction: column;
    }

    .container {
        padding: 25px 10px;
        width: 320px;
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 22px;
    }

    p.subtitle {
        font-size: 13px;
    }

    label {
        font-size: 14px;
    }

    input[type="email"],
    input[type="text"],
    input[type="password"] {
        font-size: 15px;
        padding: 9.5px;
        width: 95%;
        margin-left: -1px;
    }

    button {
        font-size: 15px;
        padding: 10px;
    }

    .link {
        font-size: 13px;
    }
}

        
    </style>
</head>

<body>
    <div class="container">
        <h1>Forgot Password?</h1>
        <p class="subtitle">Enter your email to reset your password.</p>

        <!-- Show session status message -->
        @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
        @endif

        <!-- Show error messages -->
        @if ($errors->any())
        <div class="alert alert-error">
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Password Reset Form -->
        <form method="POST" action="{{ route('password.sendResetCode') }}">
            @csrf
            <div class="form-group">
                <label for="email"></label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com">
            </div>
            <button type="submit">Send Reset Code</button>
        </form>

        <div class="link">
            <p>Remember your password? <a href="{{ route('login') }}">Login</a></p>
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a>.</p>
        </div>
    </div>
</body>

</html>