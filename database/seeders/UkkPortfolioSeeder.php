<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class UkkPortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Profile Settings (Hanya SMP ke SMK, Tanpa TTL, Tanpa SDN)
        $profileData = [
            'full_name' => 'Alvin Nabil Saputra',
            'nickname' => 'Alvin',
            'class_major' => 'Kelas XII - Rekayasa Perangkat Lunak (PPLG)',
            'school_name' => 'SMKN 2 Banjarmasin',
            'hero_role' => 'Junior Full-Stack Web Developer & UI/UX Enthusiast',
            'status_badge' => 'Junior Web Developer • Terbuka untuk Kolaborasi',
            'personal_branding' => 'Full-Stack Web Developer yang berfokus membangun aplikasi web modern dan fungsional.',
            'core_skills' => 'Laravel, PHP, Filament, Tailwind CSS, MySQL, JavaScript, Git, Figma',
            'avatar_image' => 'assets/img/me.jpg',
            
            // Section Tentang Saya (Tanpa TTL, Tanpa SDN)
            'about_bio' => 'Halo! Saya Alvin Nabil Saputra, seorang Full-Stack Web Developer. Saya berfokus pada pengembangan aplikasi web yang fungsional, arsitektur database, dan antarmuka pengguna yang bersih serta mudah digunakan.',
            'address' => 'Banjarmasin, Kalimantan Selatan, Indonesia',
            'spoken_languages' => 'Bahasa Indonesia (Aktif), Bahasa Inggris (Dasar-Menengah)',
            'interest_tech' => 'Pengembangan Web (Laravel & PHP), Database MySQL, REST API, serta Desain UI/UX.',
            'career_objective' => 'Menjadi pengusaha di bidang IT ataupun bidang lainnya.',
            'education_history' => "• SMKN 2 Banjarmasin - Rekayasa Perangkat Lunak / PPLG (2024 - Sekarang)\n• SMP Negeri 14 Banjarmasin (2021 - 2023)",
            'plk_summary' => "• Tim Pengembang Modulia: Pengembangan aplikasi Ulangan Sekolah berbasis web (CBT).\n• Magang Kerja UMB (2 Bulan): Pengelolaan website kampus berbasis WordPress dan dukungan IT.",
            'org_summary' => 'Pengurus Organisasi Siswa Intra Sekolah (OSIS) di SMP Negeri 14 Banjarmasin selama 3 tahun (2021 - 2023).',
            
            // Statistik
            'stat_projects' => '1',
            'stat_experience' => '3+ Tahun',
            'stat_certificates' => '0',
            'stat_satisfaction' => '100%',
            
            // Kontak (Hanya Email, GitHub, Instagram, Lokasi - Tanpa WA & LinkedIn)
            'email' => 'alvinnabilsaputraa3@gmail.com',
            'phone' => '',
            'github' => 'https://github.com/avn20',
            'instagram' => 'https://www.instagram.com/avnns_',
            'linkedin' => '',
            'whatsapp' => '',
            'location' => 'Banjarmasin, Kalimantan Selatan',
        ];

        foreach ($profileData as $key => $val) {
            ProfileSetting::set($key, $val, 'general', 'text');
        }

        // 2. Keahlian / Skills
        Skill::truncate();
        $skills = [
            // Hard Skills
            ['name' => 'HTML', 'category' => 'hard_skill', 'level_name' => 'Mahir', 'percentage' => 90, 'order' => 1],
            ['name' => 'CSS & Tailwind', 'category' => 'hard_skill', 'level_name' => 'Mahir', 'percentage' => 88, 'order' => 2],
            ['name' => 'PHP', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 82, 'order' => 3],
            ['name' => 'Laravel', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 84, 'order' => 4],
            ['name' => 'Filament', 'category' => 'hard_skill', 'level_name' => 'Pemula', 'percentage' => 70, 'order' => 5],
            ['name' => 'MySQL', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 80, 'order' => 6],
            ['name' => 'JavaScript', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 74, 'order' => 7],
            ['name' => 'Git & GitHub', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 80, 'order' => 8],
            ['name' => 'Figma', 'category' => 'hard_skill', 'level_name' => 'Menengah', 'percentage' => 75, 'order' => 9],

            // Soft Skills
            ['name' => 'Problem Solving', 'category' => 'soft_skill', 'level_name' => 'Mahir', 'percentage' => 88, 'order' => 1],
            ['name' => 'Kerjasama Tim', 'category' => 'soft_skill', 'level_name' => 'Mahir', 'percentage' => 92, 'order' => 2],
            ['name' => 'Tanggung Jawab', 'category' => 'soft_skill', 'level_name' => 'Mahir', 'percentage' => 90, 'order' => 3],
            ['name' => 'Kemauan Belajar', 'category' => 'soft_skill', 'level_name' => 'Mahir', 'percentage' => 95, 'order' => 4],
            ['name' => 'Manajemen Waktu', 'category' => 'soft_skill', 'level_name' => 'Menengah', 'percentage' => 85, 'order' => 5],
        ];

        foreach ($skills as $s) {
            Skill::create($s);
        }

        // 3. Proyek Unggulan (Termasuk Nasi Katsu / MBG Lomba Jagoan Hosting, ICRP, Portofolio, Ulangan SD, Web Sekolah, Media)
        Project::truncate();

        Project::create([
            'id' => 1,
            'title' => 'Ulangan Sekolah SDN TELUK DALAM 3',
            'category' => 'Sistem Ujian CBT Online',
            'description' => 'Aplikasi Computer-Based Test (CBT) dan sistem manajemen ulangan sekolah terintegrasi untuk siswa dan guru SDN Teluk Dalam 3 Banjarmasin, dikembangkan bersama tim Modulia.',
            'image' => 'assets/img/proyek_ulangan.png',
            'link' => 'https://sdntd3.nerct.dpdns.org',
            'problem_statement' => 'Proses ulangan sebelumnya masih menggunakan lembar kertas fisik, menyebabkan pemeriksaan hasil ulangan memakan waktu berhari-hari, rawan kesalahan hitung nilai, dan boros biaya pencetakan kertas.',
            'project_objective' => 'Menyediakan aplikasi ujian online yang ringan, aman dari kecurangan, serta otomatis mengkoreksi dan merekap nilai siswa dalam format siap pakai bagi dewan guru.',
            'tech_stack' => 'Laravel, Tailwind CSS, MySQL, JavaScript',
            'role' => 'Full-Stack Developer (Modulia Team)',
            'features' => "• Modul Manajemen Bank Soal (Pilihan Ganda & Isian)\n• Sesi Ujian Siswa dengan Timer Otomatis\n• Rekapitulasi Nilai Ulangan Instan\n• Ekspor Nilai ke Format Excel / Raport\n• Antarmuka Ringan Ramah Smartphone Siswa",
            'demo_url' => 'https://sdntd3.nerct.dpdns.org',
            'github_url' => 'https://github.com/yowRiss/ulangan-sd',
            'process_flow' => "1. Wawancara langsung kebutuhan ujian sekolah dengan kepala sekolah & bapak/ibu guru.\n2. Perancangan skema database bank soal dan tabel relasi nilai di MySQL.\n3. Pembuatan tampilan pengerjaan soal siswa yang bersih dan bebas gangguan.\n4. Integrasi timer ujian otomatis dan sistem penyimpanan jawaban berkala.\n5. Simulasi ujian bersama dan pelatihan teknis penggunaan untuk guru.",
            'user_feedback' => 'Sangat membantu para guru SDN Teluk Dalam 3 dalam melaksanakan ulangan semester secara tertib, cepat, dan rekap nilai langsung selesai dalam hitungan detik.',
        ]);

        // 4. Sertifikat = 0 (Sesuai Permintaan User)
        Certificate::truncate();

        // 5. Pengalaman Kerja, Organisasi & Lomba (Sesuai Standar KIK UKK Bagian F)
        Experience::truncate();

        Experience::create([
            'type' => 'plk',
            'title' => 'Magang IT / Web Support',
            'organization' => 'Universitas Muhammadiyah Banjarmasin (UMB Banjarmasin)',
            'period' => '2 Bulan',
            'location' => 'Banjarmasin, Kalimantan Selatan',
            'description' => 'Menjalani program magang kerja selama 2 bulan di Universitas Muhammadiyah Banjarmasin (UMB). Bertanggung jawab membantu pemeliharaan sistem informasi kampus, dukungan teknis perangkat lunak, serta mempelajari alur kerja operasional IT di lingkungan perguruan tinggi.',
            'skills_gained' => 'IT Support, Web Maintenance, Komunikasi Kerja, Kerjasama Tim',
            'order' => 1,
        ]);

        Experience::create([
            'type' => 'plk',
            'title' => 'Full-Stack Developer (Proyek Ulangan Sekolah)',
            'organization' => 'Tim Pengembang Modulia',
            'period' => '2024 - Sekarang',
            'location' => 'Banjarmasin',
            'description' => 'Bekerja bersama tim Modulia sebagai Full-Stack Developer dalam merancang, membangun, dan mengelola aplikasi Ulangan Sekolah berbasis web (CBT) untuk SDN Teluk Dalam 3. Menangani integrasi database bank soal, fitur penilaian otomatis, dan dukungan teknis selama ujian berlangsung.',
            'skills_gained' => 'Laravel, MySQL, Tailwind CSS, Team Collaboration',
            'order' => 2,
        ]);

        Experience::create([
            'type' => 'lomba',
            'title' => 'Pengembang Web - Lomba Jagoan Hosting',
            'organization' => 'Kompetisi Web Development Jagoan Hosting',
            'period' => '2026',
            'location' => 'Nasional / Online',
            'description' => 'Berpartisipasi dalam kompetisi pengembangan website tingkat nasional yang diadakan oleh Jagoan Hosting. Mengembangkan aplikasi web Nasi Katsu (MBG - Makan Bergizi Gratis) bersama tim untuk solusi pemesanan dan penyaluran katering yang cepat dan responsif.',
            'skills_gained' => 'Web Development, Speed Optimization, Deployment Cloud Hosting, Teamwork',
            'order' => 3,
        ]);

        Experience::create([
            'type' => 'organisasi',
            'title' => 'Pengurus Organisasi Siswa Intra Sekolah (OSIS)',
            'organization' => 'SMP Negeri 14 Banjarmasin',
            'period' => '3 Tahun (2021 - 2023)',
            'location' => 'Banjarmasin',
            'description' => 'Aktif berkontribusi sebagai pengurus OSIS di SMP Negeri 14 Banjarmasin selama 3 tahun (2021 - 2023). Terlibat langsung dalam kepanitiaan berbagai kegiatan kesiswaan, koordinasi antar kelas, dan melatih kemampuan kepemimpinan serta kedisiplinan berorganisasi.',
            'skills_gained' => 'Kepemimpinan, Manajemen Acara, Komunikasi Publik, Kerjasama Tim',
            'order' => 4,
        ]);

        // 6. Testimoni (Hanya Bapak Putra & Bapak Sincung sesuai teks asli saat mereka mengisi sendiri)
        Testimonial::truncate();

        Testimonial::create([
            'id' => 1,
            'name' => 'M RIDHA PUTRA KESUMA, S.PD',
            'role' => 'Guru Produktif PPLG SMKN 2 Banjarmasin',
            'category' => 'Guru Pembimbing',
            'content' => 'Terampil dalam problem solving dan sikap tanggung jawab dalam project dan tim yang baik, lebih banyak explore dan coba teknologi baru dan perkembangan teknologi terkini, jos gandosss ;D',
            'rating' => 5,
            'is_approved' => true,
        ]);

        Testimonial::create([
            'id' => 2,
            'name' => 'Sincung Firdaus, S.Kom.',
            'role' => 'Guru Produktif PPLG SMKN 2 Banjarmasin',
            'category' => 'Guru Pembimbing',
            'content' => 'Program berjalan dengan baik, front end dan Backendnya berfungsi dan tampilan cukup bagus, tinggal perpaduan warna dan dashboard msh agak kaku.',
            'rating' => 5,
            'is_approved' => true,
        ]);

        // 7. Blog / Pengalaman Magang (Hanya artikel magang UMB)
        Blog::truncate();

        Blog::create([
            'title' => 'Pengalaman Magang 2 Bulan di Universitas Muhammadiyah Banjarmasin (UMB)',
            'slug' => 'pengalaman-magang-umb-banjarmasin',
            'category' => 'Pengalaman Magang',
            'summary' => 'Cerita magang 2 bulan di UMB: mengelola website kampus dengan WordPress, berkolaborasi dalam proyek bersama rekan magang, bimbingan mentor yang baik, serta mempelajari bahasa Ruby on Rails.',
            'content' => "Menjalani masa magang selama 2 bulan di Universitas Muhammadiyah Banjarmasin (UMB) merupakan pengalaman nyata yang sangat berharga dalam memperluas wawasan dan keterampilan saya di dunia teknologi informasi.

### 1. Pengelolaan Website Kampus dengan WordPress
Salah satu tanggung jawab utama saya adalah membantu pemeliharaan dan pengelolaan website resmi kampus berbasis CMS WordPress. Dari tugas ini, saya belajar bagaimana mempublikasikan informasi akademik, menata tata letak halaman yang rapi dan responsif, serta memastikan website tetap berjalan lancar untuk diakses publik.

### 2. Kolaborasi Proyek Bersama Teman Magang
Selama magang, saya berkesempatan mengerjakan penugasan proyek bersama rekan sesama peserta magang. Kami berbagi tugas, saling berdiskusi memecahkan kendala teknis, dan belajar bagaimana menyelaraskan hasil kerja agar proyek selesai tepat waktu.

### 3. Bertemu Mentor yang Baik & Membimbing
Di UMB, kami dibimbing oleh mentor yang sangat baik, ramah, dan berpengalaman. Beliau selalu sabar memberikan arahan ketika kami menemui kesulitan serta memotivasi kami untuk berani bereksplorasi mencari solusi terbaik.

### 4. Mengenal Bahasa Pemrograman Baru: Ruby on Rails
Momen menarik lainnya selama magang adalah kesempatan mempelajari bahasa pemrograman dan framework baru, yaitu **Ruby on Rails**. Memahami arsitektur MVC di Ruby on Rails memberikan wawasan baru yang memperkaya pemahaman saya tentang ekosistem pengembangan web modern di luar ekosistem PHP dan Laravel.

Pengalaman 2 bulan di UMB Banjarmasin ini menjadi bekal yang sangat berharga dalam melatih etika kerja profesional, kerjasama tim, dan antusiasme untuk terus belajar hal baru.",
            'image' => null,
            'tags' => 'Magang, UMB Banjarmasin, WordPress, Ruby on Rails, Pengalaman Kerja',
            'read_time' => '3 menit',
            'is_published' => true,
            'order' => 1,
        ]);

        // 8. Pesan Masuk
        Message::truncate();
        Message::create([
            'name' => 'Bapak Penguji UKK RPL',
            'email' => 'penguji.ukk@smk.sch.id',
            'category' => 'Kesan Penguji / Guru',
            'message' => 'Portofolio Alvin sangat bagus, rapi, dan sesuai dengan pengalaman nyata di sekolah, tim Modulia, dan tempat magang!',
            'is_read' => false,
        ]);
    }
}
