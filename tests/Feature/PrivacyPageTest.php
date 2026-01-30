<?php

namespace Tests\Feature;

use App\Enums\ContentKey;
use App\Enums\Status;
use App\Models\Content;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrivacyPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_privacy_page_with_content()
    {
        $contentText = "Ceci est la politique de confidentialité.";

        Content::create([
            'key' => ContentKey::PRIVACY_POLICY,
            'status' => Status::ENABLED,
            'content' => [
                'en' => $contentText,
                'fr' => $contentText,
            ],
        ]);

        $response = $this->get(route('app.privacy'));

        $response->assertStatus(200);
        $response->assertSeeText($contentText);
    }
}
