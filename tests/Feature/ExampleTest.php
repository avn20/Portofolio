<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear('admin-login:127.0.0.1');
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('<html lang="id"', false)
            ->assertSee('Halo, perkenalkan saya');
    }

    public function test_visitor_can_switch_portfolio_language_to_english(): void
    {
        $switchResponse = $this->get('/language/en');

        $switchResponse
            ->assertRedirect(route('home'))
            ->assertSessionHas('locale', 'en');

        $this->get('/')
            ->assertOk()
            ->assertSee('<html lang="en"', false)
            ->assertSee('Web Developer &amp; UI/UX Designer', false)
            ->assertSee('View Projects');
    }

    public function test_unsupported_portfolio_language_is_not_available(): void
    {
        $this->get('/language/fr')->assertNotFound();
    }

    public function test_admin_projects_page_redirects_guests_to_login(): void
    {
        $response = $this->get('/admin/projects');

        $response->assertRedirect('/admin/masuk');
    }

    public function test_admin_can_login_with_configured_password(): void
    {
        $response = $this->post('/admin/masuk', [
            'password' => env('ADMIN_PASSWORD', 'admin123'),
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertTrue(session('is_admin'));
    }

    public function test_wrong_admin_password_does_not_login(): void
    {
        $response = $this->from('/admin/masuk')->post('/admin/masuk', [
            'password' => '<script>alert(1)</script>',
        ]);

        $response->assertRedirect('/admin/masuk');
        $response->assertSessionHasErrors('password');
        $this->assertFalse((bool) session('is_admin'));
    }

    public function test_admin_login_is_rate_limited_after_repeated_failures(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->from('/admin/masuk')->post('/admin/masuk', [
                'password' => 'salah-'.$attempt,
            ]);
        }

        $response = $this->from('/admin/masuk')->post('/admin/masuk', [
            'password' => env('ADMIN_PASSWORD', 'admin123'),
        ]);

        $response->assertRedirect('/admin/masuk');
        $response->assertSessionHasErrors('password');
        $this->assertFalse((bool) session('is_admin'));
    }

    public function test_admin_can_create_project_with_image(): void
    {
        Storage::fake('public');

        $response = $this
            ->withSession(['is_admin' => true])
            ->post('/admin/projects', [
                'title' => 'Website Ujian Sekolah',
                'description' => 'Aplikasi ujian online berbasis web.',
                'image' => UploadedFile::fake()->image('project.jpg', 900, 600),
                'link' => 'https://example.com',
            ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', [
            'title' => 'Website Ujian Sekolah',
            'description' => 'Aplikasi ujian online berbasis web.',
            'link' => 'https://example.com',
        ]);

        $project = Project::firstOrFail();

        Storage::disk('public')->assertExists($project->image);
    }
}
