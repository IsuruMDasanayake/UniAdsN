<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Institute</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* General reset */
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(to bottom right, #6A11CB, #2575FC);
    padding: 20px;
}

/* Wrapper */
.form-wrapper {
    width: 100%;
    max-width: 950px;
    background-color: white;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: row;
    gap: 30px;
    animation: fadeIn 1s ease-in-out;
}

/* Left Panel */
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
    font-size: 14px;
    color: #333;
}

.form-left ul li {
    margin-bottom: 10px;
}

.form-left ul li strong {
    color: #2575FC;
}

/* Right Form Area */
.form-right {
    flex: 2;
}

/* Input Group */
.form-group {
    width: 100%;
    margin-bottom: 15px;
    text-align: left;
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

/* Submit Button */
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

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive (Mobile) */
@media (max-width: 768px) {
    body {
        align-items: flex-start;
        padding: 30px 15px;
        height: auto; /* More padding to avoid clipped form */
    }

    .form-wrapper {
        flex-direction: column;
        padding: 30px 20px;
        gap: 20px;
        height: 1080px;         /* ✅ Allow form height to expand naturally */
        background-color: white;  /* ✅ Make sure white stretches fully */
    }

    .form-left {
        padding-right: 0;
        margin-bottom: 20px;
    }

    .form-left h2 {
        font-size: 24px;
    }

    .form-left p,
    .form-left ul {
        font-size: 14px;
    }

    .auth-button {
        font-size: 15px;
    }

    .form-group input {
        font-size: 15px;
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
           