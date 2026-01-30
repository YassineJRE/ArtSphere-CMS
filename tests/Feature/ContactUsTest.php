<?php

namespace Tests\Feature;

use App\Emails\Web\NotifyAdminForContactUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_email_successfully_with_valid_data()
    {
        Mail::fake();

        $response = $this->postJson(route('app.sendemail'), [
            'email' => 'user@example.com',
        ]);

        $response->assertJson([
            'status' => 'success',
        ]);

        $response->assertSee('view'); // Ajax partial is returned

        Mail::assertSent(NotifyAdminForContactUs::class);
    }

    /** @test */
    public function it_returns_error_with_invalid_data()
    {
        Mail::fake();

        $response = $this->postJson(route('app.sendemail'), []);

        $response->assertJson([
            'status' => 'error',
        ]);

        Mail::assertNothingSent();
    }
}
