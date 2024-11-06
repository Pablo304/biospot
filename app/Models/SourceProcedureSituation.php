<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SourceProcedureSituation extends Model
{
    protected $table = 'source_procedure_situations';
    protected $fillable = [
        'source_procedure_id',
        'source_situation_id',
        'next_source_procedure_id',
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
    public function sourceSituation(): BelongsTo
    {
        return $this->belongsTo(SourceSituation::class);
    }

    /**
     * @return BelongsTo
     */
    public function nextSourceProcedure(): BelongsTo
    {
        return $this->belongsTo(SourceProcedure::class, 'next_source_procedure_id');
    }
}
