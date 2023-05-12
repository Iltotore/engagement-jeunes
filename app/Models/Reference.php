<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Reference extends Authenticatable {
    protected $guarded = [];

    public function user() {
        return $this->hasOne(User::class, "user_id");
    }

    public function hardSkills() {
        return explode(",", $this->hard_skill_values);
    }

    public function softSkills() {
        return explode(",", $this->softSkillValues);
    }
}
