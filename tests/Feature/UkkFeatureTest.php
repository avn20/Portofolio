<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UkkFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_all_kik_ukk_required_sections(): void
    {
        ProfileSetting::set('full_name', 'Alvin Nabil Saputra');
        ProfileSetting::set('hero_role', 'Junior Web Developer & UI/UX Enthusiast');
        ProfileSetting::set('class_major', 'Kelas XII - Rekayasa Perangkat Lunak (PPLG)');

        Skill::create([
            'name' => 'Laravel Framework',
            'category' => 'hard_skill',
            'level_name' => 'Menengah',
            'percentage' => 85,
        ]);

        Skill::create([
            'name' => 'Problem Solving',
            'category' => 'soft_skill',
            'level_name' => 'Mahir',
            'percentage' => 90,
        ]);

        Project::create([
            'title' => 'Sistem Ujian CBT Online',
            'category' => 'Sistem Sekolah',
            'description' => 'Aplikasi CBT berbasis Laravel',
            'problem_statement' => 'Ujian sebelumnya manual',
            'project_objective' => 'Efisiensi ujian',
            'tech_stack' => 'Laravel, MySQL, Tailwind CSS',
            'role' => 'Fullstack Developer',
            'features' => "Bank Soal\nTimer Realtime",
            'image' => 'assets/img/portfolio1.jpg',
        ]);

        Experience::create([
            'type' => 'plk',
            'title' => 'Magang IT / Web Support',
            'organization' => 'Universitas Muhammadiyah Banjarmasin (UMB)',
            'period' => '2 Bulan',
            'description' => 'Membantu pengelolaan IT kampus UMB',
        ]);

        Blog::create([
            'title' => 'Tips Mengatasi N+1 Query pada Laravel',
            'slug' => 'tips-mengatasi-n-plus-1-query-laravel',
            'category' => 'Catatan Ngoding',
            'summary' => 'Solusi optimasi query Eloquent',
            'content' => 'Gunakan Eager Loading with() untuk mencegah N+1 query problem.',
            'is_published' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Alvin Nabil Saputra');
        $response->assertSee('Kelas XII - Rekayasa Perangkat Lunak (PPLG)');
        $response->assertSee('Lihat Portfolio');
        $response->assertSee('Lihat CV');
        $response->assertSee('Hubungi Saya');
        $response->assertSee('Laravel Framework');
        $response->assertSee('Problem Solving');
        $response->assertSee('Sistem Ujian CBT Online');
        $response->assertSee('Universitas Muhammadiyah Banjarmasin (UMB)');
        $response->assertSee('Tips Mengatasi N+1 Query pada Laravel');
    }

    public function test_visitor_can_submit_kesan_dan_pesan(): void
    {
        $response = $this->post('/pesan', [
            'name' => 'Bapak Penguji UKK 2026',
            'email' => 'penguji@smk.sch.id',
            'category' => 'Kesan Penguji / Guru',
            'message' => 'Proyek portofolio sangat lengkap dan rapi sesuai indikator UKK!',
        ]);

        $response->assertRedirect(route('home') . '#kesan-pesan');
        $response->assertSessionHas('message_submitted');

        $this->assertDatabaseHas('messages', [
            'name' => 'Bapak Penguji UKK 2026',
            'email' => 'penguji@smk.sch.id',
            'category' => 'Kesan Penguji / Guru',
            'is_read' => false,
        ]);
    }

    public function test_admin_can_manage_messages_and_mark_as_read(): void
    {
        $message = Message::create([
            'name' => 'Tamu Pengunjung',
            'email' => 'tamu@mail.com',
            'category' => 'Kesan & Pesan Pengunjung',
            'message' => 'Websitenya keren banget!',
            'is_read' => false,
        ]);

        $response = $this
            ->withSession(['is_admin' => true])
            ->patch(route('admin.messages.read', $message));

        $response->assertRedirect();
        $this->assertTrue($message->fresh()->is_read);
    }

    public function test_admin_can_create_and_update_certificate(): void
    {
        Storage::fake('public');

        $response = $this
            ->withSession(['is_admin' => true])
            ->post(route('admin.certificates.store'), [
                'title' => 'Sertifikat UKK RPL',
                'issuer' => 'BNSP / LSP SMKN 2',
                'category' => 'Sertifikasi Kompetensi',
                'issue_date' => '2026',
                'image' => UploadedFile::fake()->image('cert.png', 800, 600),
            ]);

        $response->assertRedirect(route('admin.certificates.index'));
        $this->assertDatabaseHas('certificates', [
            'title' => 'Sertifikat UKK RPL',
            'issuer' => 'BNSP / LSP SMKN 2',
        ]);
    }

    public function test_admin_can_create_and_filter_experiences(): void
    {
        $response = $this
            ->withSession(['is_admin' => true])
            ->post(route('admin.experiences.store'), [
                'type' => 'plk',
                'title' => 'Magang IT',
                'organization' => 'UMB Banjarmasin',
                'period' => '2 Bulan',
                'description' => 'Mengerjakan pemeliharaan web',
            ]);

        $response->assertRedirect(route('admin.experiences.index'));
        $this->assertDatabaseHas('experiences', [
            'type' => 'plk',
            'organization' => 'UMB Banjarmasin',
        ]);
    }

    public function test_public_can_view_single_blog_post(): void
    {
        $blog = Blog::create([
            'title' => 'Cerita Proyek Ujian Sekolah Tim Modulia',
            'slug' => 'cerita-proyek-ujian-sekolah-tim-modulia',
            'category' => 'Cerita Proyek',
            'summary' => 'Pengalaman membuat aplikasi CBT SDN Teluk Dalam 3',
            'content' => 'Bersama tim Modulia kami membangun sistem CBT...',
            'is_published' => true,
        ]);

        $response = $this->get(route('blogs.show', $blog));

        $response->assertOk();
        $response->assertSee('Cerita Proyek Ujian Sekolah Tim Modulia');
        $response->assertSee('Bersama tim Modulia kami membangun sistem CBT...');
    }

    public function test_public_can_access_digital_cv_page(): void
    {
        $response = $this->get(route('cv.digital'));

        $response->assertOk();
        $response->assertSee('Curriculum Vitae');
        $response->assertSee('Cetak / Download PDF');
        $response->assertSee('SMP Negeri 14 Banjarmasin');
    }

    public function test_admin_can_update_profile_settings_without_code_changes(): void
    {
        $response = $this
            ->withSession(['is_admin' => true])
            ->put(route('admin.profile.update'), [
                'full_name' => 'Alvin Nabil Saputra',
                'hero_role' => 'Full-Stack Developer',
                'personal_branding' => 'Spesialis Laravel dan pengembang tim Modulia.',
            ]);

        $response->assertRedirect(route('admin.profile.index'));
        $this->assertEquals('Alvin Nabil Saputra', ProfileSetting::get('full_name'));
        $this->assertEquals('Full-Stack Developer', ProfileSetting::get('hero_role'));
    }

    public function test_admin_can_manage_skills_with_percentage(): void
    {
        $response = $this
            ->withSession(['is_admin' => true])
            ->post(route('admin.skills.store'), [
                'name' => 'Docker Dasar',
                'category' => 'hard_skill',
                'level_name' => 'Pemula',
                'percentage' => 60,
            ]);

        $response->assertRedirect(route('admin.skills.index'));
        $this->assertDatabaseHas('skills', [
            'name' => 'Docker Dasar',
            'percentage' => 60,
        ]);
    }

    public function test_admin_can_update_project_and_remove_image(): void
    {
        $project = Project::create([
            'title' => 'Nasi Katsu (MBG Project)',
            'category' => 'Web App Lomba Jagoan Hosting',
            'description' => 'Aplikasi web pemesanan dan distribusi katering makanan bergizi.',
            'image' => 'assets/img/project.png',
        ]);

        $response = $this
            ->withSession(['is_admin' => true])
            ->put(route('admin.projects.update', $project), [
                'title' => 'Nasi Katsu (MBG Project)',
                'category' => 'Web App Lomba Jagoan Hosting',
                'description' => 'Aplikasi web pemesanan dan distribusi katering makanan bergizi.',
                'remove_image' => '1',
            ]);

        $response->assertRedirect(route('admin.projects.index'));
        $project->refresh();
        $this->assertNull($project->image);
        $this->assertNull($project->image_url);
    }

    public function test_homepage_hides_fields_when_they_are_cleared_in_admin(): void
    {
        ProfileSetting::set('class_major', null);
        ProfileSetting::set('school_name', null);
        ProfileSetting::set('core_skills', null);
        ProfileSetting::set('interest_tech', null);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('Kelas XII - Rekayasa Perangkat Lunak (PPLG)');
        $response->assertDontSee('Minat & Bidang Teknologi');
    }
}
