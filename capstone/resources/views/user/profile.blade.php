@extends('layouts.user-nav')

@section('content')

        <!-- Display error messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container py-4">
<h1 class="text-center mb-4 text-primary profile-heading">Your Profile</h1>

    <div class="row justify-content-center" >
        <div class="col-md-11">
        <div class="card rounded-5" style="width: 1000px; box-shadow: rgba(82, 194, 245, 0.94) 5px 5px, rgba(22, 163, 202, 0.83) 10px 10px, rgba(71, 125, 212, 0.79) 15px 15px, rgba(57, 139, 227, 0.66) 20px 20px, rgba(56, 170, 222, 0.81) 25px 25px;">
    <div class="card-body p-5">
        <div class="row align-items-center">
            <!-- Profile Picture Section -->
            <div class="col-md-4 text-center">
                @if($user->picture)
                    <div class="profile-picture-container">
                        <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" 
                            class="rounded-circle">
                    </div>
                @else
                    <div class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm" 
                        style="width: 160px; height: 160px; border: 3px solid #ff5722;">
                        <span class="h3 text-muted">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                @endif
            </div>

            <!-- User Info Section -->
            <div class="col-md-8">
                <div class="mb-4">
                    <p><strong class="text-muted">Name:</strong> <span class="fw-bold">{{ $user->name ?? 'No name provided' }}</span></p>
                    <p><strong class="text-muted">Email:</strong> <span class="fw-bold">{{ $user->email ?? 'No email provided' }}</span></p>
                    <p><strong class="text-muted">Bio:</strong> <span class="fw-bold">{{ $user->bio ?? 'No bio provided' }}</span></p>
                    <p><strong class="text-muted">Phone Number:</strong> <span class="fw-bold">{{ $user->phone_number ?? 'Not provided' }}</span></p>
                    <p><strong class="text-muted">Username:</strong> <span class="fw-bold">{{ $user->username ?? 'Not set' }}</span></p>
                </div>

                <!-- Action Buttons Section -->
                <div class="d-flex justify-content-start gap-3">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-4 py-2 shadow-lg" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                    </button>
                    <button type="button" class="btn btn-warning btn-lg rounded-pill px-4 py-2 shadow-lg" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="bi bi-lock-fill me-2"></i>Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
</style>

        </div>
    </div>
</div>
<style>
body, html {
    overflow: hidden;
    height: 100%;
}
.profile-picture-container {
        width: 290px;
        height: 290px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        display: inline-block;
        border-radius: 50%;
        margin-left: -20px;
    }

    .profile-picture-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
.profile-heading {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 2.5rem;
    color: #007bff;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
}

.profile-heading:hover {
    color: #0056b3;
    text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.border-custom {
    border: 2px solid transparent;
    border-radius: 20px;
    background-origin: border-box;
    background-clip: content-box;
    box-shadow: 0 20px 50px rgb(14, 141, 238);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    border-color: rgb(31, 0, 103);
}


.btn {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary {
    background-color: rgb(113, 195, 245);
    border-color: #007bff;
    color: black;
}

.btn-warning {
    background-color: rgb(113, 195, 245);
    border-color: #007bff;
}

.btn-primary:hover, .btn-warning:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: whitesmoke;
}

.btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.card-body p {
    font-size: 1.5rem;
    line-height: 1.7;
    margin-bottom: 1rem;
}

</style>
<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0056b3;">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                        @if($user->picture)
                            <p>Current profile picture: <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" width="100"></p>
                        @else
                            <p>No profile picture set</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="09-- --- ----" maxlength="11">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0056b3;">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea class="form-control" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="picture" class="form-label">Profile Picture</label>
        <input type="file" class="form-control" id="picture" name="picture">
        @if($user->picture)
            <p>Current profile picture: <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" width="100"></p>
        @else
            <p>No profile picture set</p>
        @endif
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="09-- --- ----" maxlength="11">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
</form>


                    <button type="submit" class="btn btn-warning w-100">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'),         {
            keyboard: false
        });
        myModal.show();
    </script>
@endif

@endsection

