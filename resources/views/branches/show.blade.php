@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $branch->name }}</h1>
    <div>
        <a href="{{ route('branches.edit', $branch) }}" class="btn btn-warning">Edit</a>
        @if(!$branch->is_main_branch)
        <form method="POST" action="{{ route('branches.toggle-status', $branch) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-{{ $branch->is_active ? 'secondary' : 'success' }}">
                {{ $branch->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
        @endif
    </div>
</div>

<div class="row mb-4">
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
                <h3>{{ $stats['managers'] }}</h3>
                <p class="text-muted">Managers</p>
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

<div class="card">
    <div class="card-header">
        <h5>Branch Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Branch Code:</strong> <code>{{ $branch->code }}</code></p>
                <p><strong>Address:</strong> {{ $branch->address }}</p>
                <p><strong>Contact:</strong> {{ $branch->contact_number }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Email:</strong> {{ $branch->email }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $branch->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $branch->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p><strong>Type:</strong> 
                    @if($branch->is_main_branch)
                    <span class="badge bg-primary">Main Branch</span>
                    @else
                    <span class="badge bg-secondary">Sub Branch</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection