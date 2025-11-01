@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Customer Insights</h1>
            <p class="text-muted">Monitor customer activities, messages, appointments, and quotes</p>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.insights') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="date_from" class="form-label">From Date</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="{{ $dateFrom }}">
                </div>
                <div class="col-md-4">
                    <label for="date_to" class="form-label">To Date</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="{{ $dateTo }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Apply Filter
                    </button>
                    <a href="{{ route('admin.insights') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.customers.index') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Total Customers</h6>
                                <h3 class="mb-0">{{ $stats['total_customers'] }}</h3>
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
                                <h3 class="mb-0">{{ $stats['total_messages'] }}</h3>
                                <small class="text-danger">{{ $stats['unread_messages'] }} unread</small>
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
                                <i class="fas fa-calendar-check fa-2x text-success"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Appointments</h6>
                                <h3 class="mb-0">{{ $stats['total_appointments'] }}</h3>
                                <small class="text-success">{{ $stats['pending_appointments'] }} upcoming</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.insights.quotes') }}" class="stat-card-link">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-file-invoice fa-2x text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <h6 class="text-muted mb-1">Quotes</h6>
                                <h3 class="mb-0">{{ $stats['total_quotes'] }}</h3>
                                <small class="text-warning">{{ $stats['pending_quotes'] }} pending</small>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Activity Chart -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-chart-line"></i> Activity Overview (Last 7 Days)</h5>
        </div>
        <div class="card-body">
            <canvas id="activityChart" height="80"></canvas>
        </div>
    </div>

    <div class="row">
        <!-- Recent Messages -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-envelope text-info"></i> Recent Messages</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentMessages as $message)
                            <a href="{{ route('admin.insights.message', $message->id) }}" class="list-group-item list-group-item-action {{ $message->read_status == 0 ? 'bg-light' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            {{ $message->customer ? $message->customer->name : 'Guest' }}
                                            @if($message->read_status == 0)
                                                <span class="badge badge-danger ml-1">New</span>
                                            @endif
                                        </h6>
                                        <p class="mb-1 small"><strong>{{ $message->subject }}</strong></p>
                                        <p class="mb-1 text-muted small">{{ Str::limit($message->message, 80) }}</p>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $message->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No messages in this period</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check text-success"></i> Recent Appointments</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentAppointments as $appointment)
                            <a href="{{ route('admin.insights.appointment', $appointment->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $appointment->name }}</h6>
                                        <p class="mb-1 small text-muted">
                                            <i class="fas fa-envelope"></i> {{ $appointment->email }}
                                        </p>
                                        <p class="mb-1 small text-muted">
                                            <i class="fas fa-phone"></i> {{ $appointment->phone }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="badge badge-primary">
                                                <i class="far fa-calendar"></i> {{ $appointment->date->format('M d, Y') }}
                                            </span>
                                            <span class="badge badge-secondary ml-1">
                                                <i class="far fa-clock"></i> {{ Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                            </span>
                                        </p>
                                        @if($appointment->remarks)
                                            <p class="mb-0 small text-muted">{{ Str::limit($appointment->remarks, 60) }}</p>
                                        @endif
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center py-4">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No appointments in this period</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Quotes -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-file-invoice text-warning"></i> Recent Quotes</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentQuotes as $quote)
                            <a href="{{ route('admin.insights.quote', $quote->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            Quote #{{ $quote->code }}
                                            <span class="badge badge-{{ $quote->status == 'pending' ? 'warning' : ($quote->status == 'approved' ? 'success' : 'secondary') }} ml-1">
                                                {{ ucfirst($quote->status) }}
                                            </span>
                                        </h6>
                                        <p class="mb-1 small">
                                            <strong>Customer:</strong> {{ $quote->customer ? $quote->customer->name : 'N/A' }}
                                        </p>
                                        <p class="mb-1 small text-muted">
                                            <i class="fas fa-box"></i> {{ $quote->items->count() }} item(s)
                                        </p>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $quote->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center py-4">
                                <i class="fas fa-file-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No quotes in this period</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('activityChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [
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
                    borderColor: 'rgb(40, 167, 69)',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Quotes',
                    data: @json($chartData['quotes']),
                    borderColor: 'rgb(255, 193, 7)',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
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

<style>
.stat-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.stat-card-link:hover {
    text-decoration: none;
    color: inherit;
}

.stat-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}

a.list-group-item-action {
    color: inherit;
    text-decoration: none;
}

a.list-group-item-action:hover {
    background-color: #f8f9fa;
    color: inherit;
    text-decoration: none;
}

.badge-lg {
    font-size: 14px;
    padding: 6px 12px;
}
</style>

@endsection

