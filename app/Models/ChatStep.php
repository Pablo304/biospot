<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatStep extends Model
{
    protected $table = 'chat';

    protected $fillable = ['phone', 'step', 'complaint_id'];

}
