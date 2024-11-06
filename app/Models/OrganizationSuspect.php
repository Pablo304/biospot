<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationSuspect extends Model
{
    protected $table = 'organizations_suspect';

    protected $fillable = [
        'complaint_id',
        'organization_id',
        'relation_type',
    ];

}