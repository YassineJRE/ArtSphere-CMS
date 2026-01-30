<?php

namespace Tests\Unit;

use App\Enums\Status as EnumStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_enabled()
    {
        $user = User::factory()->create(['status' => EnumStatus::PENDING]);

        $user->markAsEnabled();

        $this->assertEquals(EnumStatus::ENABLED, $user->fresh()->status);
    }

    /** @test */
    public function it_generates_default_name_slug()
    {
        $user = User::factory()->make(['first_name' => 'Jean-Pierre']);

        $this->assertEquals('jean-pierre', $user->getDefaultName());
    }

    /** @test */
    public function it_returns_false_if_no_verified_profile()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->hasVerifiedProfile());
    }

    /** @test */
    public function it_generates_a_unique_username_on_creation()
    {
        $firstUser = User::factory()->create(['first_name' => 'Léa', 'last_name' => 'Dubois']);
        $secondUser = User::factory()->create(['first_name' => 'Léa', 'last_name' => 'Dubois']);

        $this->assertNotEquals($firstUser->username, $secondUser->username);
        $this->assertTrue(Str::startsWith($secondUser->username, Str::slug('Léa') . 'D'));
    }
}
