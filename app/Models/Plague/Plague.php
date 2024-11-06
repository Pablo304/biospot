<?php

namespace App\Models\Plague;

use Illuminate\Database\Eloquent\Model;

class Plague extends Model
{
    protected $table = 'plagues';
    protected $fillable = [
        'name',
        'description',
        'is_public',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_public' => 'boolean'
    ];
}
