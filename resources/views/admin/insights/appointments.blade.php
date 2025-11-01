@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-check text-success"></i> All Appointments</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
    </div>

    <!-- Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="search" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('admin.insights.appointments') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Appointments List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    <strong>{{ $appointment->name }}</strong>
                                    @if($appointment->customer)
                                        <br><small class="text-muted">Customer: {{ $appointment->customer->name }}</small>
                                    @endif
                                </td>
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ $appointment->date->format('M d, Y') }}
                                    </span>
                                    <br>
                                    <span class="badge badge-secondary mt-1">
                                        {{ Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $isPast = $appointment->date->isPast();
                                    @endphp
                                    <span class="badge badge-{{ $isPast ? 'secondary' : 'success' }}">
                                        {{ $isPast ? 'Completed' : 'Upcoming' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.insights.appointment', $appointment->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No appointments found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($appointments->hasPages())
            <div class="card-footer bg-white">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

