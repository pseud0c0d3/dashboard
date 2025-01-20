<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PDF Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header {
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #6c757d;
        }
        .metrics .card {
            margin-bottom: 15px;
            background-color: #fcfcfc;
            border: 1px solid #ddd;
            width: 100%;  /* Ensures full width of each column */
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Dashboard Report</h1>
            <p><strong>Date Range:</strong> {{ $startDate }} - {{ $endDate }}</p>
        </div>

        <!-- Metrics Section -->
        <div class="metrics row">
            <!-- First Row: New Posts, New Users, Upcoming Events and Appointments -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">New Posts</h5>
                        <h3 class="text-success">{{ $newPostsCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">New Users</h5>
                        <h3 class="text-success">{{ $newUsersCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Upcoming Events and Appointments</h5>
                        <h3 class="text-success">{{ $appointmentsCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="metrics row">
            <!-- Second Row: Total Posts, Total Users, Upcoming Events -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Posts</h5>
                        <h3 class="text-info">{{ $totalPostsCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Users</h5>
                        <h3 class="text-info">{{ $totalUsersCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Upcoming Events</h5>
                        <h3 class="text-info">{{ $upcomingEventsCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registered Users Table -->
        <h3 class="mt-5">Registered Users</h3>
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <p>Generated on {{ now()->format('Y-m-d H:i') }} | Company Name</p>
        </div>
    </div>
</body>
</html>
