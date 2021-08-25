<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'enterprise_sponsor_id', 'personal_sponsor_id', 'guaranteed_id', 'start', 'end'];

    protected $guarded=[];
    public function guaranteeds()
    {
        return $this->hasMany(Guaranteed::class);
    }

    public function personal_sponsor()
    {
        return $this->belongsTo(personalSponsor::class);
    }
}
