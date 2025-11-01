@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-file-invoice text-warning"></i> All Quotes</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" placeholder="Search by quote code..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('admin.insights.quotes') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Quotes List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Quote Code</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr>
                                <td><code>#{{ $quote->code }}</code></td>
                                <td>
                                    @if($quote->customer)
                                        <strong>{{ $quote->customer->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $quote->customer->email }}</small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $quote->items->count() }} item(s)
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $quote->status == 'pending' ? 'warning' : ($quote->status == 'approved' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($quote->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $quote->created_at->format('M d, Y') }}
                                    <br>
                                    <small class="text-muted">{{ $quote->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.insights.quote', $quote->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No quotes found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($quotes->hasPages())
            <div class="card-footer bg-white">
                {{ $quotes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

