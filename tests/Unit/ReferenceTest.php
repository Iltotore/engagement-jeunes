<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class ReferenceTest extends TestCase {
    use RefreshDatabase;

    /**
     * User can have multiple references.
     */
    public function test_user_multiple_references(): void {
        $user = User::factory()->hasReferences(3)->create();
        $references = $user->references()->get();
        assertTrue(sizeof($references) == 3, "right count");
        foreach ($references as $ref) {
            assertTrue($ref->user_id == $user->id, "id consistent");
        }
    }
}
