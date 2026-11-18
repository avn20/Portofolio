<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae (CV) - {{ $profile['full_name'] ?? 'Alvin Nabil Saputra' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .cv-container {
                border: none !important;
                box-shadow: none !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-100 px-4 py-8 text-zinc-900 antialiased sm:px-6">
    <!-- Top Bar Navigation (Hidden in Print) -->
    <div class="no-print mx-auto mb-6 flex max-w-4xl items-center justify-between border-b border-zinc-300 pb-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wider text-zinc-600 transition hover:text-zinc-900">
            <span>← Kembali ke Portofolio</span>
        </a>

        <div class="flex items-center gap-2">
            <button
                type="button"
                onclick="window.print()"
                class="inline-flex items-center gap-2 rounded-lg bg-zinc-900 px-4 py-2 text-xs font-bold text-white transition hover:bg-zinc-800 shadow"
            >
                <span>🖨️</span>
                <span>Cetak / Download PDF</span>
            </button>
        </div>
    </div>

    <!-- CV Paper Container (Clean White Resume Layout) -->
    <div class="cv-container mx-auto max-w-4xl rounded-2xl border border-zinc-200 bg-white p-8 text-zinc-900 shadow-xl sm:p-12">
        <!-- Header Profil CV -->
        <header class="flex flex-col-reverse gap-6 border-b-2 border-zinc-900 pb-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-zinc-900 sm:text-4xl">
                    {{ $profile['full_name'] ?? 'Alvin Nabil Saputra' }}
                </h1>
                <p class="mt-1.5 text-base font-bold text-emerald-700">
                    {{ $profile['hero_role'] ?? 'Junior Full-Stack Web Developer' }}
                </p>
                @php
                    $cvClassMajor = array_key_exists('class_major', $profile) ? $profile['class_major'] : 'Siswa Kelas XII RPL';
                    $cvSchoolName = array_key_exists('school_name', $profile) ? $profile['school_name'] : 'SMKN 2 Banjarmasin';
                    $cvSub = array_filter([trim($cvClassMajor ?? ''), trim($cvSchoolName ?? '')]);
                @endphp
                @if (!empty($cvSub))
                    <p class="mt-1 text-xs text-zinc-600">
                        {{ implode(' • ', $cvSub) }}
                    </p>
                @endif

                <!-- Kontak Bersih: Email, GitHub, Instagram, Lokasi -->
                <div class="mt-4 flex flex-wrap gap-y-1.5 gap-x-4 text-xs text-zinc-600">
                    <span class="inline-flex items-center gap-1">
                        <strong>✉</strong> {{ $profile['email'] ?? 'alvinnabilsaputraa3@gmail.com' }}
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <strong>📍</strong> {{ $profile['location'] ?? 'Banjarmasin, Indonesia' }}
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <strong>🌐</strong> github.com/avn20
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <strong>📷</strong> @avnns20
                    </span>
                </div>
            </div>

            <div class="shrink-0">
                <img
                    src="{{ asset('assets/img/me.jpg') }}"
                    alt="{{ $profile['full_name'] ?? 'Alvin Nabil' }}"
                    class="h-28 w-28 rounded-xl object-cover border-2 border-zinc-200 shadow-sm"
                >
            </div>
        </header>

        <!-- Ringkasan Profil -->
        <section class="mt-6 border-b border-zinc-200 pb-6">
            <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-900">Tentang Saya / Profil Singkat</h2>
            <p class="mt-2 text-xs leading-6 text-zinc-700">
                {{ $profile['about_bio'] ?? 'Halo! Saya Alvin Nabil Saputra, seorang Full-Stack Web Developer. Saya berfokus pada pengembangan aplikasi web yang fungsional, arsitektur database, dan antarmuka pengguna yang bersih serta mudah digunakan.' }}
            </p>
            <div class="mt-3 flex flex-wrap gap-2 text-xs text-zinc-600">
                @if (!empty(trim($profile['spoken_languages'] ?? '')))
                    <span><strong>Bahasa:</strong> {{ $profile['spoken_languages'] }}</span>
                @endif
                @if (!empty(trim($profile['spoken_languages'] ?? '')) && !empty(trim($profile['interest_tech'] ?? '')))
                    <span>•</span>
                @endif
                @if (!empty(trim($profile['interest_tech'] ?? '')))
                    <span><strong>Minat:</strong> {{ $profile['interest_tech'] }}</span>
                @endif
            </div>
        </section>

        <!-- Pendidikan (Hanya jika diisi di admin) -->
        @php
            $rawCvEdu = array_key_exists('education_history', $profile)
                ? $profile['education_history']
                : "• SMKN 2 Banjarmasin - Rekayasa Perangkat Lunak (2024 - Sekarang)\n• SMP Negeri 14 Banjarmasin (2021 - 2023)";
            $cvEduLines = !empty(trim($rawCvEdu ?? ''))
                ? array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $rawCvEdu)))
                : [];
        @endphp
        @if (!empty($cvEduLines))
            <section class="mt-6 border-b border-zinc-200 pb-6">
                <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-900">Riwayat Pendidikan</h2>
                <div class="mt-3 space-y-2">
                    @foreach ($cvEduLines as $line)
                        <p class="text-xs text-zinc-800">
                            <strong>•</strong> {{ ltrim($line, "•- \t") }}
                        </p>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Pengalaman Nyata: Tim Modulia, Magang UMB, OSIS SMPN 14 -->
        <section class="mt-6 border-b border-zinc-200 pb-6">
            <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-900">Pengalaman Kerja & Organisasi</h2>
            <div class="mt-4 space-y-4">
                @foreach ($experiencesPlk as $plk)
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-bold text-zinc-900">{{ $plk->title }}</h3>
                                <p class="text-xs font-semibold text-emerald-700">{{ $plk->organization }}</p>
                            </div>
                            <span class="text-xs font-semibold text-zinc-500">{{ $plk->period }}</span>
                        </div>
                        <p class="mt-1 text-xs leading-5 text-zinc-600">{{ $plk->description }}</p>
                        @if ($plk->skills_gained)
                            <p class="mt-1 text-[11px] text-zinc-500"><strong>Keahlian:</strong> {{ $plk->skills_gained }}</p>
                        @endif
                    </div>
                @endforeach

                @foreach ($experiencesOrg as $org)
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-bold text-zinc-900">{{ $org->title }}</h3>
                                <p class="text-xs font-semibold text-sky-700">{{ $org->organization }}</p>
                            </div>
                            <span class="text-xs font-semibold text-zinc-500">{{ $org->period }}</span>
                        </div>
                        <p class="mt-1 text-xs leading-5 text-zinc-600">{{ $org->description }}</p>
                        @if ($org->skills_gained)
                            <p class="mt-1 text-[11px] text-zinc-500"><strong>Keahlian:</strong> {{ $org->skills_gained }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Keahlian (Hard Skills & Soft Skills) -->
        <section class="mt-6 border-b border-zinc-200 pb-6">
            <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-900">Keahlian & Kemampuan</h2>
            <div class="mt-3 grid gap-4 sm:grid-cols-2">
                <div>
                    <h3 class="text-xs font-bold text-zinc-800">Hard Skills (Teknis):</h3>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach ($hardSkills as $hs)
                            <span class="rounded bg-zinc-100 border border-zinc-200 px-2 py-0.5 text-[11px] font-medium text-zinc-800">
                                {{ $hs->name }} ({{ $hs->percentage }}%)
                            </span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-zinc-800">Soft Skills (Non-Teknis):</h3>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach ($softSkills as $ss)
                            <span class="rounded bg-zinc-100 border border-zinc-200 px-2 py-0.5 text-[11px] font-medium text-zinc-800">
                                {{ $ss->name }} ({{ $ss->percentage }}%)
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Proyek Unggulan (3 Proyek Asli Alvin) -->
        <section class="mt-6">
            <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-900">Proyek Unggulan</h2>
            <div class="mt-3 space-y-3">
                @foreach ($projects as $proj)
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold text-zinc-900">{{ $proj->title }}</h3>
                            <span class="text-[11px] text-zinc-500">{{ $proj->tech_stack }}</span>
                        </div>
                        <p class="mt-0.5 text-xs text-zinc-600">{{ $proj->description }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</body>
</html>
