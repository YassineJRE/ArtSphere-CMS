<?php

namespace Tests\Feature;

use App\Enums\ArtistType as EnumArtistType;
use App\Enums\ArtPracticeType as EnumArtPracticeType;
use App\Enums\ProfileType as EnumProfileType;
use App\Enums\Status as EnumStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_search_results()
    {
        $user = User::factory()->create();

        UserProfile::factory()->create([
            'user_id' => $user->id,
            'status' => EnumStatus::ENABLED,
            'type' => EnumProfileType::ARTIST,
            'artist_type' => EnumArtistType::AMATEUR,
            'art_practice_type' => EnumArtPracticeType::PERFORMANCE,
            'artist_name' => 'JeanRecherche',
        ]);

        // Utilisation du nom de route au lieu d'URL fixe
        $url = route('app.research', ['search' => 'Jean']);

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertSee('JeanRecherche');
    }

    /** @test */
    public function it_handles_empty_search_query()
    {
        // Crée un utilisateur "email-verified"
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        // Crée un profil vérifié pour cet utilisateur
        UserProfile::factory()->create([
            'user_id' => $user->id,
            'status' => EnumStatus::ENABLED,
            'type' => EnumProfileType::ARTIST,
            'artist_type' => EnumArtistType::AMATEUR,
            'art_practice_type' => EnumArtPracticeType::PERFORMANCE,
        ]);

        $this->actingAs($user);

        $url = route('app.research');

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertSee(__('research.views.index.title.research'));
    }

}
