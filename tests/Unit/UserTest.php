<?php

namespace Tests\Unit;

use App\Models\User;
use DateTimeInterface;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @throws Exception
     */
    public function test_has_expired(): void
    {
        $format = DateTimeInterface::ATOM;

        $expired = User::factory()->state(["expire_at" => date($format, time()-3600)])->create();
        assertTrue($expired->hasExpired(), "expired");

        $notExpired = User::factory()->state(["expire_at" => date($format, time()+3600)])->create();
        assertFalse($notExpired->hasExpired(), "not expired");
    }
}
