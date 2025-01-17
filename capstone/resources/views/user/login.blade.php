<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aid of Angels</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                <a a href="{{ route('admin.login') }}">
                    <img src="/img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">
                </a>
                
                <h4>LOG IN</h4>
            </div>
            <form method="POST" action="{{ route('user.check') }}">
                @csrf
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                </div>
                <div class="form-check d-flex justify-content-between">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                    <a href="#" class="text-primary">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-warning text-black w-100 mt-3">SUBMIT</button>
            </form>
            <div class="text-center mt-3">
                <span>Don't have an account? </span>
                <a href="{{ route('user.register') }}" class="text-primary">Register here</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
