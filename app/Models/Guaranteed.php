<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guaranteed extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'warranty_type', 'add_data', 'currency_id', 'money'];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}

