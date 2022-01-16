<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'DateExch',
        'Rate',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


}
