@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Activity Log</h1>
            <p class="text-muted">Monitor all system activities and user actions</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-day fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <h6 class="text-muted mb-1">Today</h6>
                            <h4 class="mb-0">{{ $stats['today'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-week fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <h6 class="text-muted mb-1">This Week</h6>
                            <h4 class="mb-0">{{ $stats['this_week'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-alt fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <h6 class="text-muted mb-1">This Month</h6>
                            <h4 class="mb-0">{{ $stats['this_month'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-database fa-2x text-secondary"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <h6 class="text-muted mb-1">Total</h6>
                            <h4 class="mb-0">{{ $stats['total'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.activity.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label><br/>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Search activities...">
                </div>
                <div class="col-md-2">
                    <label for="action" class="form-label">Action</label><br/>
                    <select class="form-select" id="action" name="action">
                        <option value="all" {{ request('action') == 'all' ? 'selected' : '' }}>All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ ucfirst($action) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="model_type" class="form-label">Model Type</label><br/>
                    <select class="form-select" id="model_type" name="model_type">
                        <option value="all" {{ request('model_type') == 'all' ? 'selected' : '' }}>All Types</option>
                        @foreach($modelTypes as $modelType)
                            <option value="{{ $modelType }}" {{ request('model_type') == $modelType ? 'selected' : '' }}>
                                {{ class_basename($modelType) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">From Date</label><br/>
                    <input type="date" class="form-control" id="date_from" name="date_from" 
                           value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">To Date</label><br/>
                    <input type="date" class="form-control" id="date_to" name="date_to" 
                           value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
            
            @if(request()->hasAny(['search', 'action', 'model_type', 'date_from', 'date_to']))
                <div class="mt-3">
                    <a href="{{ route('admin.activity.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Activity Timeline -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Activity Timeline</h5>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#clearModal">
                        <i class="fas fa-trash"></i> Clear Old
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($activities as $activity)
                <div class="activity-item border-bottom p-3 {{ $loop->first ? 'bg-light' : '' }}">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="activity-icon {{ $activity->color_class }}">
                                <i class="fas {{ $activity->icon }} fa-lg"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">
                                        @if($activity->user)
                                            <strong>{{ $activity->user->name }}</strong>
                                        @else
                                            <strong>System</strong>
                                        @endif
                                        <span class="badge badge-secondary ml-2">{{ ucfirst($activity->action) }}</span>
                                    </h6>
                                    <p class="mb-1 text-dark">{{ $activity->description }}</p>
                                    @if($activity->model_type)
                                        <small class="text-muted">
                                            <i class="fas fa-cube"></i> {{ class_basename($activity->model_type) }}
                                            @if($activity->model_id)
                                                #{{ $activity->model_id }}
                                            @endif
                                        </small>
                                    @endif
                                    @if($activity->properties)
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-secondary activity-details-btn" type="button" 
                                                    onclick="toggleDetails({{ $activity->id }}); return false;"
                                                    id="btn-{{ $activity->id }}">
                                                <i class="fas fa-info-circle"></i> View Details
                                            </button>
                                            <div class="mt-2 activity-details-content" id="properties-{{ $activity->id }}" style="display: none;">
                                                <div class="card card-body bg-light">
                                                    <div class="mb-2">
                                                        <strong><i class="fas fa-user text-primary"></i> Performed By:</strong> 
                                                        <span class="badge badge-info">
                                                            {{ $activity->user ? $activity->user->name : 'System' }}
                                                            @if($activity->user && $activity->user->email)
                                                                ({{ $activity->user->email }})
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if($activity->ip_address)
                                                        <div class="mb-2">
                                                            <strong><i class="fas fa-network-wired text-secondary"></i> IP Address:</strong> 
                                                            <code>{{ $activity->ip_address }}</code>
                                                        </div>
                                                    @endif
                                                    <div class="mb-2">
                                                        <strong><i class="fas fa-clock text-warning"></i> Time:</strong> 
                                                        {{ $activity->created_at->format('F d, Y h:i:s A') }}
                                                    </div>
                                                    <hr>
                                                    <strong><i class="fas fa-exchange-alt text-success"></i> Changes:</strong>
                                                    <pre class="mb-0" style="white-space: pre-wrap;"><code>{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <small class="text-muted d-block">
                                        <i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                                    </small>
                                    <small class="text-muted d-block">
                                        {{ $activity->created_at->format('M d, Y H:i:s') }}
                                    </small>
                                    @if($activity->ip_address)
                                        <small class="text-muted d-block">
                                            <i class="fas fa-network-wired"></i> {{ $activity->ip_address }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No activities found</p>
                </div>
            @endforelse
        </div>
        
        @if($activities->hasPages())
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Showing {{ $activities->firstItem() }} to {{ $activities->lastItem() }} of {{ $activities->total() }} activities
                    </div>
                    <div>
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Clear Old Activities Modal -->
<div class="modal fade" id="clearModal" tabindex="-1" aria-labelledby="clearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clearModalLabel">Clear Old Activities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.activity.clear') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="days">Delete activities older than:</label>
                        <select class="form-control" id="days" name="days">
                            <option value="7">7 days</option>
                            <option value="30" selected>30 days</option>
                            <option value="60">60 days</option>
                            <option value="90">90 days</option>
                            <option value="180">180 days</option>
                            <option value="365">1 year</option>
                        </select>
                    </div>
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> This action cannot be undone!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Clear Activities</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.05);
}

.activity-item:hover {
    background-color: #f8f9fa !important;
}

pre code {
    font-size: 12px;
    max-height: 300px;
    overflow-y: auto;
}

.activity-details-content {
    transition: all 0.3s ease;
}

.activity-details-content pre {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #dee2e6;
}
</style>

<script>
function toggleDetails(activityId) {
    const detailsDiv = document.getElementById('properties-' + activityId);
    const btn = document.getElementById('btn-' + activityId);
    
    if (detailsDiv.style.display === 'none') {
        detailsDiv.style.display = 'block';
        btn.innerHTML = '<i class="fas fa-info-circle"></i> Hide Details';
    } else {
        detailsDiv.style.display = 'none';
        btn.innerHTML = '<i class="fas fa-info-circle"></i> View Details';
    }
    
    // Prevent event bubbling
    return false;
}
</script>

@endsection

