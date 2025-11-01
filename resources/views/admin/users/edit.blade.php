@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit User</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
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
                    </div>

                    <div class="col-md-6">
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
                    </div>
                </div>

                <hr>

                <h5 class="mb-3"><i class="fas fa-key text-warning"></i> Change Password (Optional)</h5>
                <p class="text-muted">Leave blank if you don't want to change the password</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Minimum 8 characters</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($user->id !== auth()->id())
        <div class="card border-danger mt-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Danger Zone</h5>
            </div>
            <div class="card-body">
                <p>Once you delete this user, there is no going back. Please be certain.</p>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
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
@endsection

