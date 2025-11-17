@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>User Management</h1>
    
    <form method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search users..." 
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name ?? 'N/A' }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                        {{ $user->is_admin ? 'Admin' : 'User' }}
                    </span>
                </td>
<<<<<<< HEAD

                {{-- ACTIONS COLUMN --}}
                <td>
                    {{-- View User (visible to everyone who can access this page) --}}
=======
                <td>
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    
<<<<<<< HEAD
                    {{-- Prevent user from modifying their own account --}}
                    @if($user->id !== auth()->id())

                        {{-- Reset Password (Admin + SuperAdmin only) --}}
=======
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('users.reset-password', $user) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning" 
                                    onclick="return confirm('Reset password for this user?')">
                                <i class="bi bi-key"></i>
                            </button>
                        </form>
                        
                        @if($user->is_active)
                            <form method="POST" action="{{ route('users.deactivate', $user) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" 
=======
                    <span class="badge 
                        @switch($user->role)
                            @case('super_admin') bg-dark @break
                            @case('admin') bg-primary @break
                            @case('manager') bg-info text-dark @break
                            @case('cashier') bg-secondary @break
                            @default bg-secondary
                        @endswitch
                    ">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </span>
                </td>
                <td>
                    {{-- View profile always allowed --}}
                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>

                    @if($user->id !== auth()->id())
                        {{-- Reset Password: Admin & Super Admin only --}}
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <form method="POST" action="{{ route('users.reset-password', $user) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning"
                                        onclick="return confirm('Reset password for this user?')">
                                    <i class="bi bi-key"></i>
                                </button>
                            </form>
                        @endif
<<<<<<< HEAD
                        
                        {{-- Deactivate User (Admin + SuperAdmin only) --}}
                        @if($user->is_active && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
                            <form method="POST" action="{{ route('users.deactivate', $user) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
=======

                        {{-- Deactivate: Manager can deactivate Cashiers only, Admin/Super Admin can deactivate anyone --}}
                        @if($user->is_active && (
                            (auth()->user()->isManager() && $user->role === 'cashier') ||
                            auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()
                        ))
                            <form method="POST" action="{{ route('users.deactivate', $user) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                        onclick="return confirm('Deactivate this user?')">
                                    <i class="bi bi-person-x"></i>
                                </button>
                            </form>
                        @endif
<<<<<<< HEAD

                    @endif
                </td>
            </tr>

=======
<<<<<<< HEAD
=======

                        {{-- Reactivate: Admin & Super Admin only --}}
                        @if(!$user->is_active && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
                            <form method="POST" action="{{ route('users.reactivate', $user) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success"
                                        onclick="return confirm('Reactivate this user?')">
                                    <i class="bi bi-person-check"></i>
                                </button>
                            </form>
                        @endif

                        {{-- Delete: Admin & Super Admin only --}}
                        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-dark"
                                        onclick="return confirm('Delete this user permanently?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
>>>>>>> 54ab4ca (Ready for Debugging)
                    @endif
                </td>
            </tr>
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
            @empty
            <tr>
                <td colspan="7" class="text-center">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<<<<<<< HEAD
@endsection
=======
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
