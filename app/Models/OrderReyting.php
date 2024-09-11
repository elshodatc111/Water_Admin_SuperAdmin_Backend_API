<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReyting extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'order_id',
        'user_id',
        'currer_id',
        'comment',
        'reyting',
    ];
}
