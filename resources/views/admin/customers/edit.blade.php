@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Customer</h1>
        <div>
            <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-secondary">View Details</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            @if($customer->avatar)
                                <img src="{{ Storage::url($customer->avatar) }}" alt="{{ $customer->name }}" class="img-thumbnail rounded-circle mb-3" id="avatar-preview" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" id="avatar-placeholder" style="width: 200px; height: 200px; font-size: 72px; font-weight: bold;">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                                <img src="" alt="Avatar Preview" class="img-thumbnail rounded-circle mb-3 d-none" id="avatar-preview" style="width: 200px; height: 200px; object-fit: cover;">
                            @endif
                            <div class="form-group">
                                <label for="avatar" class="form-label">Change Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                                <small class="form-text text-muted">Max size: 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="profession" class="form-label">Profession</label>
                                    <input type="text" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession" value="{{ old('profession', $customer->profession) }}">
                                    @error('profession')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $customer->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Change Password</h5>
                        <p class="text-muted small">Leave blank if you don't want to change the password</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    <small class="form-text text-muted">Minimum 8 characters</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Customer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            
            if (placeholder) {
                placeholder.classList.add('d-none');
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection

