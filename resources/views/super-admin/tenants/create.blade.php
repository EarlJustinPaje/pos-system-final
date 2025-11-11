@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3>Create New Tenant</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('super-admin.tenants.store') }}" method="POST">
                    @csrf
                    
                    @include('layouts.partials.messages')

                    <h5 class="mb-3">Business Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tenant Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3
<label class="form-label">Business Name *</label>
                            <input type="text" name="business_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Business Type</label>
                            <input type="text" name="business_type" class="form-control" placeholder="e.g., Retail, Restaurant">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subscription (Months)</label>
                            <input type="number" name="subscription_months" class="form-control" placeholder="Leave empty for lifetime">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Admin Account</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Name *</label>
                            <input type="text" name="admin_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Username *</label>
                            <input type="text" name="admin_username" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Email *</label>
                            <input type="email" name="admin_email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Password *</label>
                            <input type="password" name="admin_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Tenant</button>
                        <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection