<?php

namespace Tests\Feature;

use App\Models\Consult;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class RemoveTest extends TestCase
{
    use RefreshDatabase;
   

    public function test_remove_reference_removes_from_consult(): void
    {
        $user = User::factory()->create();
        $references = Reference::factory()->count(3)->for($user)->create();
        $consult = Consult::factory()->create();
        $consult->references()->attach($references);
        
        assertTrue(sizeof($references) == 3, "right base size");

        $references[0]->delete();

        assertTrue(sizeof($consult->references->all()) == 2, "right final size");
    }

    public function test_remove_consult_removes_relation_with_references(): void {
        $user = User::factory()->create();
        $references = Reference::factory()->count(3)->for($user)->create();
        $consult = Consult::factory()->create();
        $consult->references()->attach($references);

        $id = $consult->id;
        
        assertTrue(sizeof(DB::table("consult_reference")->where("consult_id", $id)->get()) == 3, "right base size");

        $consult->delete();

        assertTrue(sizeof(DB::table("consult_reference")->where("consult_id", $id)->get()) == 0, "right final size");
    }

    public function test_remove_user_removes_references(): void {
        $user = User::factory()->create();
        $references = Reference::factory()->count(3)->for($user)->create();

        assertTrue(sizeof(DB::table("references")->where("user_id", $user->id)->get()) == 3, "right base size");

        $user->delete();

        assertTrue(sizeof(DB::table("references")->where("user_id", $user->id)->get()) == 0, "right final size");
    }

    public function test_remove_user_removes_consults(): void {
        $user = User::factory()->create();
        $consults = Consult::factory()->count(3)->for($user)->create();

        assertTrue(sizeof(DB::table("consults")->where("user_id", $user->id)->get()) == 3, "right base size");

        $user->delete();

        assertTrue(sizeof(DB::table("consults")->where("user_id", $user->id)->get()) == 0, "right final size");
    }
}
