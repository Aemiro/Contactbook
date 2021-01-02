<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = [
        'name', 'email','phone','slug', 'city','website',
    ];
    public function services(){
        return $this->hasMany(Service::class);
    }
    public function organContacts(){
        return $this->hasMany(OrganContact::class);
    }
    public function organMedia(){
        return $this->hasMany(SocialMedia::class);
    }
   
}
