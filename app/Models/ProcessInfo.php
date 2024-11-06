<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessInfo extends Model
{
    protected $table = 'process_infos';
    protected $fillable = [
        'description',
    ];
}
