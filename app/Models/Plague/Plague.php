<?php

namespace App\Models\Plague;

use Illuminate\Database\Eloquent\Model;

class Plague extends Model
{
    protected $table = 'plagues';
    protected $fillable = [
        'plague_type_id',
        'suspect_id',
        'process_info_id',
        'plague_status_id',
    ];

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $casts = [
        'is_public' => 'boolean'
    ];
}
