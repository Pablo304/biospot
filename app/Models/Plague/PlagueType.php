<?php

namespace App\Models\Plague;

use Illuminate\Database\Eloquent\Model;

class PlagueType extends Model
{
    protected $table = 'plague_types';
    protected $fillable = [
        'name',
        'description',
    ];
}
