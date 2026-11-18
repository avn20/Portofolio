<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Portofolio Alvin Nabil Saputra</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-scroll::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 999px;
        }
    </style>
</head>
<body class="min-h-screen bg-black px-4 py-6 text-white antialiased sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <!-- Header Atas -->
        <header class="flex flex-col gap-4 border-b border-white/10 pb-6 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-11 w-11 items-center justify-center rounded-lg border border-emerald-500/30 bg-emerald-500/10 font-mono text-sm font-bold text-emerald-400 shadow">
                    &lt;/&gt;
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-400 border border-emerald-500/30">Admin</span>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-white md:text-2xl">MyPortfolio CMS</h1>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/80 transition hover:border-white/50 hover:bg-white/10 hover:text-white">
                    <span>Lihat Website</span>
                    <span class="text-sm">↗</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-md border border-red-500/30 bg-red-500/10 px-3.5 py-2 text-xs font-semibold text-red-300 transition hover:bg-red-500/20">
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Navigasi Menu Admin Tabs -->
        @php
            $unreadMessagesCount = \App\Models\Message::where('is_read', false)->count();
            $pendingTestimonialsCount = \App\Models\Testimonial::where('is_approved', false)->count();
            $currentRoute = request()->route()->getName();
        @endphp

        <nav class="custom-scroll mt-4 flex items-center gap-1 overflow-x-auto border-b border-white/10 pb-3 text-xs font-semibold uppercase tracking-wider text-white/60">
            <a href="{{ route('admin.dashboard') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                📊 Ringkasan
            </a>
            <a href="{{ route('admin.projects.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.projects') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                📁 Proyek ({{ \App\Models\Project::count() }})
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.certificates') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                📜 Sertifikat ({{ \App\Models\Certificate::count() }})
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.experiences') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                💼 Pengalaman ({{ \App\Models\Experience::count() }})
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-1.5 whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.testimonials') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                <span>💬 Testimoni & Kesan</span>
                @if ($pendingTestimonialsCount > 0)
                    <span class="rounded-full bg-amber-400 px-1.5 py-0.2 text-[10px] font-bold text-black">{{ $pendingTestimonialsCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.blogs') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                📝 Artikel ({{ \App\Models\Blog::count() }})
            </a>
            <a href="{{ route('admin.skills.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.skills') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                ⚡ Keahlian ({{ \App\Models\Skill::count() }})
            </a>
            <a href="{{ route('admin.profile.index') }}" class="whitespace-nowrap rounded-md px-3.5 py-2 transition {{ str_starts_with($currentRoute, 'admin.profile') ? 'bg-white text-black font-bold' : 'hover:bg-white/10 hover:text-white' }}">
                ⚙️ Profil & Konten
            </a>
        </nav>

        <!-- Flash Alert -->
        @if (session('success'))
            <div class="mt-6 flex items-center justify-between rounded-lg border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-200">
                <div class="flex items-center gap-3">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500/20 text-xs font-bold text-emerald-300">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm text-red-200">
                <p class="font-semibold text-red-300">Terjadi beberapa kesalahan input:</p>
                <ul class="mt-2 list-inside list-disc space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content Slot -->
        <main class="mt-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
