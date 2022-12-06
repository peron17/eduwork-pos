<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'date', 'customer_id',
        'information', 'sub_total', 'discount',
        'grand_total', 'payment_method_id', 'created_by',
        'updated_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getSalesDateAttribute()
    {
        return localDate($this->date);
    }

    public function getSubTotalWithCurrencyAttribute()
    {
        return rupiahPrice($this->sub_total);
    }

    public function getGrandTotalWithCurrencyAttribute()
    {
        return rupiahPrice($this->grand_total);
    }
}
