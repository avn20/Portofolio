@extends('layouts.admin')

@section('title', 'Kelola Pengalaman')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">💼 Kelola Pengalaman Nyata</h2>
            <p class="mt-1 text-xs text-white/50">Kelola jejak Praktik Kerja Lapangan (PLK), keaktifan organisasi, dan kompetensi lomba.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tambah Pengalaman Baru
        </a>
    </div>

    <!-- Filter Tab Pengalaman -->
    <div class="mt-6 flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.experiences.index', ['type' => 'all']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ $type === 'all' ? 'bg-white text-black' : 'border border-white/15 text-white/60 hover:text-white' }}">
            Semua ({{ $experiences->count() }})
        </a>
        <a href="{{ route('admin.experiences.index', ['type' => 'plk']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ $type === 'plk' ? 'bg-sky-400 text-black' : 'border border-sky-500/30 text-sky-300 hover:bg-sky-500/10' }}">
            Pengalaman PLK ({{ $plkCount }})
        </a>
        <a href="{{ route('admin.experiences.index', ['type' => 'organisasi']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ $type === 'organisasi' ? 'bg-emerald-400 text-black' : 'border border-emerald-500/30 text-emerald-300 hover:bg-emerald-500/10' }}">
            Organisasi & Kepanitiaan ({{ $orgCount }})
        </a>
        <a href="{{ route('admin.experiences.index', ['type' => 'lomba']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ $type === 'lomba' ? 'bg-amber-400 text-black' : 'border border-amber-500/30 text-amber-300 hover:bg-amber-500/10' }}">
            Perlombaan & Kompetisi ({{ $lombaCount }})
        </a>
    </div>

    <div class="mt-8 space-y-4">
        @forelse ($experiences as $exp)
            <div class="flex flex-col justify-between rounded-xl border border-white/10 bg-white/[0.02] p-5 sm:flex-row sm:items-start transition hover:border-white/25">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        @if ($exp->type === 'plk')
                            <span class="rounded bg-sky-500/20 px-2 py-0.5 text-[10px] font-bold text-sky-300 border border-sky-500/30 uppercase">PLK Industri</span>
                        @elseif ($exp->type === 'organisasi')
                            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold text-emerald-300 border border-emerald-500/30 uppercase">Organisasi</span>
                        @else
                            <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[10px] font-bold text-amber-300 border border-amber-500/30 uppercase">Perlombaan</span>
                        @endif

                        <h3 class="text-base font-bold text-white">{{ $exp->title }}</h3>
                    </div>

                    <p class="text-xs font-medium text-white/80">
                        {{ $exp->organization }}
                        @if ($exp->location) • <span class="text-white/50">{{ $exp->location }}</span> @endif
                        @if ($exp->period) • <span class="text-emerald-400">{{ $exp->period }}</span> @endif
                    </p>

                    <p class="text-xs leading-5 text-white/60">
                        {{ $exp->description }}
                    </p>

                    @if ($exp->skills_gained)
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            @foreach ($exp->skills_list as $skill)
                                <span class="rounded bg-white/10 px-2 py-0.5 text-[10px] text-white/70">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-4 flex items-center gap-2 sm:mt-0 sm:shrink-0">
                    <a href="{{ route('admin.experiences.edit', $exp) }}" class="rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-black transition hover:bg-white/85">
                        Edit
                    </a>
                    <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Hapus data pengalaman ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md border border-red-500/30 bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-300 transition hover:bg-red-500/20">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-dashed border-white/20 p-12 text-center">
                <p class="text-base font-semibold text-white">Belum ada pengalaman terdaftar</p>
                <p class="mt-1 text-xs text-white/50">Klik tombol di atas untuk menambahkan pengalaman PLK, organisasi, atau lomba.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
