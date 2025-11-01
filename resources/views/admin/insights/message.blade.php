@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-envelope text-info"></i> Message Details</h1>
        <a href="{{ route('admin.insights') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Insights
        </a>
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
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">{{ $message->subject }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Message:</strong>
                        <div class="border p-3 bg-light rounded mt-2" style="white-space: pre-wrap;">{{ $message->message }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Sender Information -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Sender</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8">{{ $message->customer ? $message->customer->name : 'Guest' }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">
                            <a href="mailto:{{ $message->customer ? $message->customer->email : '' }}">
                                {{ $message->customer ? $message->customer->email : 'N/A' }}
                            </a>
                        </dd>

                        @if($message->customer && $message->customer->phone)
                            <dt class="col-sm-4">Phone:</dt>
                            <dd class="col-sm-8">
                                <a href="tel:{{ $message->customer->phone }}">{{ $message->customer->phone }}</a>
                            </dd>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Message Information -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Status:</dt>
                        <dd class="col-sm-7">
                            <span class="badge badge-{{ $message->read_status == 0 ? 'danger' : 'success' }}">
                                {{ $message->read_status == 0 ? 'Unread' : 'Read' }}
                            </span>
                        </dd>

                        <dt class="col-sm-5">Received:</dt>
                        <dd class="col-sm-7">
                            {{ $message->created_at->format('M d, Y') }}
                            <small class="d-block text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </dd>

                        <dt class="col-sm-5">Time:</dt>
                        <dd class="col-sm-7">{{ $message->created_at->format('h:i A') }}</dd>
                    </dl>

                    @if($message->read_status == 0)
                        <hr>
                        <form action="{{ route('admin.insights.message.read', $message->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-check"></i> Mark as Read
                            </button>
                        </form>
                    @endif
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
</style>
@endsection

