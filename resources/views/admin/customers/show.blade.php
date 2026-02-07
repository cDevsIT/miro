@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Customer Details</h1>
        <div>
            <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-primary">Edit Customer</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if($customer->avatar)
                        <img src="{{ Storage::url($customer->avatar) }}" alt="{{ $customer->name }}" class="img-thumbnail rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 200px; height: 200px; font-size: 72px; font-weight: bold;">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <h3 class="mb-4">{{ $customer->name }}</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Email</th>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $customer->phone ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th>Profession</th>
                                <td>{{ $customer->profession ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $customer->address ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th>Member Since</th>
                                <td>{{ $customer->created_at->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $customer->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Customer Activity</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3>{{ $customer->wishlist()->count() }}</h3>
                            <p class="mb-0">Wishlist Items</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3>{{ $customer->created_at->diffInDays(now()) }}</h3>
                            <p class="mb-0">Days as Member</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3>{{ $customer->updated_at->diffForHumans() }}</h3>
                            <p class="mb-0">Last Activity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Customer</button>
        </form>
    </div>
</div>
@endsection




