@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Customers</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" action="" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control admin-search-input" placeholder="Search by name, email or phone" value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.customers.index') }}" class="clear-search">&times;</a>
                    @endif
                    <button class="btn btn-outline-secondary me-2" type="submit">Search</button>          
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Profession</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>
                                    @if($customer->avatar)
                                        <img src="{{ Storage::url($customer->avatar) }}" alt="{{ $customer->name }}" class="img-thumbnail rounded-circle" width="50" height="50" style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-weight: bold;">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? 'N/A' }}</td>
                                <td>{{ $customer->profession ?? 'N/A' }}</td>
                                <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No customers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Add pagination links --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

