@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-check text-success"></i> Appointment Details</h1>
        <div>
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#rescheduleModal">
                <i class="fas fa-calendar-alt"></i> Reschedule
            </button>
            <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Insights
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

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
            <div class="card border-0 shadow-sm mb-3">
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
                                $statusColor = match($appointment->status ?? 'pending') {
                                    'confirmed' => 'success',
                                    'completed' => 'secondary',
                                    'cancelled' => 'danger',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge badge-{{ $statusColor }}">
                                {{ ucfirst($appointment->status ?? 'pending') }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Reply Notes Section -->
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Admin Notes / Reply</h5>
                </div>
                <div class="card-body">
                    @if($appointment->admin_notes)
                        <div class="alert alert-info mb-3">
                            <strong><i class="fas fa-info-circle"></i> Current Notes:</strong>
                            <p class="mb-0 mt-2" style="white-space: pre-wrap;">{{ $appointment->admin_notes }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.insights.appointment.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="admin_notes">Add/Update Notes</label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                      id="admin_notes" 
                                      name="admin_notes" 
                                      rows="6" 
                                      placeholder="Add notes, instructions, or reply to the customer...">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">These notes are for internal use and customer communication.</small>
                        </div>

                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-paper-plane"></i> Save Notes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Modal -->
<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="rescheduleModalLabel">
                    <i class="fas fa-calendar-alt"></i> Reschedule Appointment
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.insights.appointment.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> <strong>Current Appointment:</strong>
                        {{ $appointment->date->format('F d, Y') }} at {{ Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_date">
                                    <i class="far fa-calendar"></i> New Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       id="modal_date" 
                                       name="date" 
                                       value="{{ old('date', $appointment->date->format('Y-m-d')) }}"
                                       required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_time">
                                    <i class="far fa-clock"></i> New Time <span class="text-danger">*</span>
                                </label>
                                <input type="time" 
                                       class="form-control @error('time') is-invalid @enderror" 
                                       id="modal_time" 
                                       name="time" 
                                       value="{{ old('time', Carbon\Carbon::parse($appointment->time)->format('H:i')) }}"
                                       required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="modal_status">
                            <i class="fas fa-info-circle"></i> Status
                        </label>
                        <select class="form-control @error('status') is-invalid @enderror" id="modal_status" name="status">
                            <option value="pending" {{ ($appointment->status ?? 'pending') == 'pending' ? 'selected' : '' }}>
                                🟡 Pending - Awaiting confirmation
                            </option>
                            <option value="confirmed" {{ ($appointment->status ?? '') == 'confirmed' ? 'selected' : '' }}>
                                🟢 Confirmed - Customer notified
                            </option>
                            <option value="completed" {{ ($appointment->status ?? '') == 'completed' ? 'selected' : '' }}>
                                ✅ Completed - Appointment finished
                            </option>
                            <option value="cancelled" {{ ($appointment->status ?? '') == 'cancelled' ? 'selected' : '' }}>
                                🔴 Cancelled - Appointment cancelled
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="modal_admin_notes">
                            <i class="fas fa-sticky-note"></i> Add Notes (Optional)
                        </label>
                        <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                  id="modal_admin_notes" 
                                  name="admin_notes" 
                                  rows="4" 
                                  placeholder="Add any notes about this reschedule (optional)...">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                        @error('admin_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            These notes will be saved with the appointment for future reference.
                        </small>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Appointment
                    </button>
                </div>
            </form>
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

