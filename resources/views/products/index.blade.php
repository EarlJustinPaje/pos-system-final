@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Fast Moving Products</h1>
<<<<<<< HEAD
=======
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-plus-circle me-2"></i>Add Product
    </a>
</div>
<<<<<<< HEAD

=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Fast Moving Products</h1>
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
    <div class="btn-group">
        <a href="{{ route('products.import') }}" class="btn btn-success btn-lg">
            <i class="bi bi-file-earmark-excel me-2"></i>Import Excel
        </a>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Add Product
        </a>
    </div>
</div>
<<<<<<< HEAD

=======
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="py-3">Product Name</th>
                        <th class="py-3">Stock</th>
                        <th class="py-3">Unit</th>
                        <th class="py-3">Manufacturer</th>
                        <th class="py-3">Capital Price</th>
                        <th class="py-3">Selling Price</th>
                        <th class="py-3">Sold Qty</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="px-4 py-3 fw-bold">#{{ $product->product_id }}</td>
                        <td class="py-3">
                            <div class="fw-bold">{{ $product->name }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge {{ $product->quantity <= 10 ? 'bg-danger' : 'bg-success' }} fw-bold">
                                {{ $product->quantity }}
                            </span>
                        </td>
                        <td class="py-3 text-muted">{{ $product->unit }}</td>
                        <td class="py-3 text-muted">{{ $product->manufacturer }}</td>
                        <td class="py-3 fw-bold">₱{{ number_format($product->capital_price ?? 0, 2) }}</td>
                        <td class="py-3 fw-bold" style="color: var(--reddit-orange);">₱{{ number_format($product->selling_price ?? 0, 2) }}</td>
                        <td class="py-3">
                            <span class="badge bg-primary fw-bold">{{ $product->sold_quantity }}</span>
                        </td>
                        <td class="py-3">
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }} fw-bold">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 text-center">
                            <div class="btn-group">
<<<<<<< HEAD
=======
<<<<<<< HEAD
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
=======
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                <!-- QR Code Button -->
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#qrModal{{ $product->product_id }}">
                                    <i class="bi bi-qr-code"></i>
                                </button>

                                <!-- Edit Button -->
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

<<<<<<< HEAD
=======
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                @if($product->is_active)
                                    <form method="POST" action="{{ route('products.deactivate', $product) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary" 
                                                onclick="return confirm('Deactivate this product?')">
                                            <i class="bi bi-pause-circle"></i>
                                        </button>
                                    </form>
                                @endif
<<<<<<< HEAD

                                <!-- Delete Button -->
=======
<<<<<<< HEAD
                                
=======

                                <!-- Delete Button -->
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Delete this product?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a

                    <!-- QR Code Modal -->
                    <div class="modal fade" id="qrModal{{ $product->product_id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $product->name }} - QR Code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="mb-3">
                                        {!! $product->qr_code !!}
                                    </div>
                                    <p class="mb-2"><strong>Barcode:</strong> {{ $product->barcode }}</p>
                                    <p class="mb-0"><strong>Price:</strong> ₱{{ number_format($product->selling_price, 2) }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="printQR('qrModal{{ $product->product_id }}')">
                                        <i class="bi bi-printer"></i> Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
=======
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                <h5>No products found</h5>
                                <p>Add your first product to get started</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
@endsection
=======
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a

@push('scripts')
<script>
function printQR(modalId) {
    const modal = document.getElementById(modalId);
    const qrContent = modal.querySelector('.modal-body').innerHTML;
    const newWindow = window.open('', '', 'width=400,height=500');
    newWindow.document.write('<html><head><title>Print QR Code</title></head><body>');
    newWindow.document.write(qrContent);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print();
}
</script>
@endpush
@endsection
<<<<<<< HEAD
=======
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
