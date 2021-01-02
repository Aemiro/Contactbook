<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'coverImage','description','organization_id',
    ];
    public function organization(){
        return $this->belongsTo(Service::class);
    }
}
