<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id', 'product_id', 'price', 'qty'
    ];

    public $timestamps = false;

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceWithCurrencyAttribute()
    {
        return rupiahPrice($this->price);
    }
}
