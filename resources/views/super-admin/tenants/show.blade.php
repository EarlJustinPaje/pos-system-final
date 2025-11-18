@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $tenant->business_name }}</h1>
    <div>
        <a href="{{ route('super-admin.tenants.edit', $tenant) }}" class="btn btn-warning">Edit</a>
        <form method="POST" action="{{ route('super-admin.tenants.toggle-status', $tenant) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-{{ $tenant->is_active ? 'secondary' : 'success' }}">
                {{ $tenant->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{ $stats['total_branches'] }}</h3>
                <p class="text-muted">Total Branches</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{ $stats['total_users'] }}</h3>
                <p class="text-muted">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{ $stats['total_products'] }}</h3>
                <p class="text-muted">Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3>₱{{ number_format($stats['total_sales'], 2) }}</h3>
                <p class="text-muted">Total Sales</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Tenant Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{ $tenant->name }}</p>
                <p><strong>Business Name:</strong> {{ $tenant->business_name }}</p>
                <p><strong>Email:</strong> {{ $tenant->email }}</p>
                <p><strong>Contact:</strong> {{ $tenant->contact_number }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Business Type:</strong> {{ $tenant->business_type }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $tenant->isActive() ? 'bg-success' : 'bg-danger' }}">
                        {{ $tenant->isActive() ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p><strong>Subscription:</strong> 
                    @if($tenant->subscription_expires_at)
                        {{ $tenant->subscription_expires_at->format('M d, Y') }}
                    @else
                        Lifetime
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Branches</h5>
    </div>
    <div class="card-body">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenant->branches as $branch)
                <tr>
                    <td>{{ $branch->name }}</td>
                    <td><code>{{ $branch->code }}</code></td>
                    <td>{{ $branch->address }}</td>
                    <td>
                        <span class="badge {{ $branch->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $branch->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No branches</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection