<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aid of Angels</title>
    <!-- FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-image: url('/img/bak.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
      <!-- Navbar with Styled Interactive Back Button -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a href="{{ route('index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</nav>

<!-- FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<!-- Custom CSS for Interactive Back Button -->
<style>
    .back-button {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background: rgba(255, 255, 255, 0.2); /* Glassmorphism effect */
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 30px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
    }

    .back-button i {
        font-size: 18px;
    }

    /* Hover Effect */
    .back-button:hover {
        background: rgba(255, 255, 255, 0.4);
        border-color: rgba(255, 255, 255, 0.6);
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        text-decoration: none;
        color: white;
    }

    /* Click Effect */
    .back-button:active {
        transform: scale(0.95);
    }
</style>
<body>

@include('components.preloader')
      <!-- Navbar with Styled Interactive Back Button -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a href="{{ route('index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; background-color: rgba(255, 255, 255, 0.9);">
            <div class="text-center">
                <img src="/img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">
                <h4>REGISTER</h4>
            </div>

            <form action="{{ route('user.save') }}" method="POST" id="registrationForm">
                @csrf

                <!-- Username Input -->
                <div class="form-group">
                    <label for="username">Fullname</label>
                    <input
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="registerEmail"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="registerPassword"
                        name="password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="form-group">
                    <label for="repeatPassword">Confirm Password</label>
                    <input
                        type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="repeatPassword"
                        name="password_confirmation"
                        required
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms Checkbox -->
                <div class="form-check mb-3">
                    <input
                        class="form-check-input @error('terms') is-invalid @enderror"
                        type="checkbox"
                        id="termsCheckbox"
                        name="terms"
                        required
                    >
                    <label class="form-check-label" for="termsCheckbox">
                        I agree to <a href="#">Terms of Use</a>
                    </label>
                    @error('terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning text-black w-100" id="submitBtn">SUBMIT</button>
            </form>

            <div class="text-center mt-3">
                <span>Already have an account? </span>
                <a href="{{ route('user.login') }}" id="log"class="text-primary">Log in here</a>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("registrationForm").addEventListener("submit", function() {
                var submitButton = document.getElementById("submitBtn");
                submitButton.disabled = true;
                submitButton.innerText = "Processing...";
                submitButton.classList.remove("btn-warning");
                submitButton.classList.add("btn-secondary"); // Turns the button grey
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
