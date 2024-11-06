<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintOrganization extends Model
{
    protected $table = 'complaint_organizations';

    protected $fillable = [
        'complaint_id',
        'organization_id',
        'relation_type',
    ];
}
