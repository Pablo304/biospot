<?php

namespace App\Models\Procedures;

use App\Models\Complaint\Complaint;
use App\Models\SourceProcedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Procedure extends Model
{
    protected $table = 'procedures';
    protected $fillable = [
        'source_procedure_id',
        'complaint_id',
        'executed_at',
        'content',
    ];

    /**
     * @return BelongsTo
     */
    public function sourceProcedure(): BelongsTo
    {
        return $this->belongsTo(SourceProcedure::class);
    }

    /**
     * @return BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'executed_at' => 'date',
        ];
    }
}
