@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Dashboard</h1>
            <p class="text-muted">Welcome back! Here's what's happening with your store today.</p>
        </div>
    </div>

    <!-- Today's Activity -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm dashboard-card text-white">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-calendar-day"></i> Today's Activity</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h2 class="mb-0">{{ $todayStats['new_customers'] }}</h2>
                                <small>New Customers</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h2 class="mb-0">{{ $todayStats['new_messages'] }}</h2>
                                <small>New Messages</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h2 class="mb-0">{{ $todayStats['new_appointments'] }}</h2>
                                <small>New Appointments</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h2 class="mb-0">{{ $todayStats['new_quotes'] }}</h2>
                                <small>New Quotes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Statistics -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.products.index') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Products</h6>
                                <h3 class="mb-0">{{ $stats['total_products'] }}</h3>
                                <small class="text-muted">Active products</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.customers.index') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Customers</h6>
                                <h3 class="mb-0">{{ $stats['total_customers'] }}</h3>
                                <small class="text-muted">Total customers</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.insights.messages') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope fa-2x text-info"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Messages</h6>
                                <h3 class="mb-0">{{ $stats['unread_messages'] }}</h3>
                                <small class="text-danger">Unread messages</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.insights.appointments') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar-check fa-2x text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Appointments</h6>
                                <h3 class="mb-0">{{ $stats['upcoming_appointments'] }}</h3>
                                <small class="text-warning">Upcoming</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Activity Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Activity Trends (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="dashboardChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Activities -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-history text-secondary"></i> Recent Activities</h5>
                    <a href="{{ route('admin.activity.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentActivities as $activity)
                            <div class="list-group-item">
                                <div class="d-flex align-items-start">
                                    <i class="fas {{ $activity->icon }} {{ $activity->color_class }} mr-2 mt-1"></i>
                                    <div class="flex-grow-1">
                                        <p class="mb-1 small">{{ $activity->description }}</p>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center py-3">
                                <p class="text-muted mb-0">No recent activities</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-envelope text-info"></i> Unread Messages</h5>
                    <a href="{{ route('admin.insights.messages') }}" class="btn btn-sm btn-outline-info">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentMessages as $message)
                            <a href="{{ route('admin.insights.message', $message->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            {{ $message->customer ? $message->customer->name : 'Guest' }}
                                            <span class="badge badge-danger ml-1">New</span>
                                        </h6>
                                        <p class="mb-1 small"><strong>{{ $message->subject }}</strong></p>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center py-3">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <p class="text-muted mb-0">No unread messages</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-calendar-check text-success"></i> Upcoming Appointments</h5>
                    <a href="{{ route('admin.insights.appointments') }}" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($upcomingAppointments as $appointment)
                            <a href="{{ route('admin.insights.appointment', $appointment->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $appointment->name }}</h6>
                                        <p class="mb-1">
                                            <span class="badge badge-primary">
                                                {{ $appointment->date->format('M d') }}
                                            </span>
                                            <span class="badge badge-secondary ml-1">
                                                {{ Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                            </span>
                                        </p>
                                        <small class="text-muted">{{ $appointment->email }}</small>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center py-3">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No upcoming appointments</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-block btn-lg">
                                <i class="fas fa-plus-circle"></i><br>
                                <span>Add Product</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success btn-block btn-lg">
                                <i class="fas fa-folder-plus"></i><br>
                                <span>Add Category</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-info btn-block btn-lg">
                                <i class="fas fa-user-plus"></i><br>
                                <span>Add User</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.insights') }}" class="btn btn-outline-warning btn-block btn-lg">
                                <i class="fas fa-chart-bar"></i><br>
                                <span>View Insights</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [
                {
                    label: 'New Customers',
                    data: @json($chartData['customers']),
                    borderColor: 'rgb(40, 167, 69)',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Messages',
                    data: @json($chartData['messages']),
                    borderColor: 'rgb(23, 162, 184)',
                    backgroundColor: 'rgba(23, 162, 184, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Appointments',
                    data: @json($chartData['appointments']),
                    borderColor: 'rgb(255, 193, 7)',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Quotes',
                    data: @json($chartData['quotes']),
                    borderColor: 'rgb(220, 53, 69)',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

@endsection
