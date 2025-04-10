@extends('layouts.admin-nav')

@section('navbar_title', 'DASHBOARD') 
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<!-- Include Chart.js -->
<style>
    .container {
        margin-top: 50px;
    }
    .btn-primary.position-fixed {
        top: 90px;
        right: 20px;
        z-index: 1050;
        background-color: #6c63ff;
        border: none;
        padding: 12px 24px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn-primary.position-fixed:hover {
        background-color: #5a54e0;
    }

    .card {
        transition: transform 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card-title {
        font-weight: bold;
        color: #333;
    }

    .card-body {
        background-color: #f9f9f9;
    }

    

    .card-new-users {
        background-color: #d3eaf9;
        border-left: 5px solid #4fa3f7;
    }

    .card-upcoming-events {
        background-color: #d8f7e4;
        border-left: 5px solid #76d7c4;
    }

    .card-posts {
        background-color: #fff3e6;
        border-left: 5px solid #ffb84d;
    }

    .card-total-users {
        background-color: #e6f7ff;
        border-left: 5px solid #1d9bfa;
    }

    .card-events-appointments {
        background-color: #f0f9f1;
        border-left: 5px solid #2baf4e;
    }
    .card-visits {
        background-color: #f0f9f1;
        border-left: 5px solid #af2ba4;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #6c63ff;
        border: none;
        margin-top: -2px;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #5a54e0;
    }

    .row.mb-4 {
        margin-bottom: 30px;
    }

    .d-flex.justify-content-end.mb-3 {
        position: relative;
    }

    @media (max-width: 768px) {
    .btn-primary {
        width: 150px;
        margin-top: 50px;
    }

    .btn-primary:hover {
        background-color: #5a54e0;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">

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
        <div class="col-md-3">
            <div class="card card-visits">
                <div class="card-body">
                    <h5 class="card-title">Visits(Unique)</h5>
                    <p class="card-text">{{ $visitsCount }}</p>
                    <canvas id="visitsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-posts">
                <div class="card-body">
                    <h5 class="card-title">New Posts in Forum</h5>
                    <p class="card-text">{{ $newPostsCount }}</p>
                    <canvas id="newPostsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-new-users">
                <div class="card-body">
                    <h5 class="card-title">New Users Registered</h5>
                    <p class="card-text">{{ $newUsersCount }}</p>
                    <canvas id="newUsersChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-upcoming-events">
                <div class="card-body">
                    <h6 class="card-title">Upcoming Events and Appointments</h6>
                    <p class="card-text">{{ $upcomingEventsCount }}</p>
                    <canvas id="upcomingEventsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-visits">
                <div class="card-body">
                    <h6 class="card-title">Total Visits</h6>
                    <p class="card-text">{{$totalvisitsCount}}</p>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-posts">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text">{{ $totalPostsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-total-users">
                <div class="card-body">
                    <h5 class="card-title">Total Registered Users</h5>
                    <p class="card-text">{{ $totalUsersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-events-appointments">
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
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });
    const visitsData = @json(array_values($monthlyVisitsData->toArray()));

new Chart(document.getElementById('visitsChart'), {
    ...chartOptions,
    data: {
        labels: labels,
        datasets: [{
            label: 'Website Visitors',
            data: visitsData,
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }]
    }
});

</script>

@endsection
