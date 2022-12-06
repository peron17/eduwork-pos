<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'account_number', 'account_name', 'is_active'
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function getActiveAttribute()
    {
        return labeledStatus($this->is_active);
    }
}
