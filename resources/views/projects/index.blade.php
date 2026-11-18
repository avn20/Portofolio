@extends('layouts.admin')

@section('title', 'Kelola Proyek')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">📁 Kelola Proyek Portfolio</h2>
            <p class="mt-1 text-xs text-white/50">Tambah, perbarui screenshot, dan sesuaikan rincian teknis setiap proyek.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tambah Proyek Baru
        </a>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($projects as $project)
            <article class="flex flex-col justify-between overflow-hidden rounded-xl border border-white/10 bg-white/[0.03] transition hover:border-white/30">
                <div>
                    <div class="relative h-48 w-full overflow-hidden bg-white/5">
                        @if ($project->image_url)
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-white/5 text-xs text-white/40">
                                <span>Tanpa Gambar</span>
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 rounded-md bg-black/80 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur">
                            {{ $project->category ?? 'Web Application' }}
                        </span>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white">{{ $project->title }}</h3>
                        <p class="mt-1 text-xs font-medium text-emerald-400">Peran: {{ $project->role ?? 'Fullstack Developer' }}</p>

                        <p class="mt-3 line-clamp-3 text-xs leading-5 text-white/60">
                            {{ $project->description }}
                        </p>

                        @if ($project->tech_stack)
                            <div class="mt-4 flex flex-wrap gap-1">
                                @foreach ($project->tech_list as $tech)
                                    <span class="rounded bg-white/10 px-2 py-0.5 text-[10px] text-white/70">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 flex items-center gap-3 text-xs">
                            @if ($project->demo_url || $project->link)
                                <a href="{{ $project->demo_url ?? $project->link }}" target="_blank" rel="noopener" class="text-sky-400 hover:underline">Demo ↗</a>
                            @endif
                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="text-white/60 hover:text-white">GitHub ↗</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-white/10 p-4 bg-white/[0.01]">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-black transition hover:bg-white/85">
                        Edit
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md border border-red-500/30 bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-300 transition hover:bg-red-500/20">
                            Hapus
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-white/20 p-12 text-center">
                <p class="text-base font-semibold text-white">Belum ada proyek terdaftar</p>
                <p class="mt-1 text-xs text-white/50">Klik tombol "Tambah Proyek Baru" di atas untuk menambahkan portofolio Anda.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
