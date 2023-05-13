<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Consult extends Authenticatable
{

    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }
}
