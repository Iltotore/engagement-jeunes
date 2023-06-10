<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * A consult is a list of references sent by a user to a consultant.
 */
class Consult extends Authenticatable
{

    use HasFactory;

    protected $guarded = [];

    /**
     * The owner of this consult.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The references of this consult.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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
