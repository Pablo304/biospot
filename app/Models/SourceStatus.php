<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceStatus extends Model
{
    protected $table = 'source_statuses';

    protected $fillable = [
        'name',
        'description',
    ];
}
