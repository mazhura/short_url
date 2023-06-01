<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'input_url',
        'hash',
        'user_data'
    ];

    protected $casts = [
        'user_data' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->hash = Str::random(5);

        });
    }

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public function redirects(): HasMany
    {
        return $this->hasMany(LinkRedirect::class);
    }
}
