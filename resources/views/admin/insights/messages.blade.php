@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-envelope text-info"></i> All Messages</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" placeholder="Search messages..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="status">
                        <option value="">All Status</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Unread</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Read</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('admin.insights.messages') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Messages List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Status</th>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr class="{{ $message->read_status == 0 ? 'table-active' : '' }}">
                                <td>
                                    <span class="badge badge-{{ $message->read_status == 0 ? 'danger' : 'success' }}">
                                        {{ $message->read_status == 0 ? 'Unread' : 'Read' }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $message->customer ? $message->customer->name : 'Guest' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $message->customer ? $message->customer->email : 'N/A' }}</small>
                                </td>
                                <td><strong>{{ $message->subject }}</strong></td>
                                <td>{{ Str::limit($message->message, 60) }}</td>
                                <td>
                                    {{ $message->created_at->format('M d, Y') }}
                                    <br>
                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.insights.message', $message->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No messages found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($messages->hasPages())
            <div class="card-footer bg-white">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

