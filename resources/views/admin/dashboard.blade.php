@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')

@section('content')
<div>
    <!-- Welcoming Banner -->
    <div class="rounded-xl border border-white/10 bg-gradient-to-r from-white/[0.07] via-white/[0.03] to-transparent p-6 sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/50">Dashboard Admin</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-white sm:text-3xl">Selamat Datang, Alvin! 👋</h2>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/60">
                    Sistem manajemen portofolio digital berbasis Laravel untuk Uji Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak. Seluruh konten portofolio dapat diperbarui melalui panel ini tanpa perlu menyentuh atau menghapus kode.
                </p>
            </div>
            <div class="flex flex-wrap gap-2 sm:shrink-0">
                <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow-lg">
                    <span>+</span> Tambah Proyek
                </a>
                <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-white/20 bg-white/10 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white transition hover:bg-white/20">
                    <span>+</span> Sertifikat
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Grid -->
    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-white/25">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-white/50">Total Proyek</p>
                <span class="text-xl">📁</span>
            </div>
            <p class="mt-3 text-3xl font-bold text-white">{{ $stats['projects'] }}</p>
            <p class="mt-1 text-xs text-white/40">Karya terpublikasi di beranda</p>
            <a href="{{ route('admin.projects.index') }}" class="mt-4 block text-xs font-semibold text-white/70 hover:text-white">Kelola Proyek →</a>
        </div>

        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-white/25">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-white/50">Sertifikat & Prestasi</p>
                <span class="text-xl">📜</span>
            </div>
            <p class="mt-3 text-3xl font-bold text-white">{{ $stats['certificates'] }}</p>
            <p class="mt-1 text-xs text-white/40">BNSP, LKS, & Pelatihan</p>
            <a href="{{ route('admin.certificates.index') }}" class="mt-4 block text-xs font-semibold text-white/70 hover:text-white">Kelola Sertifikat →</a>
        </div>

        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-white/25">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-white/50">Testimoni</p>
                <span class="text-xl">💬</span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-white">{{ $stats['testimonials'] }}</span>
                @if ($stats['pending_testimonials'] > 0)
                    <span class="rounded-full bg-amber-400/20 px-2 py-0.5 text-[11px] font-bold text-amber-300">
                        {{ $stats['pending_testimonials'] }} Menunggu
                    </span>
                @endif
            </div>
            <p class="mt-1 text-xs text-white/40">Guru, Teman, Pengguna & PLK</p>
            <a href="{{ route('admin.testimonials.index') }}" class="mt-4 block text-xs font-semibold text-white/70 hover:text-white">Kelola Testimoni →</a>
        </div>

        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-white/25">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-white/50">Keahlian & Skills</p>
                <span class="text-xl">⚡</span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-white">{{ $stats['skills'] }}</span>
            </div>
            <p class="mt-1 text-xs text-white/40">Hard Skills & Soft Skills Terukur</p>
            <a href="{{ route('admin.skills.index') }}" class="mt-4 block text-xs font-semibold text-white/70 hover:text-white">Kelola Keahlian →</a>
        </div>
    </div>

    <!-- Secondary Stats & Quick Overview -->
    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <!-- Proyek Terkini -->
        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-6">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h3 class="text-base font-bold text-white">📁 Proyek Terkini</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-white/60 hover:text-white">Lihat Semua →</a>
            </div>

            <div class="mt-4 divide-y divide-white/10">
                @forelse ($recentProjects as $project)
                    <div class="flex items-center justify-between py-3.5">
                        <div class="flex items-center gap-3 min-w-0">
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="h-12 w-12 rounded object-cover border border-white/10">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-white">{{ $project->title }}</p>
                                <p class="truncate text-xs text-white/50">{{ $project->category ?? 'Web Application' }} • {{ $project->role ?? 'Fullstack' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="rounded bg-white/10 px-2.5 py-1 text-xs font-medium text-white hover:bg-white/20">Edit</a>
                    </div>
                @empty
                    <p class="py-4 text-center text-xs text-white/40">Belum ada proyek.</p>
                @endforelse
            </div>
        </div>

        <!-- Testimoni & Kesan Terkini -->
        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-6">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h3 class="text-base font-bold text-white">💬 Testimoni & Kesan Terkini</h3>
                <a href="{{ route('admin.testimonials.index') }}" class="text-xs text-white/60 hover:text-white">Lihat Semua →</a>
            </div>

            <div class="mt-4 divide-y divide-white/10">
                @forelse ($recentTestimonials as $t)
                    <div class="py-3.5">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-bold text-white">{{ $t->name }}</p>
                            <span class="rounded bg-white/10 px-2 py-0.5 text-[10px] text-white/60">{{ $t->role }}</span>
                        </div>
                        <p class="mt-1 line-clamp-2 text-xs leading-5 text-white/60 italic">“{{ $t->content }}”</p>
                    </div>
                @empty
                    <p class="py-4 text-center text-xs text-white/40">Belum ada testimoni.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
