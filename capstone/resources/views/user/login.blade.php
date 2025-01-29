<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aid of Angels</title>
    <!-- FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<!-- Custom CSS for Interactive Back Button -->
<style>
            body {
            background-image: url('/img/bak.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
        }

    .back-button {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background: rgba(255, 255, 255, 0.34); /* Glassmorphism effect */
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
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                <a href="{{ route('admin.login') }}">
                    <img src="/img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">
                </a>
                <h4>LOG IN</h4>
            </div>

            <!-- Display Validation Errors -->
       

            <form method="POST" action="{{ route('user.check') }}">
                @csrf

                <!-- Email Input -->
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="loginEmail"
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
                    <label for="loginPassword">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="loginPassword"
                        name="password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="form-check d-flex justify-content-between">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                    <a href="{{ route('forgot.password') }}" class="text-primary">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning text-black w-100 mt-3">SUBMIT</button>
            </form>

            <!-- Registration Link -->
            <div class="text-center mt-3">
                <span>Don't have an account? </span>
                <a href="{{ route('user.register') }}" id="reg"class="text-primary">Register here</a>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to show preloader and then navigate to the href
function showPreloaderAndRedirect(event) {
  event.preventDefault();  // Prevent the default behavior of the link
  
  // Show the preloader
  document.getElementById('preloader').style.display = 'flex';
  
  // Get the href from the clicked link
  const href = event.target.getAttribute('href');
  
  // Redirect after a short delay (1.5 seconds in this case)
  setTimeout(function() {
    window.location.href = href;
  }, 1500);  // Adjust the delay as needed
}

// Attach event listener to the 'Get Started' button
document.getElementById('reg').addEventListener('click', showPreloaderAndRedirect);

    </script>
</body>
</html>
