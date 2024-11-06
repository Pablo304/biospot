<?php

namespace App\Models\Plague;

use App\Models\Organization;
use App\Models\ProcessInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * @return BelongsToMany
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'plague_organizations')
            ->withPivot('relation_type');
    }

    /**
     * @return BelongsTo
     */
    public function processInfo(): BelongsTo
    {
        return $this->belongsTo(ProcessInfo::class);
    }

    /**
     * @return BelongsTo
     */
    public function plagueType(): BelongsTo
    {
        return $this->belongsTo(PlagueType::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(PlagueStatus::class, 'plague_status_id');
    }
}
