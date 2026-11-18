<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} | Alvin Nabil Saputra</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-black text-white antialiased transition-colors duration-300 dark:bg-black dark:text-white" id="app-body">
    <header class="sticky top-0 z-50 border-b border-white/10 bg-black/85 backdrop-blur">
        <div class="mx-auto flex max-w-4xl items-center justify-between px-5 py-4">
            <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wide text-white hover:text-white/80">
                ← Kembali ke Portofolio
            </a>
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    onclick="toggleDarkMode()"
                    id="theme-toggle-btn"
                    class="rounded-full border border-white/20 p-2 text-white/80 transition hover:border-white hover:text-white"
                    aria-label="Toggle theme"
                >
                    <span id="theme-icon">🌙</span>
                </button>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-5 py-12">
        <article>
            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded bg-white/10 px-2.5 py-1 text-xs font-semibold text-white/80">
                    {{ $blog->category }}
                </span>
                <span class="text-xs text-white/40">•</span>
                <span class="text-xs text-white/50">{{ $blog->created_at->format('d M Y') }}</span>
                <span class="text-xs text-white/40">•</span>
                <span class="text-xs text-emerald-400 font-medium">{{ $blog->read_time }}</span>
            </div>

            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                {{ $blog->title }}
            </h1>

            @if ($blog->summary)
                <p class="mt-4 text-base italic leading-7 text-white/60 border-l-2 border-white/30 pl-4">
                    {{ $blog->summary }}
                </p>
            @endif

            @if ($blog->image)
                <div class="mt-8 overflow-hidden rounded-xl border border-white/10">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="h-72 w-full object-cover">
                </div>
            @endif

            <div class="mt-8 prose prose-invert max-w-none text-sm leading-8 text-white/80 whitespace-pre-line space-y-4">
                {{ $blog->content }}
            </div>

            @if ($blog->tags)
                <div class="mt-10 flex flex-wrap items-center gap-2 border-t border-white/10 pt-6">
                    <span class="text-xs text-white/40">Topik:</span>
                    @foreach ($blog->tags_list as $tag)
                        <span class="rounded-full border border-white/15 px-3 py-1 text-xs font-medium text-white/70">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Author Box -->
            <div class="mt-10 flex items-center gap-4 rounded-xl border border-white/10 bg-white/[0.03] p-5">
                <img src="{{ asset('assets/img/me.jpg') }}" alt="Alvin Nabil Saputra" class="h-14 w-14 rounded-full object-cover border border-white/20">
                <div>
                    <h3 class="text-sm font-bold text-white">{{ $profile['full_name'] ?? 'Alvin Nabil Saputra' }}</h3>
                    <p class="text-xs text-white/50">{{ $profile['class_major'] ?? 'Siswa XII PPLG / Rekayasa Perangkat Lunak - SMKN 2 Banjarmasin' }}</p>
                    <p class="mt-1 text-xs text-white/70">Senang membagikan catatan teknis seputar pemrograman web dan pemecahan masalah bug coding.</p>
                </div>
            </div>
        </article>

        <!-- Artikel Terkait -->
        @if ($recentBlogs->count())
            <div class="mt-16 border-t border-white/10 pt-10">
                <h3 class="text-xl font-bold text-white">Artikel Lainnya</h3>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @foreach ($recentBlogs as $rb)
                        <a href="{{ route('blogs.show', $rb) }}" class="group rounded-lg border border-white/10 bg-white/[0.02] p-4 transition hover:border-white/30 hover:bg-white/[0.05]">
                            <span class="text-[11px] text-emerald-400 font-semibold">{{ $rb->category }}</span>
                            <h4 class="mt-1 text-sm font-bold text-white group-hover:text-sky-300">{{ $rb->title }}</h4>
                            <p class="mt-2 line-clamp-2 text-xs text-white/50">{{ $rb->summary }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <footer class="border-t border-white/10 px-5 py-8 text-center text-xs text-white/40">
        &copy; {{ date('Y') }} Alvin Nabil Saputra. Portofolio KIK UKK Rekayasa Perangkat Lunak.
    </footer>

    <script>
        function initTheme() {
            if (localStorage.theme === 'light') {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('bg-black', 'text-white');
                document.body.classList.add('bg-zinc-50', 'text-zinc-900');
                document.getElementById('theme-icon').textContent = '☀️';
            } else {
                document.documentElement.classList.add('dark');
                document.body.classList.add('bg-black', 'text-white');
                document.body.classList.remove('bg-zinc-50', 'text-zinc-900');
                document.getElementById('theme-icon').textContent = '🌙';
            }
        }

        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
            initTheme();
        }

        initTheme();
    </script>
</body>
</html>
