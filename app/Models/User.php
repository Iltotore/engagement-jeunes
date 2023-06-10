<?php

namespace App\Models;

use App\Services\TimeService;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;
use Nette\InvalidStateException;

/**
 * A registered user/"jeune".
 */
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

    /**
     * The references possessed by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references() {
        return $this->hasMany(Reference::class, "user_id");
    }

    /**
     * The consults possessed by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consults() {
        return $this->hasMany(Consult::class, "user_id");
    }

    /**
     * Checks if the delay to confirm this user (by email) has expired.
     *
     * @return bool
     */
    public function hasExpired(): bool {
        $time = App::make(TimeService::class);
        return !$this->isConfirmed() && $time->currentTime(0) >= strtotime($this->expire_at);
    }

    /**
     * Checks if this user's email has been confirmed.
     *
     * @return bool
     */
    public function isConfirmed(): bool {
        return $this->expire_at == null && $this->registration_token == null;
    }

    /**
     * Confirm this user's email.
     *
     * @return void
     */
    public function confirm(): void {
        if($this->isConfirmed()) throw new InvalidStateException("Cannot confirm already confirmed user.");
        if($this->hasExpired()) throw new InvalidStateException("Cannot confirm already expired user.");

        $this->expire_at = null;
        $this->registration_token = null;
        $this->save();
    }

    protected static function booted () {
        static::deleting(function(User $user) {
             foreach($user->references()->get() as $ref) $ref->delete();
             foreach($user->consults()->get() as $consult) $consult->delete();
        });
    }

    /**
     * Unconfirm this user.
     *
     * @return void
     */
    public function unconfirm(): void
    {
        $this->registration_token = uniqid();
        $this->save();
    }

    /**
     * Create an unconfirmed user.
     *
     * @param string $mail
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $birthDate
     * @return User
     */
    public static function createUnconfirmed(string $mail, string $password, string $firstName, string $lastName, string $birthDate, bool $admin = false): User
    {
        $time = App::make(TimeService::class);

        return User::create([
            "email" => $mail,
            "password" => $password,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "birth_date" => $birthDate,
            "expire_at" => date(DateTimeInterface::ATOM, $time->currentTime(3600 * 24)),
            "registration_token" => uniqid(),
            "admin" => $admin
        ]);
    }
}
