<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Consult extends Authenticatable {

    use HasFactory;

    protected $guarded = [];

    public function references() {
        return array_map(fn($id) => Reference::where("id", $id)->first(), explode(",", $this->references_id));
    }
}
