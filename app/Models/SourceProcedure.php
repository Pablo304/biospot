<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceProcedure extends Model
{
    protected $table = 'source_procedures';

    protected $fillable = [
        'name',
        'description',
        'initial',
    ];
}
