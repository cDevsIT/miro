@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Details</h1>
        <div>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>

    <div class="row">
        <!-- User Information -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> User Information</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-weight: bold; font-size: 40px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
                        @if($user->id === auth()->id())
                            <span class="badge badge-success">Current User</span>
                        @endif
                    </div>

                    <dl class="row mb-0">
                        <dt class="col-sm-4">User ID:</dt>
                        <dd class="col-sm-8"><code>#{{ $user->id }}</code></dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Account Activity -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> Account Activity</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Account Created:</dt>
                        <dd class="col-sm-7">
                            {{ $user->created_at->format('F d, Y') }}
                            <small class="d-block text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </dd>

                        <dt class="col-sm-5">Last Updated:</dt>
                        <dd class="col-sm-7">
                            {{ $user->updated_at->format('F d, Y') }}
                            <small class="d-block text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                        </dd>
                    </dl>
                </div>
            </div>

            @if($user->id !== auth()->id())
                <div class="card border-danger mt-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Danger Zone</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">Delete this user permanently from the system.</p>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                <i class="fas fa-trash"></i> Delete User
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
dl.row {
    margin-bottom: 1rem;
}

dt {
    font-weight: 600;
    color: #6c757d;
}

dd {
    color: #495057;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}
</style>
@endsection

