<?php

namespace App\Models\Procedures;

use App\Models\SourceProcedureSituation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcedureSituation extends Model
{
    protected $fillable = [
        'source_procedure_situation_id',
        'procedure_id',
    ];

    public function sourceProcedureSituation(): BelongsTo
    {
        return $this->belongsTo(SourceProcedureSituation::class);
    }

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class);
    }
}
