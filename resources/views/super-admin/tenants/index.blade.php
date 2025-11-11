@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Tenant Management</h1>
    <a href="{{ route('super-admin.tenants.create') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-plus-circle me-2"></i>Create Tenant
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-dark mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Business Name</th>
                    <th>Email</th>
                    <th>Branches</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenants as $tenant)
                <tr>
                    <td>#{{ $tenant->id }}</td>
                    <td>{{ $tenant->business_name }}</td>
                    <td>{{ $tenant->email }}</td>
                    <td><span class="badge bg-info">{{ $tenant->branches_count }}</span></td>
                    <td>
                        <span class="badge {{ $tenant->isActive() ? 'bg-success' : 'bg-danger' }}">
                            {{ $tenant->isActive() ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('super-admin.tenants.show', $tenant) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('super-admin.tenants.edit', $tenant) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No tenants found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">{{ $tenants->links() }}</div>
@endsection