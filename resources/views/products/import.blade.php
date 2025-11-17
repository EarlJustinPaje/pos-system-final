@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Import Products from Excel</h3>
            </div>
            <div class="card-body">
                @include('layouts.partials.messages')

                <div class="alert alert-info">
                    <h5><i class="bi bi-info-circle me-2"></i>Import Instructions:</h5>
                    <ol class="mb-0">
                        <li>Download the template file below</li>
                        <li>Fill in your product data (keep the header row)</li>
                        <li>Save and upload the file</li>
                        <li>All products will be imported automatically</li>
                    </ol>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-download fs-1 mb-3"></i>
                                <h5>Step 1: Download Template</h5>
                                <p class="mb-3">Download our Excel template with sample data</p>
                                <a href="{{ route('products.template') }}" class="btn btn-light">
                                    <i class="bi bi-file-earmark-excel me-2"></i>Download Template
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-upload fs-1 mb-3"></i>
                                <h5>Step 2: Upload File</h5>
                                <p class="mb-3">Upload your completed Excel file</p>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class="bi bi-cloud-upload me-2"></i>Upload File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Required Fields</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Required</th>
                                    <th>Format/Example</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Barcode</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>1234567890123 (must be unique)</td>
                                </tr>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>Sample Product Name</td>
                                </tr>
                                <tr>
                                    <td><strong>Manufacturer</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>Brand Name</td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>100 (numbers only)</td>
                                </tr>
                                <tr>
                                    <td><strong>Unit</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>pcs, kg, liter, box</td>
                                </tr>
                                <tr>
                                    <td><strong>Capital Price</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>50.00 (with decimals)</td>
                                </tr>
                                <tr>
                                    <td><strong>Markup %</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>15 (default 15%)</td>
                                </tr>
                                <tr>
                                    <td><strong>Date Procured</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>2024-01-15 (YYYY-MM-DD)</td>
                                </tr>
                                <tr>
                                    <td><strong>Manufactured Date</strong></td>
                                    <td><span class="badge bg-danger">Required</span></td>
                                    <td>2023-12-01 (YYYY-MM-DD)</td>
                                </tr>
                                <tr>
                                    <td><strong>Expiration Date</strong></td>
                                    <td><span class="badge bg-secondary">Optional</span></td>
                                    <td>2025-12-31 (YYYY-MM-DD) or leave empty</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('products.import.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Excel File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Excel File</label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <small class="text-muted">Accepted formats: .xlsx, .xls, .csv (Max: 2MB)</small>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Note:</strong> Duplicate barcodes will be skipped. Make sure all barcodes are unique!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-2"></i>Import Products
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection 
=======
@endsection
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
