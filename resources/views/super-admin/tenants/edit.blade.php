@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Edit Tenant</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('super-admin.tenants.update', $tenant) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @include('layouts.partials.messages')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tenant Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $tenant->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Business Name</label>
                            <input type="text" name="business_name" class="form-control" value="{{ $tenant->business_name }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $tenant->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ $tenant->contact_number }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Business Type</label>
                            <input type="text" name="business_type" class="form-control" value="{{ $tenant->business_type }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Extend Subscription (Months)</label>
                            <input type="number" name="subscription_months" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ $tenant->address }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Tenant</button>
                        <a href="{{ route('super-admin.tenants.show', $tenant) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection