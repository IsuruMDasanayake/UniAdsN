<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Institute</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #6A11CB, #2575FC);
        }

        /* Form wrapper */
        .form-wrapper {
            width: 90%;
            max-width: 900px;
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            gap: 20px;
            animation: fadeIn 1s ease-in-out;
            min-height: 300px;
        }

        /* Left Section */
        .form-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            padding-right: 20px;
        }

        .form-left h2 {
            font-size: 28px;
            color: #2575FC;
            margin-bottom: 10px;
        }

        .form-left p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .form-left ul {
            list-style: none;
            padding: 0;
            color: #333;
            font-size: 14px;
        }

        .form-left ul li {
            margin-bottom: 10px;
        }

        .form-left ul li strong {
            color: #2575FC;
        }

        /* Right Section */
        .form-right {
            flex: 2;
        }

        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #2575FC;
        }

        /* Button Styling */
        .auth-button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background-color: #2575FC;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        .auth-button:hover {
            background-color: #6A11CB;
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @media screen and (max-width: 768px) {
            .form-wrapper {
                flex-direction: column;
            }

            .form-left {
                padding-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <!-- Left Section -->
        <div class="form-left">
            <h2>Register Your Institute</h2>
            <p>Join UniAds and showcase your institute to the world.</p>
            <ul>
                <li><strong>5 Free Posts:</strong> Share your updates with the community.</li>
                <li><strong>Custom Profiles:</strong> Add a bio, photos, and contact details.</li>
                <li><strong>Analytics Tools:</strong> Gain insights into your audience.</li>
                <li><strong>Support:</strong> 24/7 assistance to help you succeed.</li>
            </ul>
        </div>

        <!-- Right Section -->
        <div class="form-right">
            <form action="{{ route('institute.store') }}" method="POST">
                @csrf

                <!-- Institute Name -->
                <div class="form-group">
                    <label for="institute_name">Institute Name</label>
                    <input type="text" id="institute_name" name="institute_name" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <!-- Location -->
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <!-- Government Registration Number -->
                <div class="form-group">
                    <label for="gov_register_number">Government Registration Number</label>
                    <input type="text" id="gov_register_number" name="gov_register_number" required>
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website"  required>
                </div>

                <!-- Contact Number -->
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="auth-button">Register Institute</button>
            </form>
        </div>
    </div>
</body>
</html>
           