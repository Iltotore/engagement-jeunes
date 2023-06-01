<?php

namespace App\Models;

use App\Services\TimeService;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Nette\InvalidStateException;

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

    public function timeDuration(): int {
        return strtotime($this->duration);
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
        $this->token = null;
        $this->save();
    }

    protected static function booted () {
        static::deleting(function(Reference $reference) {
             $reference->consults()->detach();
        });
    }

    public static function createUnconfirmed(
        User $owner,
        string $description,
        string $area,
        array $hardSkills,
        array $softSkills,
        int $duration,
        string $email,
        string $firstName,
        string $lastName,
        string $birthDate
    ): Reference {
        $time = App::make(TimeService::class);

        return Reference::create([
            "user_id" => $owner->id,
            "description" => $description,
            "area" => $area,
            "hard_skill_values" => implode(",", $hardSkills),
            "soft_skill_values" => implode(",", $softSkills),
            "duration" => date(DateTimeInterface::ATOM, $duration),
            "ref_mail" => $email,
            "ref_first_name" => $firstName,
            "ref_last_name" => $lastName,
            "ref_birth_date" => $birthDate,
            "expire_at" => date(DateTimeInterface::ATOM, $time->currentTime(3600*24*7)),
            "token" => uniqid()
        ]);
    }
}
