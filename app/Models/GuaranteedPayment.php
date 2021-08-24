<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuaranteedPayment extends Model
{
    use HasFactory;

    protected $fillable = ['money', 'currency_id', 'guaranteed_id'];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function guaranteed()
    {
        return $this->belongsTo(Guaranteed::class);
    }

}
