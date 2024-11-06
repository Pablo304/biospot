<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'coordinates',
        'location_id',
        'full_address',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
