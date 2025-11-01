@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-check text-success"></i> Appointment Details</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Appointment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="fas fa-user"></i> Name:</strong>
                            <p class="mb-0">{{ $appointment->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-user-circle"></i> Customer Account:</strong>
                            <p class="mb-0">{{ $appointment->customer ? $appointment->customer->name : 'Guest (No Account)' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="fas fa-envelope"></i> Email:</strong>
                            <p class="mb-0">
                                <a href="mailto:{{ $appointment->email }}">{{ $appointment->email }}</a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-phone"></i> Phone:</strong>
                            <p class="mb-0">
                                <a href="tel:{{ $appointment->phone }}">{{ $appointment->phone }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><i class="far fa-calendar"></i> Appointment Date:</strong>
                            <p class="mb-0">
                                <span class="badge badge-primary badge-lg">
                                    {{ $appointment->date->format('F d, Y') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="far fa-clock"></i> Time:</strong>
                            <p class="mb-0">
                                <span class="badge badge-secondary badge-lg">
                                    {{ Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @if($appointment->remarks)
                        <div class="mb-0">
                            <strong><i class="fas fa-comment"></i> Remarks/Notes:</strong>
                            <div class="border p-3 bg-light rounded mt-2" style="white-space: pre-wrap;">{{ $appointment->remarks }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Metadata -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Metadata</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Booking ID:</dt>
                        <dd class="col-sm-7"><code>#{{ $appointment->id }}</code></dd>

                        <dt class="col-sm-5">Booked On:</dt>
                        <dd class="col-sm-7">
                            {{ $appointment->created_at->format('M d, Y') }}
                            <small class="d-block text-muted">{{ $appointment->created_at->diffForHumans() }}</small>
                        </dd>

                        <dt class="col-sm-5">Last Updated:</dt>
                        <dd class="col-sm-7">
                            {{ $appointment->updated_at->format('M d, Y') }}
                            <small class="d-block text-muted">{{ $appointment->updated_at->diffForHumans() }}</small>
                        </dd>

                        <dt class="col-sm-5">Status:</dt>
                        <dd class="col-sm-7">
                            @php
                                $isPast = $appointment->date->isPast();
                            @endphp
                            <span class="badge badge-{{ $isPast ? 'secondary' : 'success' }}">
                                {{ $isPast ? 'Completed' : 'Upcoming' }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
dl.row {
    margin-bottom: 0.5rem;
}

dt {
    font-weight: 600;
    color: #6c757d;
}

dd {
    color: #495057;
}

.badge-lg {
    font-size: 14px;
    padding: 6px 12px;
}
</style>
@endsection

