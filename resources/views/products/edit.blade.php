@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
<<<<<<< HEAD
    <div class="col-md-10">
=======
<<<<<<< HEAD
    <div class="col-md-8">
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
        <div class="card">
            <div class="card-header">
                <h3>Update Product</h3>
            </div>
            <div class="card-body">
<<<<<<< HEAD
                <form action="{{ route('products.update', $product->product_id) }}" method="POST" id="productForm">
=======
                <form action="{{ route('products.update', $product->product_id) }}" method="POST">
=======
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3>Edit Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" id="productForm">
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    @csrf
                    @method('PUT')
                    
                    @include('layouts.partials.messages')

                    <div class="row">
                        <div class="col-md-6 mb-3">
<<<<<<< HEAD
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
=======
<<<<<<< HEAD
                            <label class="form-label">Product Name</label>
=======
                            <label class="form-label">Barcode *</label>
                            <input type="text" name="barcode" id="barcode" class="form-control @error('barcode') is-invalid @enderror" 
                                   value="{{ old('barcode', $product->barcode) }}" required autofocus placeholder="Scan or enter barcode">
                            @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Scan barcode or type manually</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                   value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<<<<<<< HEAD
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Manufacturer</label>
                            <input type="text" name="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror"
=======
<<<<<<< HEAD
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Manufacturer</label>
=======
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Manufacturer *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
                            <input type="text" name="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror" 
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                   value="{{ old('manufacturer', $product->manufacturer) }}" required>
                            @error('manufacturer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Quantity</label>
<<<<<<< HEAD
=======
=======

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Quantity *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                                   value="{{ old('quantity', $product->quantity) }}" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
<<<<<<< HEAD
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit</label>
=======
<<<<<<< HEAD
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit</label>
=======
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Unit *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                            <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" 
                                   value="{{ old('unit', $product->unit) }}" placeholder="e.g., pcs, kg, liter" required>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<<<<<<< HEAD

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Capital Price (₱)</label>
                            <input type="number" step="0.01" name="capital_price" id="capital_price"
                                   class="form-control @error('capital_price') is-invalid @enderror"
                                   value="{{ old('capital_price', $product->capital_price) }}" required>
                            @error('capital_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

=======
<<<<<<< HEAD
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Capital Price</label>
                            <input type="number" step="0.01" name="capital_price" 
                                   class="form-control @error('capital_price') is-invalid @enderror" 
                                   value="{{ old('capital_price', $product->capital_price ?? $product->price) }}" required>
                            @error('capital_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Selling price will be 15% higher</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date Procured</label>
=======
                    </div>

>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                    <hr class="my-4">
                    <h5 class="mb-3">Pricing</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
<<<<<<< HEAD
                            <label class="form-label">Markup (%)</label>
                            <input type="number" step="0.01" name="markup_percentage" id="markup_percentage"
                                   class="form-control @error('markup_percentage') is-invalid @enderror"
=======
                            <label class="form-label">Capital Price (₱) *</label>
                            <input type="number" step="0.01" name="capital_price" id="capital_price"
                                   class="form-control @error('capital_price') is-invalid @enderror" 
                                   value="{{ old('capital_price', $product->capital_price) }}" required>
                            @error('capital_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Markup (%) *</label>
                            <input type="number" step="0.01" name="markup_percentage" id="markup_percentage"
                                   class="form-control @error('markup_percentage') is-invalid @enderror" 
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                                   value="{{ old('markup_percentage', $product->markup_percentage ?? 15) }}" required>
                            @error('markup_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Default: 15%</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">VAT (12%)</label>
<<<<<<< HEAD
                            <input type="text" id="vat_display" class="form-control" readonly>
=======
                            <input type="text" id="vat_display" class="form-control" readonly value="₱0.00">
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                            <small class="text-muted">Auto-calculated</small>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6 class="mb-2">Price Breakdown:</h6>
                        <div class="d-flex justify-content-between">
                            <span>Capital Price:</span>
                            <strong id="capital_display">₱0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>After Markup:</span>
                            <strong id="after_markup_display">₱0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>VAT (12%):</span>
                            <strong id="vat_breakdown">₱0.00</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="h5">Final Selling Price:</span>
                            <strong class="h5" style="color: var(--reddit-orange);" id="final_price_display">₱0.00</strong>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">Dates</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
<<<<<<< HEAD
                            <label class="form-label">Date Procured</label>
                            <input type="date" name="date_procured" class="form-control" 
                                   value="{{ old('date_procured', $product->date_procured->format('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Manufactured Date</label>
                            <input type="date" name="manufactured_date" class="form-control"
                                   value="{{ old('manufactured_date', $product->manufactured_date->format('Y-m-d')) }}" required>
=======
                            <label class="form-label">Date Procured *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
                            <input type="date" name="date_procured" class="form-control @error('date_procured') is-invalid @enderror" 
                                   value="{{ old('date_procured', $product->date_procured->format('Y-m-d')) }}" required>
                            @error('date_procured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
<<<<<<< HEAD
                            <label class="form-label">Manufactured Date</label>
=======
                            <label class="form-label">Manufactured Date *</label>
>>>>>>> 54ab4ca (Ready for Debugging)
                            <input type="date" name="manufactured_date" class="form-control @error('manufactured_date') is-invalid @enderror" 
                                   value="{{ old('manufactured_date', $product->manufactured_date->format('Y-m-d')) }}" required>
                            @error('manufactured_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Expiration Date (Optional)</label>
<<<<<<< HEAD
                            <input type="date" name="expiration_date" class="form-control"
                                   value="{{ old('expiration_date', optional($product->expiration_date)->format('Y-m-d')) }}">
=======
                            <input type="date" name="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" 
<<<<<<< HEAD
                                   value="{{ old('expiration_date', $product->expiration_date?->format('Y-m-d')) }}">
=======
                                   value="{{ old('expiration_date', optional($product->expiration_date)->format('Y-m-d')) }}">
>>>>>>> 54ab4ca (Ready for Debugging)
                            @error('expiration_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
<<<<<<< HEAD

=======
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
                </form>
            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const capitalInput = document.getElementById('capital_price');
    const markupInput = document.getElementById('markup_percentage');
<<<<<<< HEAD

    function calculatePrices() {
        const capital = parseFloat(capitalInput.value) || 0;
        const markup = parseFloat(markupInput.value) || 0;

        // Price after markup
        const priceAfterMarkup = capital * (1 + (markup / 100));

        // VAT (12%)
        const vat = priceAfterMarkup * 0.12;

        // Final selling price
        const finalPrice = priceAfterMarkup + vat;

        // Update display
=======
    
    function calculatePrices() {
        const capital = parseFloat(capitalInput.value) || 0;
        const markup = parseFloat(markupInput.value) || 0;
        const priceAfterMarkup = capital * (1 + (markup / 100));
        const vat = priceAfterMarkup * 0.12;
        const finalPrice = priceAfterMarkup + vat;
        
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
        document.getElementById('capital_display').textContent = '₱' + capital.toFixed(2);
        document.getElementById('after_markup_display').textContent = '₱' + priceAfterMarkup.toFixed(2);
        document.getElementById('vat_display').value = '₱' + vat.toFixed(2);
        document.getElementById('vat_breakdown').textContent = '₱' + vat.toFixed(2);
        document.getElementById('final_price_display').textContent = '₱' + finalPrice.toFixed(2);
    }
<<<<<<< HEAD

    capitalInput.addEventListener('input', calculatePrices);
    markupInput.addEventListener('input', calculatePrices);

    // Auto-run when editing existing product
    calculatePrices();
});
</script>
@endpush

@endsection
=======
    
    capitalInput.addEventListener('input', calculatePrices);
    markupInput.addEventListener('input', calculatePrices);
    
    // Initial calculation with old values
    calculatePrices();
    
    // Barcode scanner support - move to next field on Enter
    const barcodeInput = document.getElementById('barcode');
    barcodeInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('input[name="name"]').focus();
        }
    });
});
</script>
@endpush
@endsection
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
