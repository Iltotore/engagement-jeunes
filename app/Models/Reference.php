<?php

namespace App\Models;

use App\Services\TimeService;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Nette\InvalidStateException;

/**
 * Represents a working experience of a user.
 */
class Reference extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The owner of this reference.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * The list of hard skills mentioned in this reference.
     *
     * @return string[]
     */
    public function hardSkills()
    {
        return explode(",", $this->hard_skill_values);
    }

    /**
     * The list of soft skills mentioned in this reference.
     *
     * @return string[]
     */
    public function softSkills()
    {
        return explode(",", $this->soft_skill_values);
    }

    /**
     * The consults that contain this reference.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function consults()
    {
        return $this->belongsToMany(Consult::class);
    }

    /**
     * The duration of the experience represented by this reference in Unix timestamp format.
     *
     * @return int
     */
    public function timeDuration(): int
    {
        return strtotime($this->duration);
    }

    /**
     * Check if this reference has been confirmed by its referent.
     *
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->token == null && $this->expire_at == null;
    }

    /**
     * Check if the delay to confirm this reference has expired.
     *
     * @return bool
     */
    public function hasExpired(): bool
    {
        $time = App::make(TimeService::class);
        return !$this->isConfirmed() && $time->currentTime(0) >= strtotime($this->expire_at);
    }

    /**
     * Confirm this reference.
     *
     * @return void
     */
    public function confirm(): void
    {
        if ($this->isConfirmed()) throw new InvalidStateException("Cannot confirm already confirmed reference.");
        if ($this->hasExpired()) throw new InvalidStateException("Cannot confirm already expired reference.");

        $this->expire_at = null;
        $this->token = null;
        $this->save();
    }

    protected static function booted()
    {
        static::deleting(function (Reference $reference) {
            $reference->consults()->detach();
        });
    }

    /**
     * Create a new, unconfirmed, reference.
     *
     * @param User $owner
     * @param string $description
     * @param string $area
     * @param array $hardSkills
     * @param array $softSkills
     * @param int $duration
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $birthDate
     * @return Reference
     */
    public static function createUnconfirmed(
        User   $owner,
        string $description,
        string $area,
        array  $hardSkills,
        array  $softSkills,
        int    $duration,
        string $email,
        string $firstName,
        string $lastName,
        string $birthDate
    ): Reference
    {
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
            "expire_at" => date(DateTimeInterface::ATOM, $time->currentTime(3600 * 24 * 7)),
            "token" => uniqid()
        ]);
    }
}
