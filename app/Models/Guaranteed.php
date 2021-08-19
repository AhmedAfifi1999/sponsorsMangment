<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guaranteed extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'warranty_type','personal_sponsor_id', 'add_data', 'currency_id', 'money'];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function personalSponsor()
    {
        return $this->belongsTo(personalSponsor::class, 'personal_sponsor_id');
    }
}

