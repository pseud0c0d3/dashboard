@extends('layouts.user-nav')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

<style>
::-webkit-scrollbar {
    display: none;
}
/* Hover effect for the dropdown button */
#navbarDropdown:hover {
    background-color: #f8f9fa; /* Light background on hover */
    border-color: #007bff; /* Border color when hovered */
}

/* Hover effect for dropdown items with scale animation */
.dropdown-item:hover {
    background-color: #007bff; /* Blue background on hover */
    color: #fff; /* White text on hover */
    transform: scale(1.05); /* Slightly increase size */
    transition: transform 0.2s ease-in-out; /* Smooth transition */
}

/* Hover effect for the profile picture button */
.dropdown-toggle:hover img {
    opacity: 0.8; /* Slight opacity change for profile image on hover */
    transform: scale(1.15); /* Slightly increase size */

}
</style>
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

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="font-family: 'Roboto', sans-serif; margin-left: 250px; height: 80px; padding-left: 50px;     background: linear-gradient(#3677b3,#3677b3);
">
    <div class="container-fluid">
        <a class="navbar-brand " style="font-size: 45px;" href="{{ route('posts.index') }}">PROFILE</a>
        <div class="dropdown ms-4">
    <button 
        class="btn btn-light dropdown-toggle d-flex align-items-center" 
        type="button" 
        id="navbarDropdown" 
        data-bs-toggle="dropdown" 
        aria-expanded="false"
    >
        <!-- Profile Picture or Initials -->
        @if($user->picture)
            <img 
                src="{{ asset('storage/' . $user->picture) }}" 
                alt="Profile Picture" 
                class="rounded-circle img-fluid" 
                width="40" 
                height="40" 
                style="object-fit: cover; border: 2px solid #ddd;" 
            >
        @else
            <div 
                class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm" 
                style="width: 40px; height: 40px; border: 2px solid #ff5722;"
            >
                <span class="h6 text-muted m-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
        @endif

        <!-- Optional Text -->
        <span class="ms-2">{{ $user->name }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('user.faq') }}">Help</a></li>
        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Log Out</a></li>
        <li><hr class="dropdown-divider"></li>
    </ul>
</div>

    </div>
</nav>

<div class="container mt-5 pt-5" style="auto; max-height: 100vh;">

    <div class="row gutters-sm justify-content-center">
        <div class="col-12 mb-3">
            <div class="card rounded-5 " style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- Profile Picture Section -->
                        <div class="profile-picture-container">
                            @if($user->picture)
                                <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" class="rounded-circle img-fluid" width="150">
                            @else
                                <div class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 160px; height: 160px; border: 3px solid #ff5722;">
                                    <span class="h3 text-muted">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <h4>{{ $user->name ?? 'No name provided' }}</h4>
                            <p class="text-secondary mb-1">{{ $user->bio ?? 'No bio provided' }}</p>
                            <button class="btn btn-primary btn-lg rounded-pill px-4 py-2 shadow-lg" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square me-2"></i>Edit Profile
                            </button>
                            <button class="btn btn-outline-primary btn-lg rounded-pill px-4 py-2 shadow-lg" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-lock-fill me-2"></i>Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->name ?? 'No name provided' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->email ?? 'No email provided' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Phone Number</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->phone_number ?? 'Not provided' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->username ?? 'Not set' }}
                        </div>
                    </div>
                    
             
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'), { keyboard: false });
            myModal.show();
        </script>
    @endif

@endsection
