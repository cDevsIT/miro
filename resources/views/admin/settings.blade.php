@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Settings</h1>
            <p class="text-muted">Manage your account settings and preferences</p>
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

    <div class="row">
        <!-- Profile Information -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-user text-primary"></i> Profile Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-lock text-warning"></i> Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="current_password">Current Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Minimum 8 characters</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Information -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle text-info"></i> Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">User ID:</dt>
                                <dd class="col-sm-8"><code>#{{ $user->id }}</code></dd>
                                
                                <dt class="col-sm-4">Account Created:</dt>
                                <dd class="col-sm-8">{{ $user->created_at->format('F d, Y') }}</dd>
                                
                                <dt class="col-sm-4">Last Updated:</dt>
                                <dd class="col-sm-8">{{ $user->updated_at->diffForHumans() }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Email Verified:</dt>
                                <dd class="col-sm-8">
                                    @if($user->email_verified_at)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Verified
                                        </span>
                                        <small class="text-muted d-block">{{ $user->email_verified_at->format('M d, Y') }}</small>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-exclamation-triangle"></i> Not Verified
                                        </span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.form-control:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
}

dl.row {
    margin-bottom: 0;
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

