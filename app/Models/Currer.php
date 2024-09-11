<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_id',
        'reyting',
        'reyting_count',
    ];
}