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
        return $this->belongsTo(User::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }

    protected static function booted () {
        static::deleting(function(Consult $consult) {
             $consult->references()->detach();
        });
    }
}
