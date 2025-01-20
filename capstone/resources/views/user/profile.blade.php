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
<div class="container">
    <h1>Your Profile</h1>
    <div>
        <p>Name: {{ $user->name ?? 'No name provided' }}</p>
        <p>Email: {{ $user->email ?? 'No email provided' }}</p>
        <p>Bio: {{ $user->bio ?? 'No bio provided' }}</p>
        <p>Phone Number: {{ $user->phone_number ?? 'Not provided' }}</p>
        <p>Username: {{ $user->username ?? 'Not set' }}</p>

        @if($user->picture)
            <p>Profile Picture: <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" width="100"></p>
        @else
            <p>No profile picture set</p>
        @endif

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            Edit Profile
        </button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
            Change Password
        </button>
    </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" value="{{ old('current_password') }}" required>
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}" required>
                        @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required>
                        @error('new_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
@endif


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection
