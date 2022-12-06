<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const TRAN_IN = 'in';

    const TRAN_OUT = 'out';

    const TRAN_TYPE = [
        self::TRAN_IN => 'Masuk',
        self::TRAN_OUT => 'Keluar'
    ];

    protected $fillable = [
        'type', 'date', 'information', 'supplier_id',
        'grand_total', 'created_by', 'updated_by'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getTranDateAttribute()
    {
        return localDate($this->date);
    }

    public function getGrandTotalWithCurrencyAttribute()
    {
        return rupiahPrice($this->grand_total);
    }
}
