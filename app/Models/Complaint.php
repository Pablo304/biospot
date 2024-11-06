<?php

namespace App\Models;

use App\Casts\DateFormatCaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Complaint extends Model
{
    protected $fillable = [
        'started_at',
        'finished_at',
        'status_id',
        'process_info_id',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function processInfo(): BelongsTo
    {
        return $this->belongsTo(ProcessInfo::class);
    }

    protected function casts()
    {
        return [
            'started_at' => DateFormatCaster::class,
            'finished_at' => DateFormatCaster::class,
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'complaint_organizations')
            ->withPivot('relation_type');
    }
}
