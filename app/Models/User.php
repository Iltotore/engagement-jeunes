<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    // Allow any field to be inserted
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function references() {
        return $this->hasMany(Reference::class, "user_id");
    }
}
