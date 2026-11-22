<?php

namespace Tests\Feature;

use App\Models\JobPosting;
use App\Models\Office;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ZimmoahPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads_with_maersk_ui_and_security_headers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('ZIMMOAH');
        $response->assertSee('Go the distance');
        $response->assertSee('Jakarta Head Office');
        $response->assertSee('Kirana Boutique Office');

        // Security headers check
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }

    public function test_shipping_schedules_page_loads_and_filters(): void
    {
        $response = $this->get('/schedules?origin=Jakarta');

        $response->assertStatus(200);
        $response->assertSee('Jadwal Keberangkatan');
        $response->assertSee('Tanjung Priok');
    }

    public function test_career_page_displays_jobs_and_allows_application(): void
    {
        Storage::fake('local');

        $job = JobPosting::first();
        $this->assertNotNull($job);

        // Visit career index
        $response = $this->get('/careers');
        $response->assertStatus(200);
        $response->assertSee($job->title);

        // Visit job detail
        $detailResponse = $this->get("/careers/{$job->slug}");
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee($job->title);

        // Submit application with fake PDF resume
        $fakeResume = UploadedFile::fake()->create('test_resume.pdf', 500, 'application/pdf');

        $applyResponse = $this->post("/careers/{$job->slug}/apply", [
            'full_name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@example.com',
            'phone' => '+6281299998888',
            'expected_salary' => 8500000,
            'notice_period' => '1 Bulan',
            'resume' => $fakeResume,
        ]);

        $applyResponse->assertRedirect("/careers/{$job->slug}/applied");

        $this->assertDatabaseHas('job_applications', [
            'full_name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@example.com',
            'job_posting_id' => $job->id,
        ]);
    }

    public function test_ticket_creation_and_tracking(): void
    {
        $response = $this->post('/tickets', [
            'customer_name' => 'PT Pelita Nusantara',
            'customer_email' => 'logistics@pelita.co.id',
            'customer_phone' => '+62811223344',
            'category' => 'FORWARDING',
            'priority' => 'HIGH',
            'subject' => 'Booking space kargo udara Jakarta ke Seoul',
            'message' => 'Mohon konfirmasi ketersediaan space 500kg kargo garmen.',
        ]);

        $ticket = Ticket::where('customer_email', 'logistics@pelita.co.id')->first();
        $this->assertNotNull($ticket);
        $this->assertStringStartsWith('ZIM-', $ticket->ticket_code);

        $response->assertRedirect("/tickets/track?code={$ticket->ticket_code}&token={$ticket->access_token}");

        // Track page
        $trackResponse = $this->get("/tickets/track?code={$ticket->ticket_code}&token={$ticket->access_token}");
        $trackResponse->assertStatus(200);
        $trackResponse->assertSee($ticket->ticket_code);
        $trackResponse->assertSee('PT Pelita Nusantara');
    }

    public function test_admin_authentication_and_dashboard_access(): void
    {
        // Unauthenticated access redirects to login
        $guestResponse = $this->get('/admin');
        $guestResponse->assertRedirect('/login');

        // Login as admin
        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@zimmoah.com',
            'password' => 'password123',
        ]);
        $loginResponse->assertRedirect('/admin');

        // Access dashboard
        $admin = User::where('email', 'admin@zimmoah.com')->first();
        $authResponse = $this->actingAs($admin)->get('/admin');
        $authResponse->assertStatus(200);
        $authResponse->assertSee('Overview Operasional');
        $authResponse->assertSee('Total Tiket');
    }

    public function test_language_switcher_changes_locale_between_en_ko_and_id(): void
    {
        // Switch to Korean
        $this->get('/lang/ko')->assertRedirect();
        $koResponse = $this->get('/');
        $koResponse->assertStatus(200);
        $koResponse->assertSee('운항 스케줄');
        $koResponse->assertSee('화물 추적');

        // Switch to English
        $this->get('/lang/en')->assertRedirect();
        $enResponse = $this->get('/');
        $enResponse->assertStatus(200);
        $enResponse->assertSee('All Branch Operations Normal');
        $enResponse->assertSee('Open Inquiry Ticket');

        // Switch back to Indonesian
        $this->get('/lang/id')->assertRedirect();
        $idResponse = $this->get('/');
        $idResponse->assertStatus(200);
        $idResponse->assertSee('Operasional Seluruh Cabang Normal');
    }

    public function test_cargo_tracking_displays_shipment_with_maersk_milestone_progress(): void
    {
        $response = $this->get('/tracking?tracking_number=ZIM-CARGO-9042');

        $response->assertStatus(200);
        $response->assertSee('ZIM-CARGO-9042');
        $response->assertSee('ZIMU-4092817');
        $response->assertSee('Booked');
        $response->assertSee('Gate In');
        $response->assertSee('On Vessel');
        $response->assertSee('Customs Clearance');
        $response->assertSee('Delivered');
        $response->assertSee('Step 3 / 5 (55%)');
    }
}
