<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
    'tenant_id',
    'branch_id',
    'name',
    'quantity',
    'unit',
    'manufacturer',
    'price',
    'capital_price',
    'date_procured',
    'expiration_date',
    'manufactured_date',
    'is_active',
    'sold_quantity',
];

protected static function booted()
{
    static::creating(function ($product) {
        if (auth()->check() && !$product->tenant_id) {
            $product->tenant_id = auth()->user()->tenant_id;
            $product->branch_id = auth()->user()->branch_id;
        }
    });
}

        'tenant_id',
        'branch_id',
        'barcode',
        'name',
        'quantity',
        'unit',
        'manufacturer',
        'price',
        'capital_price',
        'markup_percentage',
        'vat_amount',
        'price_before_vat',
        'date_procured',
        'expiration_date',
        'manufactured_date',
        'is_active',
        'sold_quantity',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (auth()->check() && !$product->tenant_id) {
                $product->tenant_id = auth()->user()->tenant_id;
                $product->branch_id = auth()->user()->branch_id;
            }
            
            // Auto-calculate prices
            $product->calculatePrices();
        });

        static::updating(function ($product) {
            $product->calculatePrices();
        });
    }

    protected function casts(): array
    {
        return [
            'date_procured' => 'date',
            'expiration_date' => 'date',
            'manufactured_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'product_id', 'product_id');
    public function calculatePrices()
    {
        if ($this->capital_price && $this->markup_percentage) {
            // Calculate price before VAT
            $this->price_before_vat = $this->capital_price * (1 + ($this->markup_percentage / 100));
            
            // Calculate VAT (12%)
            $this->vat_amount = $this->price_before_vat * 0.12;
            
            // Final selling price (includes VAT)
            $this->price = $this->price_before_vat + $this->vat_amount;
        }
    }

    public function getSellingPriceAttribute()
    {
        return $this->capital_price * 1.15; // 15% markup
        return $this->price;
    }

    public function getQrCodeAttribute()
    {
        return \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
            ->generate($this->barcode);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'product_id', 'product_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', Carbon::now());
    }

    public function scopeNearExpiring($query)
    {
        return $query->where('expiration_date', '<=', Carbon::now()->addMonth())
                    ->where('expiration_date', '>', Carbon::now());
    }

    public function scopeFastMoving($query)
    {
        return $query->orderBy('sold_quantity', 'desc');
    }

    public function scopeByBarcode($query, $barcode)
    {
        return $query->where('barcode', $barcode);
    }
}
