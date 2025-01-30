@extends('layouts.user-nav')
@section('navbar_title', 'PROFILE')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>
    
    /* Ensure profile picture maintains uniform size */
.profile-picture {
    width: 150px; /* Set the fixed width */
    height: 150px; /* Set the fixed height */
    object-fit: cover; /* Ensures the image scales properly without distorting */
}

</style>
    <!-- Display error messages -->
    {{-- @if($errors->any())
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
    @endif --}}



<div class="container mt-5 pt-5" style="auto; max-height: 100vh;">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row gutters-sm justify-content-center">
        <div class="col-12 mb-3">
            <div class="card rounded-5 " style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- Profile Picture Section -->
<div class="profile-picture-container">
    @if($user->picture)
        <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" class="rounded-circle img-fluid profile-picture" width="150" height="150">
    @else
        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm profile-picture" style="width: 150px; height: 150px; border: 3px solid #ff5722;">
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
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', Str::after($user->phone_number, '63')) }}" maxlength="10" pattern="\d{10}" required>
                            </div>
                            <small class="text-muted">Enter your 10-digit phone number (e.g., 9123456789).</small>
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
                    <form method="POST" action="{{ url('/profile/change-password') }}">

                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input
                                type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password"
                                name="current_password"
                                required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input
                                type="password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password"
                                name="new_password"
                                required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input
                                type="password"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                id="confirm_password"
                                name="new_password_confirmation"
                                required>
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Button to trigger modal -->
{{-- <button class="btn btn-info btn-lg rounded-pill px-4 py-2 shadow-lg" data-bs-toggle="modal" data-bs-target="#childViewModal">
    <i class="bi bi-eye me-2"></i>View Child Info
</button> --}}

<!-- Child View Modal -->
<div class="modal fade" id="childViewModal" tabindex="-1" aria-labelledby="childViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #17a2b8;">
                <h5 class="modal-title" id="childViewModalLabel">Child Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> {{ $child->name ?? 'Not Provided' }}</p>
                <p><strong>Age:</strong> {{ $child->age ?? 'Not Provided' }}</p>
                <p><strong>Condition:</strong> {{ $child->condition ?? 'Not Provided' }}</p>
                <p><strong>Height:</strong> {{ $child->height ?? 'Not Provided' }} cm</p>
                <p><strong>Weight:</strong> {{ $child->weight ?? 'Not Provided' }} kg</p>
                <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#childEditModal" data-bs-dismiss="modal">Edit Information</button>
            </div>
        </div>
    </div>
</div>

<!-- Child Edit Modal -->
<div class="modal fade" id="childEditModal" tabindex="-1" aria-labelledby="childEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #ffc107;">
                <h5 class="modal-title" id="childEditModalLabel">Edit Child Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="{{ route('child.update') }}"method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="mb-3">
                        <label for="child_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="child_name" name="child_name" value="{{ old('child_name', $child->name ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="child_age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="child_age" name="child_age" value="{{ old('child_age', $child->age ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="child_condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" id="child_condition" name="child_condition" value="{{ old('child_condition', $child->condition ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="child_height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="child_height" name="child_height" value="{{ old('child_height', $child->height ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="child_weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="child_weight" name="child_weight" value="{{ old('child_weight', $child->weight ?? '') }}">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Save Changes</button>
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


    <script>
        document.getElementById("phone_number").addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });

        document.querySelector("form").addEventListener("submit", function (event) {
            let phone = document.getElementById("phone_number");
            if (phone.value.length !== 10) {
                alert("Phone number must be exactly 10 digits!");
                event.preventDefault();
            }
        });
    </script>
@endsection
