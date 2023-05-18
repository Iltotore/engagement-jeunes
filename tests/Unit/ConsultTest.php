<?php

namespace Tests\Unit;

use App\Models\Consult;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class ConsultTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_consult_from_user(): void
    {
        $user = User::factory()->hasConsults(3)->create();
        $consults = $user->consults()->get();
        assertTrue(sizeof($consults) == 3);
        foreach($consults as $consult){
            assertTrue($consult->user->id == $user->id);
        }
    }

    public function test_consult_from_reference(): void
    {
        $user = User::factory()->create();
        $consult = Consult::factory()->for($user)->create();
        $references = Reference::factory()->count(3)->for($user)->create();
        assertTrue(sizeof($references) == 3);
        assertTrue($consult->user->id == $user->id);
        foreach($references as $ref) {
            assertTrue($ref->user->id == $user->id);
        }
    }

}
