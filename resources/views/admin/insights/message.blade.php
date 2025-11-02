@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-envelope text-info"></i> Message Details</h1>
        <div>
            <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#replyModal">
                <i class="fas fa-reply"></i> Reply
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
            <!-- Original Message -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">{{ $message->subject }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <strong>Message:</strong>
                        <div class="border p-3 bg-light rounded mt-2" style="white-space: pre-wrap;">{{ $message->message }}</div>
                    </div>
                </div>
            </div>

            <!-- Admin Reply -->
            @if($message->admin_reply)
                <div class="card border-0 shadow-sm border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-reply"></i> Your Reply
                            @if($message->replied_at)
                                <small class="ml-2">{{ $message->replied_at->format('M d, Y h:i A') }}</small>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 bg-light rounded" style="white-space: pre-wrap;">{{ $message->admin_reply }}</div>
                    </div>
                </div>
            @endif
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

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="replyModalLabel">
                    <i class="fas fa-reply"></i> Reply to Message
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.insights.message.reply', $message->id) }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <!-- Original Message Reference -->
                    <div class="alert alert-light border">
                        <strong><i class="fas fa-user"></i> From:</strong> {{ $message->customer ? $message->customer->name : 'Guest' }}<br>
                        <strong><i class="fas fa-envelope"></i> Subject:</strong> {{ $message->subject }}<br>
                        <strong><i class="fas fa-comment"></i> Message:</strong>
                        <p class="mb-0 mt-2 text-muted" style="white-space: pre-wrap;">{{ Str::limit($message->message, 200) }}</p>
                    </div>

                    @if($message->admin_reply)
                        <div class="alert alert-success">
                            <strong><i class="fas fa-info-circle"></i> Current Reply:</strong>
                            <p class="mb-0 mt-2" style="white-space: pre-wrap;">{{ $message->admin_reply }}</p>
                            @if($message->replied_at)
                                <small class="text-muted d-block mt-2">Sent: {{ $message->replied_at->format('F d, Y h:i A') }}</small>
                            @endif
                        </div>
                    @endif

                    <div class="form-group mb-0">
                        <label for="admin_reply">
                            <i class="fas fa-paper-plane"></i> Your Reply <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('admin_reply') is-invalid @enderror" 
                                  id="admin_reply" 
                                  name="admin_reply" 
                                  rows="8" 
                                  placeholder="Type your reply to {{ $message->customer ? $message->customer->name : 'the customer' }}..."
                                  required>{{ old('admin_reply', $message->admin_reply) }}</textarea>
                        @error('admin_reply')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            This reply will be sent to the customer via email (if configured).
                        </small>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-paper-plane"></i> Send Reply
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
</style>
@endsection

