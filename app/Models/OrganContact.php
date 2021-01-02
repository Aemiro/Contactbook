<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganContact extends Model
{
    protected $fillable = [
        'phone','type', 'organization_id',
    ];
}
