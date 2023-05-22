<?php

namespace App\Models;

use App\Services\TimeService;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;
use Nette\InvalidStateException;

class User extends Authenticatable {

    use HasFactory;

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

    public function consults() {
        return $this->hasMany(Consult::class, "user_id");
    }

    public function hasExpired(): bool {
        $time = App::make(TimeService::class);
        return $this->isConfirmed() || $time->currentTime(0) >= strtotime($this->expire_at);
    }

    public function isConfirmed(): bool {
        return $this->expire_at == null && $this->registration_token == null;
    }

    public function confirm(): void {
        if($this->isConfirmed()) throw new InvalidStateException("Cannot confirm already confirmed user.");
        if($this->hasExpired()) throw new InvalidStateException("Cannot confirm already expired user.");

        $this->expire_at = null;
        $this->registration_token = null;
        $this->save();
    }

    public static function createUnconfirmed(string $mail, string $password, string $firstName, string $lastName, string $birthDate): User {
        $time = App::make(TimeService::class);

        return User::create([
            "email" => $mail,
            "password" => $password,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "birth_date" => $birthDate,
            "expire_at" => date(DateTimeInterface::ATOM, $time->currentTime(3600*24)),
            "registration_token" => uniqid()
        ]);
    }
}
