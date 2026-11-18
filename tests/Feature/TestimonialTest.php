<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear('submit-testimonial:127.0.0.1');
    }

    public function test_public_homepage_only_displays_approved_testimonials(): void
    {
        Testimonial::factory()->create([
            'name' => 'Bapak Guru Pembimbing, S.Kom',
            'role' => 'Guru Produktif PPLG',
            'content' => 'Siswa yang sangat berdedikasi tinggi.',
            'is_approved' => true,
        ]);

        Testimonial::factory()->pending()->create([
            'name' => 'Pengguna Pending',
            'role' => 'Teman Belum Disetujui',
            'content' => 'Testimoni ini masih menunggu persetujuan.',
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Bapak Guru Pembimbing, S.Kom')
            ->assertSee('Guru Produktif PPLG')
            ->assertSee('Siswa yang sangat berdedikasi tinggi.')
            ->assertDontSee('Pengguna Pending')
            ->assertDontSee('Testimoni ini masih menunggu persetujuan.');
    }

    public function test_public_visitor_can_submit_testimonial_pending_approval(): void
    {
        Storage::fake('public');

        $response = $this->post('/testimoni', [
            'name' => 'Muhammad Fikri',
            'role' => 'Rekan Tim Modulia / Teman Sekelas',
            'content' => 'Alvin sangat proaktif dalam mengerjakan bagian backend dan API.',
            'avatar' => UploadedFile::fake()->image('fikri.png', 200, 200),
        ]);

        $response->assertRedirect(route('home').'#testimoni');
        $response->assertSessionHas('testimonial_submitted');

        $this->assertDatabaseHas('testimonials', [
            'name' => 'Muhammad Fikri',
            'role' => 'Rekan Tim Modulia / Teman Sekelas',
            'is_approved' => false,
        ]);

        // Unapproved testimonial must NOT appear on homepage
        $this->get('/')
            ->assertOk()
            ->assertDontSee('Muhammad Fikri');
    }

    public function test_admin_can_approve_pending_testimonial(): void
    {
        $testimonial = Testimonial::factory()->pending()->create([
            'name' => 'Ibu Guru Tamu',
            'role' => 'Mentor Industri',
            'content' => 'Kerja sama tim sangat rapi.',
        ]);

        // Initially not on homepage
        $this->get('/')->assertDontSee('Ibu Guru Tamu');

        // Admin approves it
        $response = $this
            ->withSession(['is_admin' => true])
            ->patch("/admin/testimonials/{$testimonial->id}/approve");

        $response->assertRedirect();
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'is_approved' => true,
        ]);

        // Now it appears on homepage!
        $this->get('/')
            ->assertOk()
            ->assertSee('Ibu Guru Tamu')
            ->assertSee('Mentor Industri');
    }

    public function test_admin_can_unapprove_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create([
            'name' => 'Siswa Disetujui',
            'is_approved' => true,
        ]);

        $response = $this
            ->withSession(['is_admin' => true])
            ->patch("/admin/testimonials/{$testimonial->id}/unapprove");

        $response->assertRedirect();
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'is_approved' => false,
        ]);

        // Hidden from homepage
        $this->get('/')->assertDontSee('Siswa Disetujui');
    }

    public function test_guest_cannot_access_admin_testimonials(): void
    {
        $this->get('/admin/testimonials')->assertRedirect('/admin/masuk');
        $this->get('/admin/testimonials/create')->assertRedirect('/admin/masuk');
    }

    public function test_admin_can_view_testimonials_index_with_filters(): void
    {
        Testimonial::factory()->create(['name' => 'Testimoni Disetujui', 'is_approved' => true]);
        Testimonial::factory()->pending()->create(['name' => 'Testimoni Pending']);

        $response = $this
            ->withSession(['is_admin' => true])
            ->get('/admin/testimonials');

        $response->assertOk()
            ->assertSee('Kelola Testimoni')
            ->assertSee('Testimoni Disetujui')
            ->assertSee('Testimoni Pending');

        // Filter only pending
        $pendingResponse = $this
            ->withSession(['is_admin' => true])
            ->get('/admin/testimonials?status=pending');

        $pendingResponse->assertOk()
            ->assertSee('Testimoni Pending')
            ->assertDontSee('Testimoni Disetujui');
    }

    public function test_admin_can_create_testimonial(): void
    {
        $response = $this
            ->withSession(['is_admin' => true])
            ->post('/admin/testimonials', [
                'name' => 'Guru Pembimbing Langsung',
                'role' => 'Guru SMKN 2 Banjarmasin',
                'content' => 'Kerja bagus dalam proyek ujian sekolah.',
                'is_approved' => '1',
            ]);

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseHas('testimonials', [
            'name' => 'Guru Pembimbing Langsung',
            'role' => 'Guru SMKN 2 Banjarmasin',
            'content' => 'Kerja bagus dalam proyek ujian sekolah.',
            'is_approved' => true,
            'avatar' => null,
        ]);
    }

    public function test_admin_can_update_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create([
            'name' => 'Nama Lama',
            'role' => 'Peran Lama',
        ]);

        $response = $this
            ->withSession(['is_admin' => true])
            ->put("/admin/testimonials/{$testimonial->id}", [
                'name' => 'Nama Baru',
                'role' => 'Peran Baru',
                'content' => 'Konten diperbarui.',
                'is_approved' => '1',
            ]);

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'name' => 'Nama Baru',
            'role' => 'Peran Baru',
            'is_approved' => true,
        ]);
    }

    public function test_admin_can_delete_testimonial(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('testimonials', 'public');

        $testimonial = Testimonial::factory()->create([
            'avatar' => $path,
        ]);

        Storage::disk('public')->assertExists($path);

        $response = $this
            ->withSession(['is_admin' => true])
            ->delete("/admin/testimonials/{$testimonial->id}");

        $response->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
        Storage::disk('public')->assertMissing($path);
    }
}
