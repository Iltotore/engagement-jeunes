<?php

namespace App\Models;

use App\Services\TimeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;

class Reference extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function hardSkills()
    {
        return explode(",", $this->hard_skill_values);
    }

    public function softSkills()
    {
        return explode(",", $this->soft_skill_values);
    }

    public function consults()
    {
        return $this->belongsToMany(Consult::class);
    }

    public function isConfirmed(): bool {
        return $this->token == null && $this->expire_at == null;
    }

    public function hasExpired(): bool {
        $time = App::make(TimeService::class);
        return $this->isConfirmed() || $time->currentTime(0) >= strtotime($this->expire_at);
    }

    public function confirm(): void {
        if($this->isConfirmed()) throw new InvalidStateException("Cannot confirm already confirmed reference.");
        if($this->hasExpired()) throw new InvalidStateException("Cannot confirm already expired reference.");

        $this->expire_at = null;
        $this->registration_token = null;
        $this->save();
    }
}
