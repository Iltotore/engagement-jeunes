<?php

namespace Tests\Unit;

use App\Models\Reference;
use App\Models\User;
use App\Services\TimeService;
use DateTimeInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class ReferenceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can have multiple references.
     */
    public function test_user_multiple_references(): void
    {
        $user = User::factory()->hasReferences(3)->create();
        $references = $user->references()->get();
        assertTrue(sizeof($references) == 3, "right count");
        foreach ($references as $ref) {
            assertTrue($ref->user->id == $user->id, "id consistent");
        }
    }

    public function test_hardSkills()
    {
        $hardSkills = fake()->words(6); //Hard skills générés

        $reference = Reference::factory()->state(function ($attrs) use ($hardSkills) {
            return ["hard_skill_values" => implode(",", $hardSkills)];
        })->create();
        assertTrue(sizeof($reference->hardSkills()) == 6);
        assertTrue($reference->hardSkills() == $hardSkills);
    }

    public function test_softSkills()
    {
        $softSkills = fake()->words(6); //Hard skills générés

        $reference = Reference::factory()->state(function ($attrs) use ($softSkills) {
            return ["soft_skill_values" => implode(",", $softSkills)];
        })->create();
        assertTrue(sizeof($reference->softSkills()) == 6);
        assertTrue($reference->softSkills() == $softSkills);
    }

    public function test_has_expired(): void
    {
        $time = App::make(TimeService::class);

        $format = DateTimeInterface::ATOM;

        $expired = Reference::factory()->state(["expire_at" => date($format, $time->currentTime(-3600))])->create();
        assertTrue($expired->hasExpired(), "expired");

        $notExpired = Reference::factory()->state(["expire_at" => date($format, $time->currentTime(3600))])->create();
        assertFalse($notExpired->hasExpired(), "not expired");
    }
}
