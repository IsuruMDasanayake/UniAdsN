<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Updated font */
            background: linear-gradient(to bottom right, #6A11CB, #2575FC); /* Updated background color */
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
            gap: 50px; /* Added gap for better spacing */
        }

        label {
            font-size: 15px;
            color: #444;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            background-color: #f7f9fc;
            width: 400px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #1877f2;
            background-color: #ffffff;
        }

        label + input {
    margin-top: 1px; /* Optional: Space between label and its own input */
}

.form-group:nth-child(2) label,
.form-group:nth-child(3) label {
    margin-top: 10px;
    display: inline-block;
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-list {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .error-list li {
            color: #d9534f;
            font-size: 14px;
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
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
    }

    .container {
        width: 100%;
        max-width: 95%;
        padding: 25px 10px;
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

    input[type="text"],
    input[type="password"] {
        font-size: 15px;
        padding: 10px;
        width: 300px
    }

    label + input {
    margin-top: 1px; /* Optional: Space between label and its own input */
}

.form-group:nth-child(2) label,
.form-group:nth-child(3) label {
    margin-top: 10px;
    display: inline-block;
}

    
    button {
        font-size: 15px;
        padding: 10px;
    }

    .link {
        font-size: 13px;
    }

    .alert {
        font-size: 14px;
    }

    .error-list li {
        font-size: 13px;
    }
}

    </style>
</head>

<body>
    <div class="container">
        <h1>Reset Password</h1>
        <p class="subtitle">Enter the reset code and your new password.</p>

        @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.reset') }}">
            @csrf
            <div class="form-group">
                <label for="reset_code">Enter Reset Code:</label>
                <input type="text" name="reset_code" id="reset_code" required>

                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit">Submit Reset Code</button>
        </form>

        <div class="link">
           
        </div>
    </div>
</body>

</html>
