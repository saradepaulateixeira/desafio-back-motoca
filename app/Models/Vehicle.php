<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand',
        'model',
        'year',
        'price',
        'color',
        'mileage',
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'decimal:2',
        'mileage' => 'integer',
    ];

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}