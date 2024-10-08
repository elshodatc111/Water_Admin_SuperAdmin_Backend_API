<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_id',
        'currer_id',
        'count',
        'city',
        'town',
        'latitude',
        'longitude',
        'status',
        'addres',
    ];
}