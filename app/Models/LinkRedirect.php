<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkRedirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_data'
    ];

    protected $casts = [
      'user_data' => 'array'
    ];
}
