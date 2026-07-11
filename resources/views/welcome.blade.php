<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alvin Nabil Saputra</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes soft-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .soft-float {
            animation: soft-float 6s ease-in-out infinite;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 0;
            height: 1px;
            content: "";
            background: currentColor;
            transition: width 220ms ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .project-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.32) transparent;
        }

        .project-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .project-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .project-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.32);
            border-radius: 999px;
        }
    </style>
</head>
<body class="bg-black text-white antialiased">
    @php
        $copy = __('portfolio');
        $skills = [
            ['name' => 'HTML', 'level' => 'advanced', 'width' => '90%'],
            ['name' => 'CSS', 'level' => 'advanced', 'width' => '85%'],
            ['name' => 'JavaScript', 'level' => 'intermediate', 'width' => '65%'],
            ['name' => 'PHP', 'level' => 'intermediate', 'width' => '70%'],
            ['name' => 'Laravel', 'level' => 'intermediate', 'width' => '68%'],
            ['name' => 'Tailwind CSS', 'level' => 'intermediate', 'width' => '72%'],
            ['name' => 'MySQL', 'level' => 'intermediate', 'width' => '64%'],
            ['name' => 'GitHub', 'level' => 'intermediate', 'width' => '62%'],
            ['name' => 'Figma', 'level' => 'intermediate', 'width' => '62%'],
            ['name' => 'Notion', 'level' => 'beginner', 'width' => '52%'],
            ['name' => 'Bootstrap', 'level' => 'intermediate', 'width' => '66%'],
        ];
    @endphp

    <header class="sticky top-0 z-50 border-b border-white/10 bg-black/85 backdrop-blur">
        <nav class="mx-auto flex max-w-6xl flex-col gap-4 px-5 py-4 md:flex-row md:items-center md:justify-between">
            <a href="#beranda" class="text-base font-semibold tracking-wide text-white">
                Alvin Nabil Saputra
            </a>

            <div class="flex w-full items-center gap-5 overflow-x-auto pb-1 text-xs font-semibold uppercase tracking-[0.18em] text-white/55 md:w-auto md:gap-6 md:overflow-visible md:pb-0">
                <a href="#beranda" class="nav-link whitespace-nowrap transition hover:-translate-y-0.5 hover:text-white">{{ $copy['nav']['home'] }}</a>
                <a href="#tentang" class="nav-link whitespace-nowrap transition hover:-translate-y-0.5 hover:text-white">{{ $copy['nav']['about'] }}</a>
                <a href="#keahlian" class="nav-link whitespace-nowrap transition hover:-translate-y-0.5 hover:text-white">{{ $copy['nav']['skills'] }}</a>
                <a href="#proyek" class="nav-link whitespace-nowrap transition hover:-translate-y-0.5 hover:text-white">{{ $copy['nav']['projects'] }}</a>
                <a href="#kontak" class="nav-link whitespace-nowrap transition hover:-translate-y-0.5 hover:text-white">{{ $copy['nav']['contact'] }}</a>
                <div class="flex items-center gap-1 rounded-full border border-white/15 p-1" aria-label="{{ $copy['nav']['language'] }}">
                    @foreach (['en' => 'EN', 'id' => 'ID'] as $locale => $label)
                        <a
                            href="{{ route('locale.switch', $locale) }}"
                            @if (app()->getLocale() === $locale) aria-current="true" @endif
                            class="rounded-full px-2.5 py-1 tracking-[0.12em] transition {{ app()->getLocale() === $locale ? 'bg-white text-black' : 'text-white/55 hover:bg-white/10 hover:text-white' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="beranda" class="border-b border-white/10">
            <div class="mx-auto grid min-h-[calc(100vh-113px)] max-w-6xl items-start gap-12 px-5 py-14 md:min-h-[calc(100vh-73px)] md:grid-cols-[1fr_0.88fr] md:py-24">
                <div class="md:pt-20">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/50">
                        {{ $copy['hero']['eyebrow'] }}
                    </p>
                    <h1 class="mt-5 max-w-3xl text-5xl font-semibold leading-none tracking-tight text-white sm:text-6xl lg:text-7xl">
                        Alvin Nabil Saputra
                    </h1>
                    <h2 class="mt-6 text-xl font-medium text-white/70 sm:text-2xl md:min-h-8">
                        {{ $copy['hero']['role'] }}
                    </h2>
                    <p class="mt-6 max-w-xl text-base leading-8 text-white/60 md:min-h-24">
                        {{ $copy['hero']['description'] }}
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a href="#proyek" class="group inline-flex justify-center gap-2 rounded-md bg-white px-5 py-3 text-sm font-semibold text-black transition duration-300 hover:-translate-y-1 hover:bg-white/85 hover:shadow-[0_18px_40px_rgba(255,255,255,0.14)]">
                            <span>{{ $copy['hero']['projects_button'] }}</span>
                            <span class="transition duration-300 group-hover:translate-x-1">→</span>
                        </a>
                        <a href="#kontak" class="group inline-flex justify-center gap-2 rounded-md border border-white/20 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:-translate-y-1 hover:border-white hover:bg-white/10">
                            <span>{{ $copy['hero']['contact_button'] }}</span>
                            <span class="transition duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </div>
                </div>

                <div class="soft-float group relative mx-auto w-full max-w-sm md:max-w-md">
                    <div class="aspect-[4/5] overflow-hidden rounded-md border border-white/10 bg-white/5 transition duration-500 group-hover:-translate-y-1 group-hover:border-white/30">
                        <img
                            src="{{ asset('assets/img/me.jpg') }}"
                            alt="{{ $copy['hero']['photo_alt'] }}"
                            class="h-full w-full object-cover object-center grayscale transition duration-700 group-hover:scale-105"
                        >
                    </div>
                    <div class="absolute -bottom-5 left-5 right-5 border border-white/10 bg-black/90 p-4 backdrop-blur transition duration-500 group-hover:-translate-y-1 group-hover:border-white/30">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-white/45">{{ $copy['hero']['card_label'] }}</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $copy['hero']['card_text'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="border-b border-white/10">
            <div class="mx-auto grid max-w-6xl gap-12 px-5 py-20 md:grid-cols-[0.78fr_1.22fr]">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['about']['label'] }}</p>
                    <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                        {{ $copy['about']['title'] }}
                    </h2>
                </div>

                <div>
                    <p class="text-base leading-8 text-white/60">
                       {{ $copy['about']['description'] }}
                    </p>

                    <div class="mt-12 grid border-y border-white/10 md:grid-cols-2">
                        <div class="border-b border-white/10 py-10 md:border-b-0 md:border-r md:border-white/10">
                            <p class="text-6xl font-light leading-none text-white">3+</p>
                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['about']['total_projects'] }}</p>
                        </div>
                        <div class="py-10 md:pl-12">
                            <p class="text-6xl font-light leading-none text-white">3+</p>
                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['about']['years_experience'] }}</p>
                        </div>
                    </div>

                    <div class="mt-12 divide-y divide-white/10 border-y border-white/10">
                        <div class="py-7">
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/35">{{ $copy['about']['status'] }}</p>
                            <p class="mt-3 text-xl font-semibold leading-8 text-white">{{ $copy['about']['status_value'] }}</p>
                        </div>
                        <div class="py-7">
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/35">{{ $copy['about']['location'] }}</p>
                            <p class="mt-3 text-xl font-semibold leading-8 text-white">{{ $copy['about']['location_value'] }}</p>
                        </div>
                        <div class="py-7">
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/35">{{ $copy['about']['languages'] }}</p>
                            <p class="mt-3 text-xl font-semibold leading-8 text-white">{{ $copy['about']['languages_value'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="keahlian" class="border-b border-white/10 bg-black text-white">
            <div class="mx-auto max-w-6xl px-5 py-24">
                <div class="max-w-3xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['skills']['label'] }}</p>
                    <h2 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">{{ $copy['skills']['title'] }}</h2>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-white/60">
                        {{ $copy['skills']['description'] }}
                    </p>
                </div>

                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($skills as $skill)
                        <div class="group rounded-md border border-white/10 bg-white/[0.035] p-6 transition duration-300 hover:-translate-y-1 hover:border-white/35 hover:bg-white/[0.07] md:p-7">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="text-xl font-semibold tracking-tight text-white">{{ $skill['name'] }}</h3>
                                <span class="rounded-full border border-white/10 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wide text-white/60 transition group-hover:border-white/25 group-hover:text-white">
                                    {{ $copy['skill_levels'][$skill['level']] }}
                                </span>
                            </div>
                            <div class="mt-7 h-2 rounded-full bg-white/10">
                                <div class="h-full rounded-full bg-white/90 transition duration-500 group-hover:bg-white" style="width: {{ $skill['width'] }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="proyek" class="border-b border-white/10">
            <div class="mx-auto max-w-6xl px-5 py-20">
                <div class="mb-10 flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['projects']['label'] }}</p>
                        <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white sm:text-4xl">{{ $copy['projects']['title'] }}</h2>
                        <p class="mt-5 leading-8 text-white/60">
                            {{ $copy['projects']['description'] }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-white/45">
                            {{ __('portfolio.projects.count', ['count' => $projects->count()]) }}
                        </p>

                        @if ($projects->count() > 3)
                            <div class="flex gap-2">
                                <button type="button" onclick="document.getElementById('daftar-proyek').scrollBy({ left: -380, behavior: 'smooth' })" class="rounded-md border border-white/10 px-3 py-2 text-sm text-white/60 transition hover:border-white/35 hover:text-white">
                                    ←
                                </button>
                                <button type="button" onclick="document.getElementById('daftar-proyek').scrollBy({ left: 380, behavior: 'smooth' })" class="rounded-md border border-white/10 px-3 py-2 text-sm text-white/60 transition hover:border-white/35 hover:text-white">
                                    →
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($projects->count())
                    <div id="daftar-proyek" class="project-scroll flex snap-x snap-mandatory gap-6 overflow-x-auto pb-6">
                        @foreach ($projects as $project)
                            @php
                                $imageSource = filter_var($project->image, FILTER_VALIDATE_URL)
                                    ? $project->image
                                    : asset('storage/' . $project->image);
                            @endphp

                            <article class="group w-[min(86vw,360px)] shrink-0 snap-start overflow-hidden rounded-md border border-white/10 bg-white/[0.03] transition duration-300 hover:-translate-y-1 hover:border-white/35 hover:bg-white/[0.06]">
                                @if ($project->link)
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener" class="block overflow-hidden">
                                        <img
                                            src="{{ $imageSource }}"
                                            alt="{{ $project->title }}"
                                            class="h-52 w-full object-cover transition duration-500 group-hover:scale-105 group-hover:brightness-110"
                                        >
                                    </a>
                                @else
                                    <div class="overflow-hidden">
                                        <img
                                            src="{{ $imageSource }}"
                                            alt="{{ $project->title }}"
                                            class="h-52 w-full object-cover transition duration-500 group-hover:scale-105 group-hover:brightness-110"
                                        >
                                    </div>
                                @endif

                                <div class="p-5">
                                    <h3 class="text-xl font-semibold text-white">{{ $project->title }}</h3>
                                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/55">
                                        {{ $project->description }}
                                    </p>

                                    @if ($project->link)
                                        <a href="{{ $project->link }}" target="_blank" rel="noopener" class="group/link mt-5 inline-flex gap-2 rounded-md bg-white px-4 py-2 text-sm font-semibold text-black transition hover:bg-white/85">
                                            <span>{{ $copy['projects']['detail_button'] }}</span>
                                            <span class="transition group-hover/link:translate-x-1">→</span>
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-md border border-dashed border-white/20 bg-white/[0.03] p-8 text-center">
                        <h3 class="text-xl font-semibold text-white">{{ $copy['projects']['empty_title'] }}</h3>
                        <p class="mt-3 text-white/55">
                            {{ $copy['projects']['empty_description'] }}
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <section id="kontak" class="border-b border-white/10 bg-black text-white">
            <div class="mx-auto max-w-6xl px-5 py-20">
                <div class="grid gap-10 md:grid-cols-[0.9fr_1.1fr] md:items-start">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">{{ $copy['contact']['label'] }}</p>
                        <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">{{ $copy['contact']['title'] }}</h2>
                        <p class="mt-5 leading-8 text-white/60">
                            {{ $copy['contact']['description'] }}
                        </p>
                    </div>

                    <div class="grid gap-3">
                        <a href="mailto:alvinnabilsaputraa3@gmail.com" class="flex items-center justify-between gap-4 rounded-md border border-white/10 px-5 py-4 transition hover:border-white/35 hover:bg-white hover:text-black">
                            <span class="min-w-0">
                                <span class="block text-xs font-semibold uppercase tracking-[0.22em] opacity-55">Email</span>
                                <span class="mt-1 block break-all font-semibold">alvinnabilsaputraa3@gmail.com</span>
                            </span>
                            <span class="text-xl">↗</span>
                        </a>
                        <a href="https://www.instagram.com/avnns_" target="_blank" rel="noopener" class="flex items-center justify-between gap-4 rounded-md border border-white/10 px-5 py-4 transition hover:border-white/35 hover:bg-white hover:text-black">
                            <span class="min-w-0">
                                <span class="block text-xs font-semibold uppercase tracking-[0.22em] opacity-55">Instagram</span>
                                <span class="mt-1 block font-semibold">@avnns20</span>
                            </span>
                            <span class="text-xl">↗</span>
                        </a>
                        <a href="https://github.com/avn20" target="_blank" rel="noopener" class="flex items-center justify-between gap-4 rounded-md border border-white/10 px-5 py-4 transition hover:border-white/35 hover:bg-white hover:text-black">
                            <span class="min-w-0">
                                <span class="block text-xs font-semibold uppercase tracking-[0.22em] opacity-55">GitHub</span>
                                <span class="mt-1 block font-semibold">github.com/avn20</span>
                            </span>
                            <span class="text-xl">↗</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-black px-5 py-10 text-center">
        <a href="#beranda" class="group inline-flex items-center gap-3 rounded-md border border-white/10 px-5 py-3 text-xs font-semibold uppercase tracking-[0.24em] text-white/55 transition duration-300 hover:-translate-y-1 hover:border-white/40 hover:bg-white hover:text-black">
            <span class="transition duration-300 group-hover:-translate-y-1">↑</span>
            <span>{{ $copy['footer']['back_to_top'] }}</span>
        </a>
        <p class="mt-6 text-sm text-white/35">
            &copy; {{ date('Y') }} Alvin Nabil Saputra.
        </p>
    </footer>
</body>
</html>
