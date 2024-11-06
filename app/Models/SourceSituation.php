<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceSituation extends Model
{
    protected $table = 'source_situations';

    protected $fillable = [
        'name',
        'description',
    ];
}
