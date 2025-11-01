@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Admin Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mx-2">Clear</a>
                    @endif
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" 
                                             style="width: 40px; height: 40px; font-weight: bold; font-size: 16px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->id === auth()->id())
                                            <span class="badge badge-success ml-2">You</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

