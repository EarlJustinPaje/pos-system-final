<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'code',
        'address',
        'contact_number',
        'email',
        'is_active',
        'is_main_branch',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_main_branch' => 'boolean',
            'settings' => 'array',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($branch) {
            if (!$branch->code) {
                $branch->code = strtoupper(substr($branch->tenant->slug, 0, 3) . '-' . uniqid());
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function managers()
    {
        return $this->users()->where('role', 'manager');
    }

    public function cashiers()
    {
        return $this->users()->where('role', 'cashier');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}