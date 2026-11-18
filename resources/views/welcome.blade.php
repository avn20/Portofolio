<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['full_name'] ?? 'Alvin Nabil Saputra' }} | Portfolio Web Developer</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#10b981',
                            600: '#059669',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes soft-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .soft-float {
            animation: soft-float 6s ease-in-out infinite;
        }

        /* Scroll reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0;
            height: 2px;
            content: "";
            background: currentColor;
            transition: width 220ms ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(150, 150, 150, 0.35);
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(150, 150, 150, 0.55);
        }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 transition-colors duration-300 dark:bg-black dark:text-white antialiased selection:bg-emerald-500 selection:text-white">
    @php
        $copy = __('portfolio');
        $heroRole = app()->getLocale() === 'en' 
            ? $copy['hero']['role'] 
            : ($profile['hero_role'] ?? $copy['hero']['role']);
        $fullName = $profile['full_name'] ?? 'Alvin Nabil Saputra';
        $classMajor = array_key_exists('class_major', $profile)
            ? $profile['class_major']
            : ($copy['hero']['class_major'] ?? 'Kelas XII - Rekayasa Perangkat Lunak (PPLG)');
        $schoolName = array_key_exists('school_name', $profile)
            ? $profile['school_name']
            : 'SMKN 2 Banjarmasin';
        $branding = $profile['personal_branding'] ?? $copy['hero']['description'];
    @endphp

    <!-- ============================================== -->
    <!-- HEADER & NAVBAR (BERSIH, RAPI, MODERN)        -->
    <!-- ============================================== -->
    <header class="sticky top-0 z-50 border-b border-zinc-200/80 bg-white/80 dark:border-white/10 dark:bg-black/80 backdrop-blur transition-colors duration-300">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-5 py-3.5">
            <!-- Brand Logo (Clean Modern Developer Brand) -->
            <a href="#beranda" class="group flex items-center gap-2.5 transition">
                <span class="flex h-8.5 w-8.5 items-center justify-center rounded-lg border border-zinc-200/90 bg-zinc-100 text-zinc-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-400 font-mono text-xs font-bold shadow-xs transition duration-300 group-hover:scale-105 group-hover:border-emerald-500">
                    &lt;/&gt;
                </span>
                <div class="flex flex-col -space-y-0.5">
                    <span class="text-sm font-bold tracking-tight text-zinc-900 dark:text-white leading-tight">
                        My<span class="text-emerald-600 dark:text-emerald-400 font-medium">Portfolio</span>
                    </span>
                    <span class="text-[10px] font-medium tracking-wide text-zinc-500 dark:text-white/45">Full-Stack Developer</span>
                </div>
            </a>

            <!-- Desktop Navigation Links (Rapi & Tidak Penuh) -->
            <div class="hidden items-center gap-7 text-xs font-semibold uppercase tracking-[0.14em] text-zinc-600 dark:text-white/60 md:flex">
                <a href="#beranda" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['home'] }}</a>
                <a href="#tentang" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['about'] }}</a>
                <a href="#keahlian" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['skills'] }}</a>
                <a href="#proyek" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['projects'] }}</a>
                <a href="#pengalaman" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['experience'] }}</a>
                <a href="#testimoni" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['testimonials'] }}</a>
                <a href="#kontak" class="nav-link transition hover:text-zinc-900 dark:hover:text-white">{{ $copy['nav']['contact'] }}</a>
            </div>

            <!-- Controls (Theme Toggle & Language Switcher) -->
            <div class="flex items-center gap-2.5">
                <!-- Theme Toggle Button (Dark / Light) - Perfectly Circular & Micro-animated -->
                <button
                    type="button"
                    onclick="toggleThemeMode()"
                    id="theme-switcher-btn"
                    class="group relative inline-flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-full border border-zinc-300/80 bg-zinc-100/90 text-zinc-700 shadow-xs transition-all duration-300 hover:scale-105 hover:border-emerald-500 hover:text-emerald-600 active:scale-95 dark:border-white/15 dark:bg-white/10 dark:text-amber-300 dark:hover:border-amber-400/50 dark:hover:bg-white/15"
                    title="Ganti Mode Gelap / Terang"
                    aria-label="Toggle Dark/Light Mode"
                >
                    <span id="theme-icon-sun" class="hidden transition-transform duration-500 group-hover:rotate-45">
                        <svg class="h-4 w-4 sm:h-4.5 sm:w-4.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                    <span id="theme-icon-moon" class="block transition-transform duration-500 group-hover:-rotate-12">
                        <svg class="h-4 w-4 sm:h-4.5 sm:w-4.5 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </span>
                </button>

                <!-- Language Switcher -->
                <div class="flex items-center gap-1 rounded-full border border-zinc-200 bg-zinc-100 p-1 text-[11px] font-semibold dark:border-white/15 dark:bg-white/5" aria-label="{{ $copy['nav']['language'] }}">
                    @foreach (['en' => 'EN', 'id' => 'ID'] as $locale => $label)
                        <a
                            href="{{ route('locale.switch', $locale) }}"
                            @if (app()->getLocale() === $locale) aria-current="true" @endif
                            class="rounded-full px-2 py-0.5 tracking-wider transition {{ app()->getLocale() === $locale ? 'bg-white text-zinc-900 shadow-sm dark:bg-white dark:text-black font-bold' : 'text-zinc-500 hover:text-zinc-900 dark:text-white/50 dark:hover:text-white' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <!-- Mobile Hamburger Button -->
                <button
                    type="button"
                    onclick="document.getElementById('mobile-drawer').classList.toggle('hidden')"
                    class="rounded-lg border border-zinc-200 p-2 text-zinc-700 transition hover:bg-zinc-100 dark:border-white/15 dark:text-white/70 dark:hover:bg-white/10 md:hidden"
                    aria-label="Menu"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-drawer" class="hidden border-t border-zinc-200 bg-white/95 px-5 py-5 text-sm font-semibold uppercase tracking-wider text-zinc-700 dark:border-white/10 dark:bg-black/95 dark:text-white/70 md:hidden shadow-lg">
            <div class="flex flex-col gap-3">
                <a href="#beranda" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['home'] }}</a>
                <a href="#tentang" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['about'] }}</a>
                <a href="#keahlian" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['skills'] }}</a>
                <a href="#proyek" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['projects'] }}</a>
                <a href="#pengalaman" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['experience'] }}</a>
                <a href="#testimoni" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['testimonials'] }}</a>
                <a href="#kontak" onclick="document.getElementById('mobile-drawer').classList.add('hidden')" class="hover:text-zinc-900 dark:hover:text-white py-1">{{ $copy['nav']['contact'] }}</a>
                <a href="{{ route('cv.digital') }}" target="_blank" class="text-emerald-600 dark:text-emerald-400 font-bold py-1">📄 Lihat CV Digital</a>
            </div>
        </div>
    </header>

    <main>
        <!-- ============================================== -->
        <!-- A. HALAMAN BERANDA (HERO SECTION) — WAJIB      -->
        <!-- ============================================== -->
        <section id="beranda" class="relative overflow-hidden border-b border-zinc-200 dark:border-white/10">
            <!-- Ambient Glow Background Effects -->
            <div class="pointer-events-none absolute -top-24 right-1/4 -z-10 h-72 w-72 sm:h-96 sm:w-96 rounded-full bg-emerald-500/10 blur-3xl filter dark:bg-emerald-500/15"></div>
            <div class="pointer-events-none absolute top-1/2 -left-20 -z-10 h-64 w-64 sm:h-80 sm:w-80 rounded-full bg-sky-500/10 blur-3xl filter dark:bg-sky-500/10"></div>

            <div class="mx-auto grid min-h-[calc(100vh-73px)] max-w-6xl items-center gap-12 px-5 py-14 md:grid-cols-[1.1fr_0.9fr] md:py-20">
                <div>
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ $copy['hero']['status_badge'] }}</span>
                    </div>

                    <!-- Eyebrow -->
                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">
                        {{ $copy['hero']['eyebrow'] }}
                    </p>

                    <!-- Nama Lengkap -->
                    <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl lg:text-6xl">
                        {{ $fullName }}
                    </h1>

                    <!-- Kelas dan Kompetensi Keahlian (Hanya jika diisi di admin) -->
                    @php
                        $heroSubtitleParts = array_filter([
                            trim($classMajor),
                            trim($schoolName)
                        ]);
                    @endphp
                    @if (!empty($heroSubtitleParts))
                        <div class="mt-3 flex flex-wrap items-center gap-2 text-sm sm:text-base font-semibold text-emerald-700 dark:text-emerald-400">
                            {!! implode(' <span class="text-zinc-400 dark:text-white/40">•</span> ', array_map('e', $heroSubtitleParts)) !!}
                        </div>
                    @endif

                    <!-- Role Headline -->
                    <h2 class="mt-3 text-lg font-medium text-zinc-700 dark:text-white/80 sm:text-xl">
                        {{ $heroRole }}
                    </h2>

                    <!-- Deskripsi Singkat / Personal Branding -->
                    <p class="mt-4 max-w-xl text-sm leading-7 text-zinc-600 dark:text-white/60 sm:text-base">
                        {{ app()->getLocale() === 'en' ? $copy['hero']['description'] : ($profile['personal_branding'] ?? $copy['hero']['description']) }}
                    </p>

                    <!-- Keahlian Utama (Highlight Chips - Hanya jika diisi di admin) -->
                    @php
                        $rawCoreSkills = array_key_exists('core_skills', $profile)
                            ? $profile['core_skills']
                            : 'Laravel, PHP, Tailwind CSS, MySQL, JavaScript, Git, Figma';
                    @endphp
                    @if (!empty(trim($rawCoreSkills ?? '')))
                        <div class="mt-6 flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-white/40">{{ $copy['hero']['core_skills_label'] }}</span>
                            @php
                                $coreSkillsList = array_filter(array_map('trim', explode(',', $rawCoreSkills)));
                            @endphp
                            @foreach ($coreSkillsList as $cs)
                                <span class="rounded-md border border-zinc-200 bg-white px-2.5 py-1 text-xs font-semibold text-zinc-800 dark:border-white/10 dark:bg-white/5 dark:text-white/80 shadow-xs">
                                    {{ $cs }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- 3 Tombol Utama KIK UKK: Lihat Portfolio, Lihat CV, Hubungi Saya -->
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <!-- Button 1: Lihat Portfolio -->
                        <a href="#proyek" class="group inline-flex items-center gap-2 rounded-xl bg-zinc-900 px-5 py-3 text-sm font-bold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-zinc-800 dark:bg-white dark:text-black dark:hover:bg-white/85 shadow-md">
                            <span>{{ $copy['hero']['projects_button'] }}</span>
                            <span class="transition duration-300 group-hover:translate-x-1">→</span>
                        </a>

                        <!-- Button 2: Lihat CV -->
                        <button
                            type="button"
                            onclick="document.getElementById('modal-cv-digital').classList.remove('hidden')"
                            class="group inline-flex items-center gap-2 rounded-xl border border-emerald-500/40 bg-emerald-500/10 px-5 py-3 text-sm font-bold text-emerald-700 dark:text-emerald-300 transition duration-300 hover:-translate-y-0.5 hover:bg-emerald-500/20"
                        >
                            <span>📄 {{ $copy['hero']['cv_button'] ?? 'Lihat CV' }}</span>
                        </button>

                        <!-- Button 3: Hubungi Saya -->
                        <a href="#kontak" class="group inline-flex items-center gap-2 rounded-xl border border-zinc-300 bg-white px-5 py-3 text-sm font-bold text-zinc-800 transition duration-300 hover:-translate-y-0.5 hover:border-zinc-500 dark:border-white/20 dark:bg-transparent dark:text-white dark:hover:border-white dark:hover:bg-white/10">
                            <span>{{ $copy['hero']['contact_button'] }}</span>
                            <span class="transition duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </div>
                </div>

                <!-- Foto Profil / Avatar (Bersih & Rapi Tanpa Card Menutupi Foto) -->
                <div class="soft-float group relative mx-auto w-full max-w-sm sm:max-w-md">
                    <div class="aspect-[4/5] overflow-hidden rounded-2xl border border-zinc-200 bg-white p-2 shadow-xl dark:border-white/15 dark:bg-white/5 transition duration-500 group-hover:border-zinc-400 dark:group-hover:border-white/40">
                        @php
                            $heroAvatar = !empty($profile['avatar_image'])
                                ? (str_starts_with($profile['avatar_image'], 'assets/') ? asset($profile['avatar_image']) : asset('storage/' . $profile['avatar_image']))
                                : asset('assets/img/me.jpg');
                        @endphp
                        <img
                            src="{{ $heroAvatar }}"
                            alt="{{ $copy['hero']['photo_alt'] }}"
                            class="h-full w-full rounded-xl object-cover object-center grayscale contrast-105 transition duration-700 group-hover:scale-105 group-hover:grayscale-0"
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- B. TENTANG SAYA / ABOUT ME — WAJIB             -->
        <!-- ============================================== -->
        <section id="tentang" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="grid gap-12 md:grid-cols-[0.85fr_1.15fr]">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['about']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                            {{ $copy['about']['title'] }}
                        </h2>
                        <p class="mt-4 text-sm leading-7 text-zinc-600 dark:text-white/70">
                            {{ $profile['about_bio'] ?? $copy['about']['description'] }}
                        </p>

                        <!-- Counter Statistik Ringkas & Minimalis (Lebih kecil, rapi, dan proporsional) -->
                        <div class="mt-6 grid grid-cols-3 gap-2.5">
                            <div class="rounded-xl border border-zinc-200/70 bg-zinc-50/60 p-2.5 text-center transition hover:border-zinc-300 dark:border-white/10 dark:bg-white/[0.02] dark:hover:border-white/20 shadow-2xs">
                                <p class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $projects->count() }}</p>
                                <p class="mt-0.5 text-[10px] font-semibold text-zinc-500 dark:text-white/45 uppercase tracking-wider">{{ $copy['about']['stat_projects'] }}</p>
                            </div>
                            <div class="rounded-xl border border-zinc-200/70 bg-zinc-50/60 p-2.5 text-center transition hover:border-zinc-300 dark:border-white/10 dark:bg-white/[0.02] dark:hover:border-white/20 shadow-2xs">
                                <p class="text-xl sm:text-2xl font-bold tracking-tight text-emerald-600 dark:text-emerald-400">Full-Stack</p>
                                <p class="mt-0.5 text-[10px] font-semibold text-zinc-500 dark:text-white/45 uppercase tracking-wider">{{ $copy['about']['stat_focus'] }}</p>
                            </div>
                            <div class="rounded-xl border border-zinc-200/70 bg-zinc-50/60 p-2.5 text-center transition hover:border-zinc-300 dark:border-white/10 dark:bg-white/[0.02] dark:hover:border-white/20 shadow-2xs">
                                <p class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $copy['about']['stat_internship_val'] }}</p>
                                <p class="mt-0.5 text-[10px] font-semibold text-zinc-500 dark:text-white/45 uppercase tracking-wider">{{ $copy['about']['stat_internship'] }}</p>
                            </div>
                        </div>

                        <!-- Biodata Singkat -->
                        <div class="mt-8 space-y-3 rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.02] p-5 text-xs sm:text-sm shadow-sm dark:shadow-none">
                            <div class="flex justify-between border-b border-zinc-100 dark:border-white/5 pb-2">
                                <span class="font-semibold text-zinc-500 dark:text-white/50">{{ $copy['about']['status'] }}:</span>
                                <span class="text-zinc-900 dark:text-white font-medium">{{ $copy['about']['status_value'] }}</span>
                            </div>
                            <div class="flex justify-between border-b border-zinc-100 dark:border-white/5 pb-2">
                                <span class="font-semibold text-zinc-500 dark:text-white/50">{{ $copy['about']['location'] }}:</span>
                                <span class="text-zinc-900 dark:text-white font-medium">{{ $copy['about']['location_value'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-zinc-500 dark:text-white/50">{{ $copy['about']['languages'] }}:</span>
                                <span class="text-zinc-900 dark:text-white font-medium">{{ $copy['about']['languages_value'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Pendidikan, Minat, Pengalaman, Cita-cita -->
                    <div class="space-y-5">
                        <!-- Riwayat Pendidikan (Hanya jika diisi di admin) -->
                        @php
                            $rawEdu = array_key_exists('education_history', $profile)
                                ? $profile['education_history']
                                : "• SMKN 2 Banjarmasin - Rekayasa Perangkat Lunak / PPLG (2024 - Sekarang)\n• SMP Negeri 14 Banjarmasin (2021 - 2023)";
                            $eduLines = !empty(trim($rawEdu ?? ''))
                                ? array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $rawEdu)))
                                : [];
                        @endphp
                        @if (!empty($eduLines))
                            <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.02] p-6 shadow-sm dark:shadow-none">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">🎓</span>
                                    <h3 class="text-base font-bold text-zinc-900 dark:text-white">{{ $copy['about']['education_title'] ?? 'Riwayat Pendidikan' }}</h3>
                                </div>
                                <div class="mt-4 space-y-3 border-l-2 border-emerald-500/50 pl-4 text-xs sm:text-sm">
                                    @foreach ($eduLines as $eduLine)
                                        <p class="font-medium text-zinc-800 dark:text-white/90">{{ ltrim($eduLine, "•- \t") }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Pengalaman Kerja & Magang (Hanya jika diisi di admin) -->
                        @php
                            $rawPlk = array_key_exists('plk_summary', $profile) ? $profile['plk_summary'] : null;
                            $plkLines = !empty(trim($rawPlk ?? ''))
                                ? array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $rawPlk)))
                                : [];
                        @endphp
                        @if (!empty($plkLines))
                            <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.02] p-6 shadow-sm dark:shadow-none">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">🏢</span>
                                    <h3 class="text-base font-bold text-zinc-900 dark:text-white">{{ $copy['about']['plk_title'] ?? 'Pengalaman Kerja & Magang' }}</h3>
                                </div>
                                <div class="mt-3 space-y-2 text-xs sm:text-sm leading-6 text-zinc-600 dark:text-white/70">
                                    @foreach ($plkLines as $plkLine)
                                        <p>• {{ ltrim($plkLine, "•- \t") }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Minat dan Bidang Teknologi (Hanya jika diisi di admin) -->
                        @php
                            $rawInterests = array_key_exists('interest_tech', $profile)
                                ? $profile['interest_tech']
                                : $copy['about']['interests_value'];
                        @endphp
                        @if (!empty(trim($rawInterests ?? '')))
                            <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.02] p-6 shadow-sm dark:shadow-none">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">💡</span>
                                    <h3 class="text-base font-bold text-zinc-900 dark:text-white">{{ $copy['about']['interests_title'] ?? 'Minat & Bidang Teknologi' }}</h3>
                                </div>
                                <p class="mt-2 text-xs leading-6 text-zinc-600 dark:text-white/70 sm:text-sm">
                                    {{ $rawInterests }}
                                </p>
                            </div>
                        @endif

                        <!-- Cita-Cita / Tujuan Karir (Hanya jika diisi di admin) -->
                        @php
                            $rawCareer = array_key_exists('career_objective', $profile)
                                ? $profile['career_objective']
                                : $copy['about']['career_value'];
                        @endphp
                        @if (!empty(trim($rawCareer ?? '')))
                            <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.02] p-6 shadow-sm dark:shadow-none">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">🎯</span>
                                    <h3 class="text-base font-bold text-zinc-900 dark:text-white">{{ $copy['about']['career_title'] ?? 'Cita-Cita / Tujuan Karir' }}</h3>
                                </div>
                                <p class="mt-2 text-xs leading-6 text-zinc-600 dark:text-white/70 sm:text-sm">
                                    {{ $rawCareer }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- C. KEAHLIAN / SKILLS — WAJIB                   -->
        <!-- ============================================== -->
        <section id="keahlian" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['skills']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['skills']['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-white/60">
                            {{ $copy['skills']['description'] }}
                        </p>
                    </div>

                    <!-- Tab Switcher Hard Skills / Soft Skills -->
                    <div class="flex rounded-xl border border-zinc-200 bg-zinc-100 p-1 text-xs font-bold dark:border-white/15 dark:bg-white/5">
                        <button
                            type="button"
                            onclick="switchSkillsTab('all')"
                            id="btn-skill-all"
                            class="rounded-lg px-3.5 py-2 transition bg-white text-zinc-900 shadow-xs dark:bg-white dark:text-black font-bold"
                        >
                            {{ $copy['skills']['all_tab'] }}
                        </button>
                        <button
                            type="button"
                            onclick="switchSkillsTab('hard')"
                            id="btn-skill-hard"
                            class="rounded-lg px-3.5 py-2 transition text-zinc-600 dark:text-white/60 hover:text-zinc-900 dark:hover:text-white"
                        >
                            {{ $copy['skills']['hard_tab'] }}
                        </button>
                        <button
                            type="button"
                            onclick="switchSkillsTab('soft')"
                            id="btn-skill-soft"
                            class="rounded-lg px-3.5 py-2 transition text-zinc-600 dark:text-white/60 hover:text-zinc-900 dark:hover:text-white"
                        >
                            {{ $copy['skills']['soft_tab'] }}
                        </button>
                    </div>
                </div>

                <!-- Hard Skills Grid -->
                <div id="section-hard-skills" class="mt-10">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mb-5 flex items-center gap-2">
                        <span>💻 {{ $copy['skills']['hard_heading'] }}</span>
                    </h3>
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($hardSkills as $skill)
                            <div class="skill-card group rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-zinc-400 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-white/35">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-bold text-zinc-900 dark:text-white">{{ $skill->name }}</h4>
                                    <span class="rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 px-2 py-0.5 text-[11px] font-bold">
                                        {{ $skill->percentage }}%
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-zinc-500 dark:text-white/40">{{ $skill->level_name }}</p>
                                <div class="mt-4 h-2 w-full rounded-full bg-zinc-100 dark:bg-white/10 overflow-hidden">
                                    <div
                                         class="h-full rounded-full bg-emerald-500 dark:bg-emerald-400 transition-all duration-1000"
                                         style="width: {{ $skill->percentage }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Soft Skills Grid -->
                <div id="section-soft-skills" class="mt-10">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400 mb-5 flex items-center gap-2">
                        <span>🤝 {{ $copy['skills']['soft_heading'] }}</span>
                    </h3>
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($softSkills as $skill)
                            <div class="skill-card group rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-zinc-400 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-white/35">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-bold text-zinc-900 dark:text-white">{{ $skill->name }}</h4>
                                    <span class="rounded-full bg-sky-50 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300 px-2 py-0.5 text-[11px] font-bold">
                                        {{ $skill->percentage }}%
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-zinc-500 dark:text-white/40">{{ $skill->level_name }}</p>
                                <div class="mt-4 h-2 w-full rounded-full bg-zinc-100 dark:bg-white/10 overflow-hidden">
                                    <div
                                        class="h-full rounded-full bg-sky-500 dark:bg-sky-400 transition-all duration-1000"
                                        style="width: {{ $skill->percentage }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- D. GALERI PROJEK / MY PROJECT — WAJIB          -->
        <!-- ============================================== -->
        <section id="proyek" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between border-b border-zinc-200 dark:border-white/10 pb-6">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['projects']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['projects']['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-white/60">
                            {{ $copy['projects']['description'] }}
                        </p>
                    </div>

                    <span class="rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-bold text-zinc-800 shadow-xs dark:border-white/20 dark:bg-white/5 dark:text-white/80">
                        {{ __('portfolio.projects.count', ['count' => $projects->count()]) }}
                    </span>
                </div>

                <!-- Projects Grid -->
                <div class="mt-10 {{ $projects->count() === 1 ? 'max-w-2xl' : ($projects->count() === 2 ? 'grid gap-8 md:grid-cols-2' : 'grid gap-8 md:grid-cols-3') }}">
                    @forelse ($projects as $project)
                        <article class="project-card group flex flex-col justify-between overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.03] shadow-sm dark:shadow-none transition duration-300 hover:-translate-y-1 hover:border-zinc-400 dark:hover:border-white/35">
                            <div>
                                <!-- Image Preview (Hanya jika gambar ada) -->
                                @if ($project->image_url)
                                    <div class="relative h-52 w-full overflow-hidden bg-zinc-100 dark:bg-white/5 cursor-pointer" onclick="openProjectModal({{ $project->id }})">
                                        <img
                                            src="{{ $project->image_url }}"
                                            alt="{{ $project->title }}"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                        >
                                        <span class="absolute top-3 left-3 rounded-md bg-zinc-900/80 dark:bg-black/80 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur">
                                            {{ $project->category ?? 'Web Application' }}
                                        </span>
                                    </div>
                                @endif

                                <div class="p-6">
                                    @if (! $project->image_url)
                                        <div class="mb-3">
                                            <span class="inline-block rounded-md bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/70 px-2.5 py-1 text-[11px] font-semibold border border-zinc-200 dark:border-white/10">
                                                {{ $project->category ?? 'Web Application' }}
                                            </span>
                                        </div>
                                    @endif

                                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition cursor-pointer" onclick="openProjectModal({{ $project->id }})">
                                        {{ $project->title }}
                                    </h3>

                                    <p class="mt-1 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                                        {{ $project->role ?? 'Full-Stack Developer' }}
                                    </p>

                                    <p class="mt-3 line-clamp-3 text-xs leading-6 text-zinc-600 dark:text-white/60">
                                        {{ $project->description }}
                                    </p>

                                    <!-- Tech Chips -->
                                    @if ($project->tech_stack)
                                        <div class="mt-4 flex flex-wrap gap-1.5">
                                            @foreach ($project->tech_list as $tech)
                                                <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/70 px-2 py-0.5 text-[10px] font-medium">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="border-t border-zinc-100 dark:border-white/10 p-4 bg-zinc-50/50 dark:bg-white/[0.01]">
                                <button
                                    type="button"
                                    onclick="openProjectModal({{ $project->id }})"
                                    class="w-full flex items-center justify-center gap-1.5 rounded-xl border border-zinc-200 dark:border-white/10 bg-white dark:bg-white/5 py-2.5 px-4 text-xs font-bold text-zinc-900 dark:text-white hover:border-emerald-500 hover:text-emerald-600 dark:hover:border-emerald-400 dark:hover:text-emerald-300 transition shadow-xs"
                                >
                                    <span>{{ $copy['projects']['detail_button'] }}</span>
                                    <span>→</span>
                                </button>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-2xl border border-dashed border-zinc-300 dark:border-white/20 p-12 text-center">
                            <p class="text-sm text-zinc-500 dark:text-white/50">{{ $copy['projects']['empty_title'] }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- F. PENGALAMAN / EXPERIENCE — WAJIB             -->
        <!-- ============================================== -->
        <section id="pengalaman" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between border-b border-zinc-200 dark:border-white/10 pb-6">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['experience']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['experience']['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-white/60">
                            {{ $copy['experience']['description'] }}
                        </p>
                    </div>
                </div>

                <div class="mt-10 space-y-6">
                    @forelse ($experiencesPlk as $exp)
                        <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.03] p-6 sm:p-7 shadow-sm dark:shadow-none transition hover:border-zinc-400 dark:hover:border-white/30">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-zinc-100 dark:border-white/10 pb-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider border border-emerald-500/20">
                                            {{ $copy['experience']['tag_plk'] }}
                                        </span>
                                        <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white">{{ $exp->title }}</h3>
                                    </div>
                                    <p class="mt-1 text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $exp->organization }}</p>
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-white/50 sm:text-right">
                                    <span class="font-bold text-zinc-800 dark:text-white/80">{{ $exp->period }}</span>
                                    @if ($exp->location) <p class="text-[11px]">{{ $exp->location }}</p> @endif
                                </div>
                            </div>
                            <p class="mt-4 text-xs sm:text-sm leading-6 text-zinc-600 dark:text-white/70">
                                {{ $exp->description }}
                            </p>
                            @if ($exp->skills_gained)
                                <div class="mt-4 flex flex-wrap items-center gap-1.5">
                                    <span class="text-xs font-semibold text-zinc-400 dark:text-white/40">{{ $copy['experience']['skills_label'] }}</span>
                                    @foreach ($exp->skills_list as $sk)
                                        <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/80 px-2 py-0.5 text-[11px]">{{ $sk }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                    @endforelse

                    @forelse ($experiencesOrg as $exp)
                        <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.03] p-6 sm:p-7 shadow-sm dark:shadow-none transition hover:border-zinc-400 dark:hover:border-white/30">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-zinc-100 dark:border-white/10 pb-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="rounded bg-sky-50 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider border border-sky-500/20">
                                            {{ $copy['experience']['tag_org'] }}
                                        </span>
                                        <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white">{{ $exp->title }}</h3>
                                    </div>
                                    <p class="mt-1 text-sm font-semibold text-sky-600 dark:text-sky-400">{{ $exp->organization }}</p>
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-white/50 sm:text-right">
                                    <span class="font-bold text-zinc-800 dark:text-white/80">{{ $exp->period }}</span>
                                </div>
                            </div>
                            <p class="mt-4 text-xs sm:text-sm leading-6 text-zinc-600 dark:text-white/70">
                                {{ $exp->description }}
                            </p>
                            @if ($exp->skills_gained)
                                <div class="mt-4 flex flex-wrap items-center gap-1.5">
                                    <span class="text-xs font-semibold text-zinc-400 dark:text-white/40">{{ $copy['experience']['skills_label'] }}</span>
                                    @foreach ($exp->skills_list as $sk)
                                        <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/80 px-2 py-0.5 text-[11px]">{{ $sk }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                    @endforelse

                    @forelse ($experiencesLomba as $exp)
                        <div class="rounded-2xl border border-zinc-200 bg-white dark:border-white/10 dark:bg-white/[0.03] p-6 sm:p-7 shadow-sm dark:shadow-none transition hover:border-zinc-400 dark:hover:border-white/30">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-zinc-100 dark:border-white/10 pb-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="rounded bg-amber-50 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider border border-amber-500/20">
                                            {{ $copy['experience']['tag_lomba'] }}
                                        </span>
                                        <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white">{{ $exp->title }}</h3>
                                    </div>
                                    <p class="mt-1 text-sm font-semibold text-amber-600 dark:text-amber-400">{{ $exp->organization }}</p>
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-white/50 sm:text-right">
                                    <span class="font-bold text-zinc-800 dark:text-white/80">{{ $exp->period }}</span>
                                </div>
                            </div>
                            <p class="mt-4 text-xs sm:text-sm leading-6 text-zinc-600 dark:text-white/70">
                                {{ $exp->description }}
                            </p>
                            @if ($exp->skills_gained)
                                <div class="mt-4 flex flex-wrap items-center gap-1.5">
                                    <span class="text-xs font-semibold text-zinc-400 dark:text-white/40">{{ $copy['experience']['skills_label'] }}</span>
                                    @foreach ($exp->skills_list as $sk)
                                        <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/80 px-2 py-0.5 text-[11px]">{{ $sk }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- E. SERTIFIKAT & LISENSI (STATUS: 0 / ON PROGRESS) -->
        <!-- ============================================== -->
        <section id="sertifikat" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between border-b border-zinc-200 dark:border-white/10 pb-6">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['certificates']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['certificates']['title'] }}</h2>
                    </div>
                    <span class="rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-semibold text-zinc-600 dark:border-white/15 dark:bg-white/5 dark:text-white/60">
                        {{ $copy['certificates']['count'] }}
                    </span>
                </div>

                <div class="mt-8 rounded-2xl border border-dashed border-zinc-300 dark:border-white/20 p-8 text-center bg-white dark:bg-white/[0.01]">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-white/10 text-xl">
                        📜
                    </div>
                    <h3 class="mt-4 text-base font-bold text-zinc-900 dark:text-white">{{ $copy['certificates']['empty_title'] }}</h3>
                    <p class="mt-2 max-w-xl mx-auto text-xs leading-6 text-zinc-600 dark:text-white/60">
                        {{ $copy['certificates']['empty_description'] }}
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- M & I. TESTIMONI & FORMULIR PESAN (TERPADU)   -->
        <!-- ============================================== -->
        <section id="testimoni" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between border-b border-zinc-200 dark:border-white/10 pb-6">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['testimonials']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['testimonials']['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-white/60">
                            {{ $copy['testimonials']['description'] }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            onclick="document.getElementById('modal-testimoni').classList.remove('hidden')"
                            class="inline-flex items-center gap-2 rounded-xl bg-zinc-900 text-white dark:bg-white dark:text-black px-4 py-2.5 text-xs font-bold uppercase tracking-wider transition hover:opacity-85 shadow-md"
                        >
                            <span>+</span>
                            <span>{{ $copy['testimonials']['button_write'] }}</span>
                        </button>
                    </div>
                </div>

                @if (session('testimonial_submitted'))
                    <div class="mt-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-800 dark:text-emerald-200">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">✓</span>
                            <p class="font-semibold">{{ session('testimonial_submitted') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Testimonials Grid -->
                <div class="mt-10 grid gap-6 md:grid-cols-2">
                    @forelse ($testimonials as $index => $testimonial)
                        <article class="testimoni-card-item {{ $index >= 2 ? 'testimoni-card-extra hidden' : '' }} flex flex-col justify-between rounded-2xl border border-zinc-200 bg-white p-7 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none transition hover:border-zinc-400 dark:hover:border-white/30">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/70 px-2.5 py-0.5 text-[10px] font-bold uppercase">
                                        {{ $testimonial->category ?? 'Rekomendasi' }}
                                    </span>
                                    <span class="text-amber-500 text-xs">★★★★★</span>
                                </div>
                                <p class="text-sm leading-7 text-zinc-700 dark:text-white/80 italic">
                                    “{{ $testimonial->content }}”
                                </p>
                            </div>

                            <div class="mt-6 flex items-center gap-4 border-t border-zinc-100 dark:border-white/10 pt-5">
                                @if ($testimonial->avatar)
                                    <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="h-11 w-11 rounded-full object-cover border border-zinc-200 dark:border-white/20">
                                @else
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-zinc-200 bg-zinc-100 text-zinc-800 dark:border-white/20 dark:bg-white/10 dark:text-white text-sm font-bold">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <h4 class="truncate text-sm font-bold text-zinc-900 dark:text-white">{{ $testimonial->name }}</h4>
                                    <p class="truncate text-xs text-zinc-500 dark:text-white/50">{{ $testimonial->role }}</p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="col-span-full text-center text-xs text-zinc-500 dark:text-white/40 py-8">{{ $copy['testimonials']['empty_title'] }}</p>
                    @endforelse
                </div>

                <!-- Tombol Lihat Semua Testimoni (jika ada lebih dari 2) -->
                @if ($testimonials->count() > 2)
                    <div class="mt-8 flex justify-center">
                        <button
                            type="button"
                            id="btn-toggle-testimonials"
                            onclick="toggleMoreTestimonials()"
                            class="group inline-flex items-center gap-2 rounded-xl border border-zinc-200 dark:border-white/10 bg-white dark:bg-white/5 px-5 py-2.5 text-xs font-bold text-zinc-800 dark:text-white hover:border-emerald-500 hover:text-emerald-600 dark:hover:border-emerald-400 dark:hover:text-emerald-400 transition shadow-xs"
                        >
                            <span id="text-toggle-testimonials">{{ __('portfolio.testimonials.view_all_button', ['count' => $testimonials->count()]) }}</span>
                            <span id="icon-toggle-testimonials" class="transition-transform duration-300">↓</span>
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- ============================================== -->
        <!-- N. CATATAN NGODING / ARTIKEL                   -->
        <!-- ============================================== -->
        <section id="catatan" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between border-b border-zinc-200 dark:border-white/10 pb-6">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-600 dark:text-emerald-400">{{ $copy['blog']['label'] }}</p>
                        <h2 class="mt-1.5 text-2xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-3xl">{{ $copy['blog']['title'] }}</h2>
                    </div>
                </div>

                <div class="mt-10 {{ $blogs->count() === 1 ? 'max-w-2xl' : ($blogs->count() === 2 ? 'grid gap-6 sm:grid-cols-2' : 'grid gap-6 sm:grid-cols-3') }}">
                    @foreach ($blogs as $blog)
                        <article class="flex flex-col justify-between rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none transition hover:border-zinc-400 dark:hover:border-white/30">
                            <div>
                                <span class="rounded bg-zinc-100 text-zinc-700 dark:bg-white/10 dark:text-white/70 px-2 py-0.5 text-[10px] font-bold uppercase">
                                    {{ $blog->category }}
                                </span>
                                <h3 class="mt-3 text-base font-bold text-zinc-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                                    <a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="mt-2 text-xs leading-6 text-zinc-600 dark:text-white/60 line-clamp-3">
                                    {{ $blog->summary }}
                                </p>
                            </div>
                            <div class="mt-6 border-t border-zinc-100 dark:border-white/10 pt-4">
                                <a href="{{ route('blogs.show', $blog) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    {{ $copy['blog']['read_more'] }}
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- H. KONTAK — WAJIB                              -->
        <!-- ============================================== -->
        <section id="kontak" class="reveal border-b border-zinc-200 dark:border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-18 lg:py-24">
                <div class="grid gap-12 md:grid-cols-[0.9fr_1.1fr] md:items-start">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500 dark:text-white/50">{{ $copy['contact']['label'] }}</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">{{ $copy['contact']['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-white/60">
                            {{ $copy['contact']['description'] }}
                        </p>

                        <div class="mt-8 rounded-2xl border border-zinc-200 bg-white p-5 text-xs text-zinc-600 shadow-sm dark:border-white/10 dark:bg-white/[0.02] dark:text-white/70 dark:shadow-none space-y-2">
                            <p>📍 <strong>{{ $copy['contact']['domicile_label'] }}</strong> {{ $copy['about']['location_value'] }}</p>
                            <p>🏫 <strong>{{ $copy['contact']['school_label'] }}</strong> {{ $copy['contact']['school_value'] }}</p>
                            <p class="text-emerald-600 dark:text-emerald-400 font-semibold">🟢 {{ $copy['contact']['open_for_collab'] }}</p>
                        </div>
                    </div>

                    <!-- Kontak Cards: Hanya Email, GitHub, dan Instagram (Sesuai Permintaan Alvin) -->
                    <div class="grid gap-4">
                        <!-- Email -->
                        <a href="mailto:{{ $profile['email'] ?? 'alvinnabilsaputraa3@gmail.com' }}" class="group flex items-center justify-between gap-4 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm transition hover:border-zinc-900 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-white/40">
                            <div class="min-w-0">
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 dark:text-white/40">Email</span>
                                <span class="mt-1 block truncate text-sm font-bold text-zinc-900 dark:text-white">{{ $profile['email'] ?? 'alvinnabilsaputraa3@gmail.com' }}</span>
                            </div>
                            <span class="text-xl text-zinc-400 group-hover:text-zinc-900 dark:text-white/50 dark:group-hover:text-white transition">↗</span>
                        </a>

                        <!-- GitHub -->
                        <a href="{{ $profile['github'] ?? 'https://github.com/avn20' }}" target="_blank" rel="noopener" class="group flex items-center justify-between gap-4 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm transition hover:border-zinc-900 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-white/40">
                            <div class="min-w-0">
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 dark:text-white/40">GitHub</span>
                                <span class="mt-1 block truncate text-sm font-bold text-zinc-900 dark:text-white">github.com/avn20</span>
                            </div>
                            <span class="text-xl text-zinc-400 group-hover:text-zinc-900 dark:text-white/50 dark:group-hover:text-white transition">↗</span>
                        </a>

                        <!-- Instagram -->
                        <a href="{{ $profile['instagram'] ?? 'https://www.instagram.com/avnns_' }}" target="_blank" rel="noopener" class="group flex items-center justify-between gap-4 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm transition hover:border-zinc-900 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-white/40">
                            <div class="min-w-0">
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 dark:text-white/40">Instagram</span>
                                <span class="mt-1 block truncate text-sm font-bold text-zinc-900 dark:text-white">@avnns20</span>
                            </div>
                            <span class="text-xl text-zinc-400 group-hover:text-zinc-900 dark:text-white/50 dark:group-hover:text-white transition">↗</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer (Bersih & Copyright di Tengah) -->
    <footer class="border-t border-zinc-200 bg-white/60 py-8 px-5 text-center transition-colors duration-300 dark:border-white/10 dark:bg-black/80 backdrop-blur">
        <div class="mx-auto max-w-6xl flex flex-col items-center justify-center text-center">
            <p class="text-xs sm:text-sm font-medium text-zinc-600 dark:text-white/50">
                &copy; {{ date('Y') }} <span class="font-bold text-zinc-900 dark:text-white">{{ $fullName }}</span>. {{ $copy['footer']['copyright'] }}
            </p>
            <div class="mt-3 flex items-center justify-center gap-3 text-[11px] text-zinc-400 dark:text-white/30">
                <a href="{{ route('admin.login') }}" class="transition hover:text-emerald-600 dark:hover:text-emerald-400 flex items-center gap-1">
                    <span>⚙</span>
                    <span>Admin Panel</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- Floating Back to Top Button (Melayang di Pojok Bawah, Sangat Elegan & Nyaman) -->
    <button
        id="back-to-top-btn"
        type="button"
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-40 hidden h-11 w-11 sm:h-12 sm:w-12 items-center justify-center rounded-full border border-zinc-300/80 bg-white/95 text-zinc-800 shadow-xl backdrop-blur transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-emerald-500/20 active:scale-95 dark:border-white/20 dark:bg-zinc-900/95 dark:text-white dark:hover:border-emerald-400 dark:hover:text-emerald-400 group focus:outline-none"
        title="{{ $copy['footer']['back_to_top'] }}"
        aria-label="{{ $copy['footer']['back_to_top'] }}"
    >
        <svg class="h-5 w-5 transition duration-300 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- ============================================== -->
    <!-- MODAL 1: DETAIL PROYEK LENGKAP                 -->
    <!-- ============================================== -->
    <div id="modal-project" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 p-4 backdrop-blur-md overflow-y-auto">
        <div class="relative w-full max-w-2xl rounded-2xl border border-zinc-200 bg-white p-6 sm:p-8 shadow-2xl my-8 max-h-[90vh] overflow-y-auto text-zinc-900 dark:border-white/20 dark:bg-[#0c0c0c] dark:text-white">
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 dark:border-white/10 pb-4">
                <div>
                    <span id="modal-proj-category" class="rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 px-2.5 py-0.5 text-[10px] font-bold uppercase">
                        Category
                    </span>
                    <h3 id="modal-proj-title" class="mt-2 text-xl font-extrabold text-zinc-900 dark:text-white">Project Title</h3>
                    <p id="modal-proj-role" class="mt-1 text-xs text-zinc-500 dark:text-white/60">Role</p>
                </div>
                <button type="button" onclick="closeProjectModal()" class="rounded-lg border border-zinc-200 dark:border-white/15 p-2 text-zinc-500 hover:text-zinc-900 dark:text-white/60 dark:hover:text-white" aria-label="Tutup">
                    ✕
                </button>
            </div>

            <div class="mt-5 space-y-5">
                <div id="modal-proj-img-wrap" class="overflow-hidden rounded-xl border border-zinc-200 dark:border-white/10 bg-zinc-100 dark:bg-white/5">
                    <img id="modal-proj-img" src="" alt="Project Preview" class="h-56 w-full object-cover">
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400 dark:text-white/40">{{ $copy['projects']['modal_desc'] }}</h4>
                    <p id="modal-proj-desc" class="mt-1.5 text-xs sm:text-sm leading-6 text-zinc-700 dark:text-white/80"></p>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400 dark:text-white/40">{{ $copy['projects']['modal_tech'] }}</h4>
                    <div id="modal-proj-tech" class="mt-2 flex flex-wrap gap-1.5"></div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-white/10 dark:bg-white/[0.02]">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">{{ $copy['projects']['modal_problem'] }}</h4>
                        <p id="modal-proj-problem" class="mt-1.5 text-xs leading-5 text-zinc-600 dark:text-white/70"></p>
                    </div>

                    <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-white/10 dark:bg-white/[0.02]">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">{{ $copy['projects']['modal_objective'] }}</h4>
                        <p id="modal-proj-objective" class="mt-1.5 text-xs leading-5 text-zinc-600 dark:text-white/70"></p>
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-white/10 dark:bg-white/[0.02]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-white/40">{{ $copy['projects']['modal_features'] }}</h4>
                    <ul id="modal-proj-features" class="mt-2 space-y-1 text-xs leading-5 text-zinc-700 dark:text-white/80 list-disc list-inside"></ul>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-white/10 dark:bg-white/[0.02]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400">{{ $copy['projects']['modal_feedback'] }}</h4>
                    <p id="modal-proj-feedback" class="mt-1 text-xs leading-5 text-zinc-600 dark:text-white/70 italic"></p>
                </div>

                <div class="flex items-center justify-between gap-3 border-t border-zinc-200 dark:border-white/10 pt-4">
                    <div class="flex items-center gap-2">
                        <a id="modal-proj-github" href="#" target="_blank" rel="noopener" class="hidden inline-flex items-center gap-1.5 rounded-lg border border-zinc-300 dark:border-white/20 px-3.5 py-2 text-xs font-bold text-zinc-800 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/10 transition">
                            <span>GitHub Repository ↗</span>
                        </a>
                        <a id="modal-proj-demo" href="#" target="_blank" rel="noopener" class="hidden inline-flex items-center gap-1.5 rounded-lg border border-emerald-500/40 bg-emerald-500/10 px-3.5 py-2 text-xs font-bold text-emerald-700 dark:text-emerald-300 hover:bg-emerald-500/20 transition">
                            <span>Live Demo ↗</span>
                        </a>
                    </div>
                    <button type="button" onclick="closeProjectModal()" class="rounded-lg bg-zinc-900 text-white dark:bg-white dark:text-black px-5 py-2 text-xs font-bold hover:opacity-85 shadow">
                        {{ $copy['projects']['modal_close'] }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL 2: CV DIGITAL INTERAKTIF                 -->
    <!-- ============================================== -->
    <div id="modal-cv-digital" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 p-4 backdrop-blur-md overflow-y-auto">
        <div class="relative w-full max-w-3xl rounded-2xl border border-zinc-200 bg-white p-6 sm:p-8 shadow-2xl my-8 max-h-[90vh] overflow-y-auto text-zinc-900 dark:border-white/20 dark:bg-[#0c0c0c] dark:text-white">
            <div class="flex items-start justify-between border-b border-zinc-200 dark:border-white/10 pb-4">
                <div>
                    <span class="rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 px-2.5 py-0.5 text-[10px] font-bold uppercase">Curriculum Vitae</span>
                    <h3 class="mt-1 text-2xl font-extrabold text-zinc-900 dark:text-white">{{ $fullName }}</h3>
                    @php
                        $cvSubtitle = array_filter([trim($classMajor), trim($schoolName)]);
                    @endphp
                    @if (!empty($cvSubtitle))
                        <p class="text-xs text-zinc-500 dark:text-white/60">{{ implode(' • ', $cvSubtitle) }}</p>
                    @else
                        <p class="text-xs text-zinc-500 dark:text-white/60">{{ $heroRole }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('cv.digital') }}" target="_blank" class="rounded-lg border border-zinc-300 dark:border-white/20 px-3 py-1.5 text-xs font-bold text-zinc-800 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/10">
                        {{ $copy['cv_modal']['full_page'] }}
                    </a>
                    <button type="button" onclick="document.getElementById('modal-cv-digital').classList.add('hidden')" class="rounded-lg border border-zinc-200 dark:border-white/20 p-2 text-zinc-500 hover:text-zinc-900 dark:text-white/60 dark:hover:text-white">
                        ✕
                    </button>
                </div>
            </div>

            <div class="mt-5 space-y-5 text-xs sm:text-sm">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-white/10 dark:bg-white/[0.02] text-xs">
                    <div>
                        <span class="text-zinc-400 dark:text-white/40">Email:</span>
                        <p class="font-bold text-zinc-900 dark:text-white truncate">{{ $profile['email'] ?? 'alvinnabilsaputraa3@gmail.com' }}</p>
                    </div>
                    <div>
                        <span class="text-zinc-400 dark:text-white/40">GitHub:</span>
                        <p class="font-bold text-zinc-900 dark:text-white">github.com/avn20</p>
                    </div>
                    <div>
                        <span class="text-zinc-400 dark:text-white/40">{{ $copy['about']['location'] }}:</span>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $copy['about']['location_value'] }}</p>
                    </div>
                </div>

                @if (!empty($eduLines))
                    <div>
                        <h4 class="font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 text-xs">{{ $copy['cv_modal']['education'] }}</h4>
                        <div class="mt-2 space-y-1.5 text-xs text-zinc-700 dark:text-white/80">
                            @foreach ($eduLines as $eduLine)
                                <p>{{ ltrim($eduLine, "•- \t") }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div>
                    <h4 class="font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400 text-xs">{{ $copy['cv_modal']['experience'] }}</h4>
                    <div class="mt-2 space-y-2 text-xs text-zinc-700 dark:text-white/80">
                        <p>• {{ $copy['about']['plk_modulia'] }}</p>
                        <p>• {{ $copy['about']['plk_umb'] }}</p>
                        <p>• <strong>{{ app()->getLocale() === 'en' ? 'Student Council (OSIS) SMPN 14 Banjarmasin' : 'Pengurus OSIS SMPN 14 Banjarmasin' }}</strong>: 2021 - 2023</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-zinc-200 dark:border-white/10 pt-4">
                    <a href="{{ route('cv.digital') }}" target="_blank" class="rounded-lg bg-zinc-900 text-white dark:bg-white dark:text-black px-5 py-2.5 text-xs font-bold hover:opacity-85 shadow">
                        {{ $copy['cv_modal']['print_download'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL 3: FORMULIR TESTIMONI & PESAN PENGUNJUNG -->
    <!-- ============================================== -->
    <div id="modal-testimoni" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 backdrop-blur-md @unless($errors->has('name') || $errors->has('role') || $errors->has('content')) hidden @endunless">
        <div class="relative w-full max-w-lg rounded-2xl border border-zinc-200 bg-white p-6 sm:p-8 shadow-2xl max-h-[90vh] overflow-y-auto text-zinc-900 dark:border-white/20 dark:bg-[#0d0d0d] dark:text-white">
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 dark:border-white/10 pb-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">{{ $copy['testimonials']['label'] }}</p>
                    <h3 class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">{{ $copy['testimonials']['form_title'] }}</h3>
                </div>
                <button type="button" onclick="document.getElementById('modal-testimoni').classList.add('hidden')" class="rounded-lg border border-zinc-200 dark:border-white/15 p-2 text-zinc-500 hover:text-zinc-900 dark:text-white/60 dark:hover:text-white" aria-label="Tutup">
                    ✕
                </button>
            </div>

            <p class="mt-3 text-xs leading-5 text-zinc-600 dark:text-white/60">
                {{ $copy['testimonials']['form_description'] }}
            </p>

            <form action="{{ route('testimonials.submit') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label for="modal-name" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-white/80">
                        {{ $copy['testimonials']['name_label'] }} <span class="text-emerald-500">*</span>
                    </label>
                    <input
                        id="modal-name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        placeholder="{{ $copy['testimonials']['name_placeholder'] }}"
                        class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 dark:border-white/15 dark:bg-black dark:text-white dark:placeholder-white/30 focus:border-emerald-500 dark:focus:border-white focus:outline-none"
                    >
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="modal-role" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-white/80">
                        {{ $copy['testimonials']['role_label'] }} <span class="text-emerald-500">*</span>
                    </label>
                    <input
                        id="modal-role"
                        name="role"
                        type="text"
                        value="{{ old('role') }}"
                        required
                        maxlength="255"
                        placeholder="{{ $copy['testimonials']['role_placeholder'] }}"
                        class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 dark:border-white/15 dark:bg-black dark:text-white dark:placeholder-white/30 focus:border-emerald-500 dark:focus:border-white focus:outline-none"
                    >
                    @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="modal-content" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-white/80">
                        {{ $copy['testimonials']['content_label'] }} <span class="text-emerald-500">*</span>
                    </label>
                    <textarea
                        id="modal-content"
                        name="content"
                        rows="4"
                        required
                        maxlength="1000"
                        placeholder="{{ $copy['testimonials']['content_placeholder'] }}"
                        class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 dark:border-white/15 dark:bg-black dark:text-white dark:placeholder-white/30 focus:border-emerald-500 dark:focus:border-white focus:outline-none"
                    >{{ old('content') }}</textarea>
                    @error('content') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="modal-avatar" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-white/80">
                        {{ $copy['testimonials']['avatar_label'] }}
                    </label>
                    <input
                        id="modal-avatar"
                        name="avatar"
                        type="file"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-3 py-2 text-xs text-zinc-700 dark:border-white/15 dark:bg-black dark:text-white file:mr-3 file:rounded file:border-0 file:bg-zinc-900 file:text-white dark:file:bg-white dark:file:text-black file:px-2.5 file:py-1 file:text-xs file:font-bold"
                    >
                    <p class="mt-1 text-[11px] text-zinc-500 dark:text-white/40">{{ $copy['testimonials']['avatar_hint'] }}</p>
                    @error('avatar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-zinc-200 dark:border-white/10 pt-4">
                    <button
                        type="button"
                        onclick="document.getElementById('modal-testimoni').classList.add('hidden')"
                        class="rounded-lg border border-zinc-300 dark:border-white/20 px-4 py-2 text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-white/70 hover:text-zinc-900 dark:hover:text-white"
                    >
                        {{ $copy['testimonials']['cancel_button'] }}
                    </button>
                    <button
                        type="submit"
                        class="rounded-lg bg-zinc-900 text-white dark:bg-white dark:text-black px-5 py-2 text-xs font-bold uppercase tracking-wider transition hover:opacity-85 shadow"
                    >
                        {{ $copy['testimonials']['submit_button'] }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Client-side Interactive Scripts -->
    <script>
        const projectsData = @json($projects);

        function openProjectModal(id) {
            const p = projectsData.find(item => item.id === id);
            if (!p) return;

            document.getElementById('modal-proj-category').textContent = p.category || 'Web Application';
            document.getElementById('modal-proj-title').textContent = p.title;
            document.getElementById('modal-proj-role').textContent = 'Peran: ' + (p.role || 'Full-Stack Developer');
            
            const imgWrap = document.getElementById('modal-proj-img-wrap');
            const imgEl = document.getElementById('modal-proj-img');
            if (p.image_url) {
                imgEl.src = p.image_url;
                imgWrap.classList.remove('hidden');
            } else {
                imgEl.src = '';
                imgWrap.classList.add('hidden');
            }
            
            document.getElementById('modal-proj-desc').textContent = p.description || '';
            const techContainer = document.getElementById('modal-proj-tech');
            techContainer.innerHTML = '';
            if (p.tech_stack) {
                p.tech_stack.split(',').forEach(t => {
                    const sp = document.createElement('span');
                    sp.className = 'rounded bg-zinc-100 text-zinc-800 dark:bg-white/10 dark:text-white/80 px-2 py-0.5 text-[11px] font-medium';
                    sp.textContent = t.trim();
                    techContainer.appendChild(sp);
                });
            }

            document.getElementById('modal-proj-problem').textContent = p.problem_statement || 'Optimalisasi proses digital di lingkungan sekolah.';
            document.getElementById('modal-proj-objective').textContent = p.project_objective || 'Membangun aplikasi yang efisien, mudah digunakan, dan terintegrasi.';

            const featContainer = document.getElementById('modal-proj-features');
            featContainer.innerHTML = '';
            if (p.features) {
                p.features.split('\n').filter(f => f.trim().length > 0).forEach(f => {
                    const li = document.createElement('li');
                    li.textContent = f.replace(/^[•\-\*]\s*/, '');
                    featContainer.appendChild(li);
                });
            }

            document.getElementById('modal-proj-feedback').textContent = p.user_feedback ? '“' + p.user_feedback + '”' : '“Aplikasi berjalan dengan lancar dan sangat membantu.”';

            const ghBtn = document.getElementById('modal-proj-github');
            if (ghBtn) {
                if (p.github_url) {
                    ghBtn.href = p.github_url;
                    ghBtn.classList.remove('hidden');
                } else {
                    ghBtn.classList.add('hidden');
                }
            }

            const demoBtn = document.getElementById('modal-proj-demo');
            if (demoBtn) {
                const targetDemo = p.demo_url || p.link;
                if (targetDemo) {
                    demoBtn.href = targetDemo;
                    demoBtn.classList.remove('hidden');
                } else {
                    demoBtn.classList.add('hidden');
                }
            }

            document.getElementById('modal-project').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeProjectModal() {
            document.getElementById('modal-project').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function toggleMoreTestimonials() {
            const extras = document.querySelectorAll('.testimoni-card-extra');
            const textEl = document.getElementById('text-toggle-testimonials');
            const iconEl = document.getElementById('icon-toggle-testimonials');
            if (!extras.length) return;
            const isHidden = extras[0].classList.contains('hidden');

            extras.forEach(el => {
                if (isHidden) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });

            if (isHidden) {
                textEl.textContent = '{{ __('portfolio.testimonials.show_less_button') }}';
                iconEl.textContent = '↑';
            } else {
                textEl.textContent = '{{ __('portfolio.testimonials.view_all_button', ['count' => $testimonials->count()]) }}';
                iconEl.textContent = '↓';
            }
        }

        function updateThemeIcons(isDark) {
            const sun = document.getElementById('theme-icon-sun');
            const moon = document.getElementById('theme-icon-moon');
            if (sun && moon) {
                if (isDark) {
                    sun.classList.remove('hidden');
                    moon.classList.add('hidden');
                } else {
                    sun.classList.add('hidden');
                    moon.classList.remove('hidden');
                }
            }
        }

        // Dark / Light Mode Switcher with Perfect Contrast & Crisp SVGs
        function initTheme() {
            const isLight = localStorage.theme === 'light';
            if (isLight) {
                document.documentElement.classList.remove('dark');
                updateThemeIcons(false);
            } else {
                document.documentElement.classList.add('dark');
                updateThemeIcons(true);
            }
        }

        function toggleThemeMode() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                updateThemeIcons(false);
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                updateThemeIcons(true);
            }
        }

        initTheme();

        // Floating Back to Top Button Interaction
        const backToTopBtn = document.getElementById('back-to-top-btn');
        if (backToTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 320) {
                    backToTopBtn.classList.remove('hidden');
                    backToTopBtn.classList.add('inline-flex');
                } else {
                    backToTopBtn.classList.add('hidden');
                    backToTopBtn.classList.remove('inline-flex');
                }
            }, { passive: true });
        }

        // Scroll Reveal Animations
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window) {
                const obs = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            obs.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.08 });
                reveals.forEach(r => obs.observe(r));
            } else {
                reveals.forEach(r => r.classList.add('active'));
            }
        });

        // Skills Tab Switcher
        function switchSkillsTab(tab) {
            const hardSec = document.getElementById('section-hard-skills');
            const softSec = document.getElementById('section-soft-skills');
            const btnAll = document.getElementById('btn-skill-all');
            const btnHard = document.getElementById('btn-skill-hard');
            const btnSoft = document.getElementById('btn-skill-soft');

            [btnAll, btnHard, btnSoft].forEach(b => {
                b.classList.remove('bg-white', 'text-zinc-900', 'shadow-xs', 'font-bold', 'dark:bg-white', 'dark:text-black');
                b.classList.add('text-zinc-600', 'dark:text-white/60');
            });

            if (tab === 'hard') {
                hardSec.style.display = 'block';
                softSec.style.display = 'none';
                btnHard.classList.add('bg-white', 'text-zinc-900', 'shadow-xs', 'font-bold', 'dark:bg-white', 'dark:text-black');
            } else if (tab === 'soft') {
                hardSec.style.display = 'none';
                softSec.style.display = 'block';
                btnSoft.classList.add('bg-white', 'text-zinc-900', 'shadow-xs', 'font-bold', 'dark:bg-white', 'dark:text-black');
            } else {
                hardSec.style.display = 'block';
                softSec.style.display = 'block';
                btnAll.classList.add('bg-white', 'text-zinc-900', 'shadow-xs', 'font-bold', 'dark:bg-white', 'dark:text-black');
            }
        }
    </script>
</body>
</html>
