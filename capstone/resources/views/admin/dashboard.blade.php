@extends('layouts.admin-nav')

@section('content')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.dashboard.pdf') }}" class="btn btn-primary position-fixed" style="top: 20px; right: 20px;">Download as PDF</a>
    </div>


    <!-- Date Range Filter -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="row mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Filter Reports from:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">to:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Reports Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Posts in Forum</h5>
                    <p class="card-text">{{ $newPostsCount }}</p>
                    <canvas id="newPostsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Users Registered</h5>
                    <p class="card-text">{{ $newUsersCount }}</p>
                    <canvas id="newUsersChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Upcoming Events and Appointments</h6>
                    <p class="card-text">{{ $upcomingEventsCount }}</p>
                    <canvas id="upcomingEventsChart"></canvas>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text">{{ $totalPostsCount }}</p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Registered Users</h5>
                    <p class="card-text">{{ $totalUsersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Events and Appointments Made</h6>
                    <p class="card-text">{{ $appointmentsCount }}</p>
                </div>
            </div>
        </div>

    </div>





</div>

<script>
    const newPostsData = @json(array_values($newPostsData->toArray()));
    const newUsersData = @json(array_values($newUsersData->toArray()));
    const upcomingEventsData = @json(array_values($upcomingEventsData->toArray()));

    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const chartOptions = {
        type: 'bar',
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    new Chart(document.getElementById('newPostsChart'), {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'New Posts',
                data: newPostsData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(document.getElementById('newUsersChart'), {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'New Users',
                data: newUsersData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(document.getElementById('upcomingEventsChart'), {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'Upcoming Events',
                data: upcomingEventsData,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        }
    });
</script>

@endsection
