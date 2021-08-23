<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'enterprise_sponsor_id', 'personal_sponsor_id', 'guaranteed_id', 'start', 'end'];

    public function guaranteed()
    {
        return $this->belongsTo(Guaranteed::class);
    }

    public function personal_sponsor()
    {
        return $this->belongsTo(personalSponsor::class);
    }
}
