<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aid of Angels</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                <img src="/img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">
                <h4>REGISTER</h4>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('user.save') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control" id="registerEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control" id="registerPassword" name="password" required>
                </div>
                <div class="form-group">
                    <label for="repeatPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="repeatPassword" name="password_confirmation" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                        I agree to <a href="#">Terms of Use</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-warning text-black w-100">SUBMIT</button>
            </form>
            <div class="text-center mt-3">
                <span>Already have an account? </span>
                <a href="{{ route('user.login') }}" class="text-primary">Log in here</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
