@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-file-invoice text-warning"></i> Quote Details</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Quote Items -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Quote #{{ $quote->code }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="fas fa-info-circle"></i> Status:</strong>
                        <span class="badge badge-{{ $quote->status == 'pending' ? 'warning' : ($quote->status == 'approved' ? 'success' : 'secondary') }} badge-lg ml-2">
                            {{ ucfirst($quote->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong><i class="fas fa-box"></i> Quote Items ({{ $quote->items->count() }}):</strong>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Model Number</th>
                                        <th class="text-center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($quote->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($item->product)
                                                    {{ $item->product->title }}
                                                    @if($item->product->title_suffix)
                                                        <small class="text-muted">{{ $item->product->title_suffix }}</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Product not found</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->product)
                                                    <code>{{ $item->product->model_number }}</code>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->quantity ?? 1 }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-3">No items in this quote</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Customer</h5>
                </div>
                <div class="card-body">
                    @if($quote->customer)
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Name:</dt>
                            <dd class="col-sm-7">{{ $quote->customer->name }}</dd>

                            <dt class="col-sm-5">Email:</dt>
                            <dd class="col-sm-7">
                                <a href="mailto:{{ $quote->customer->email }}">{{ $quote->customer->email }}</a>
                            </dd>

                            @if($quote->customer->phone)
                                <dt class="col-sm-5">Phone:</dt>
                                <dd class="col-sm-7">
                                    <a href="tel:{{ $quote->customer->phone }}">{{ $quote->customer->phone }}</a>
                                </dd>
                            @endif
                        </dl>
                    @else
                        <p class="text-muted mb-0">No customer associated</p>
                    @endif
                </div>
            </div>

            <!-- Quote Metadata -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Quote Info</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Quote ID:</dt>
                        <dd class="col-sm-7"><code>#{{ $quote->id }}</code></dd>

                        <dt class="col-sm-5">Quote Code:</dt>
                        <dd class="col-sm-7"><code>{{ $quote->code }}</code></dd>

                        <dt class="col-sm-5">Total Items:</dt>
                        <dd class="col-sm-7">{{ $quote->items->count() }}</dd>

                        <dt class="col-sm-5">Created:</dt>
                        <dd class="col-sm-7">
                            {{ $quote->created_at->format('M d, Y') }}
                            <small class="d-block text-muted">{{ $quote->created_at->diffForHumans() }}</small>
                        </dd>

                        <dt class="col-sm-5">Last Updated:</dt>
                        <dd class="col-sm-7">
                            {{ $quote->updated_at->format('M d, Y') }}
                            <small class="d-block text-muted">{{ $quote->updated_at->diffForHumans() }}</small>
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

.card {
    transition: transform 0.2s;
}
</style>
@endsection

