@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Branch Management</h1>
    <a href="{{ route('branches.create') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-plus-circle me-2"></i>Create Branch
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-dark mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Branch Name</th>
                    <th>Code</th>
                    <th>Address</th>
                    @if(auth()->user()->isSuperAdmin())
                    <th>Tenant</th>
                    @endif
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($branches as $branch)
                <tr>
                    <td>#{{ $branch->id }}</td>
                    <td>
                        {{ $branch->name }}
                        @if($branch->is_main_branch)
                        <span class="badge bg-primary">Main</span>
                        @endif
                    </td>
                    <td><code>{{ $branch->code }}</code></td>
                    <td>{{ $branch->address }}</td>
                    @if(auth()->user()->isSuperAdmin())
                    <td>{{ $branch->tenant->business_name }}</td>
                    @endif
                    <td>
                        <span class="badge {{ $branch->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $branch->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('branches.show', $branch) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('branches.edit', $branch) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isSuperAdmin() ? 7 : 6 }}" class="text-center">No branches found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">{{ $branches->links() }}</div>
@endsection