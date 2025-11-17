<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;


protected $fillable = [
    'tenant_id',
    'branch_id',
    'user_id',
    'total_amount',
    'cash_received',
    'change_amount',
];

protected static function booted()
{
    static::creating(function ($sale) {
        if (auth()->check() && !$sale->tenant_id) {
            $sale->tenant_id = auth()->user()->tenant_id;
            $sale->branch_id = auth()->user()->branch_id;
        }
    });
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_items', 'sale_id', 'product_id')
                    ->withPivot('quantity', 'unit_price', 'total_price');
    }
}
