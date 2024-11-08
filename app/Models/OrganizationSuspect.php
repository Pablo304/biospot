<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationSuspect extends Model
{
    protected $table = 'organization_suspects';

    protected $fillable = [
        'suspect_id',
        'organization_id',
        'relation_type',
    ];

}
