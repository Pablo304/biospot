<?php

namespace App\Models\Plague;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrganizationPlague extends Model
{
    protected $table = 'plague_organizations';

    protected $fillable = [
        'plague_id',
        'organization_id',
        'relation_type',
    ];

    /**
     * @return BelongsToMany
     */
    public function plagues(): BelongsToMany
    {
        return $this->belongsToMany(Plague::class, 'plague_organizations')
            ->withPivot('relation_type');
    }
}
