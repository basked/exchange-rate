<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'CurrId',
        'NumCode',
        'CharCode',
        'Scale',
        'Name',
        'EnglishName',
        'ParentCode',
    ];

    public $timestamps = false;

    function exchanges(){
        return $this->hasMany(Exchange::class);
    }
}
