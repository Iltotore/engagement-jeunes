<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Consultation extends Authenticatable {
    protected $guarded = [];

    public function references() {
        return array_map(fn($id) => Reference::where("id", $id)->first(), explode(",", $this->references_id));
    }
}
