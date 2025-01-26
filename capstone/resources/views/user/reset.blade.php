<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                
                    <img src="/img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">
                
                
                <h6>Reset your password here</h6>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                @csrf
                <div class="form-group">
                    <div>

                        <label for="loginPassword">New Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div>
                        <label for="loginPassword">Confirm Password:</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning text-black w-100 mt-3">Reset Password</button>
            </form>
            {{-- <form method="POST" action="{{ route('sendreset') }}">
                @csrf
                <div class="form-group">
                    <label for="loginEmail"></label>
                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Email" required>
                </div>
                
               
                <button type="submit" class="btn btn-warning text-black w-100 mt-3">Send Password Reset Link</button>
            </form> --}}
            {{-- <div class="text-center mt-3">
                <a href="{{ route('user.login') }}" class="text-primary">Back to Login</a>
            </div> --}}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div>
            <label>New Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html> --}}
