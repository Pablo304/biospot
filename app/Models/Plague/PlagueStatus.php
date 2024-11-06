<?php

namespace App\Models\Plague;

use Illuminate\Database\Eloquent\Model;

class PlagueStatus extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];
}
