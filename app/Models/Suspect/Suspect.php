<?php

namespace App\Models\Suspect;

use App\Models\Complaint;
use App\Models\Organization;
use App\Models\ProcessInfo;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Suspect extends Model
{
    protected $table = 'suspects';
    protected $fillable = [
        'notes',
        'complaint_id',
        'status_id',
        'process_info_id',
    ];

    /**
     * @return BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return BelongsTo
     */
    public function processInfo(): BelongsTo
    {
        return $this->belongsTo(ProcessInfo::class);
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_suspects')
            ->withPivot('relation_type');
    }
}
