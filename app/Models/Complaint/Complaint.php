<?php

namespace App\Models\Complaint;

use App\Models\Plague\Plague;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    protected $table = 'complaints';
    protected $fillable = [
        'started_at',
        'finished_at',
        'plague_id',
        'created_by',
    ];

    /**
     * @return BelongsTo
     */
    public function plague(): BelongsTo
    {
        return $this->belongsTo(Plague::class);
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function casts()
    {
        return [
            'started_at' => 'date',
        ];
    }
}
