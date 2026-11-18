@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">💬 Kelola Testimoni & Kesan Pesan</h2>
            <p class="mt-1 text-xs text-white/50">Tinjau, setujui, dan kelola ulasan serta kesan pesan yang dikirimkan oleh pengunjung.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tambah Testimoni Manual
        </a>
    </div>

    <!-- Filter Status Testimoni -->
    <div class="mt-6 flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.testimonials.index', ['status' => 'all']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ ($status ?? 'all') === 'all' && ($category ?? 'all') === 'all' ? 'bg-white text-black' : 'border border-white/15 text-white/60 hover:text-white' }}">
            Semua ({{ $allCount }})
        </a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}" class="flex items-center gap-1.5 rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ ($status ?? '') === 'pending' ? 'bg-amber-400 text-black' : 'border border-amber-500/30 text-amber-300 hover:bg-amber-500/10' }}">
            <span>Menunggu Persetujuan</span>
            <span class="rounded-full bg-black/20 px-1.5 py-0.2 text-[10px]">{{ $pendingCount }}</span>
        </a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'approved']) }}" class="rounded-md px-3.5 py-1.5 text-xs font-semibold transition {{ ($status ?? '') === 'approved' ? 'bg-white text-black' : 'border border-white/15 text-white/60 hover:text-white' }}">
            Disetujui ({{ $approvedCount }})
        </a>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($testimonials as $testimonial)
            <article class="flex flex-col justify-between rounded-xl border {{ $testimonial->is_approved ? 'border-white/10 bg-white/[0.03]' : 'border-amber-500/40 bg-amber-500/[0.03]' }} p-5 transition hover:border-white/30">
                <div>
                    <!-- Status Badge & Date -->
                    <div class="mb-4 flex items-center justify-between gap-2">
                        @if ($testimonial->is_approved)
                            <span class="inline-flex items-center gap-1 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-300">
                                <span>●</span> Disetujui (Tampil di Beranda)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full border border-amber-500/40 bg-amber-500/15 px-2.5 py-0.5 text-[11px] font-semibold text-amber-300 animate-pulse">
                                <span>●</span> Menunggu Persetujuan
                            </span>
                        @endif

                        <span class="text-[11px] text-white/40">
                            {{ $testimonial->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Kategori Badge -->
                    <div class="mb-3">
                        <span class="rounded bg-white/10 px-2 py-0.5 text-[10px] font-semibold text-white/70">
                            {{ $testimonial->category ?? 'Teman' }}
                        </span>
                    </div>

                    <!-- Konten -->
                    <div class="text-xs leading-6 text-white/80 italic">
                        “{{ $testimonial->content }}”
                    </div>

                    <!-- Author Info -->
                    <div class="mt-5 flex items-center gap-3 border-t border-white/10 pt-4">
                        @if ($testimonial->avatar)
                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full object-cover border border-white/20">
                        @else
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 text-xs font-bold text-white">
                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <h4 class="truncate text-xs font-bold text-white">{{ $testimonial->name }}</h4>
                            <p class="truncate text-[11px] text-white/50">{{ $testimonial->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-5 flex flex-wrap items-center justify-end gap-2 border-t border-white/10 pt-4">
                    @if ($testimonial->is_approved)
                        <form action="{{ route('admin.testimonials.unapprove', $testimonial) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded border border-amber-500/30 bg-amber-500/10 px-2.5 py-1 text-[11px] font-semibold text-amber-300 hover:bg-amber-500/20">
                                Sembunyikan
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded bg-emerald-500/20 border border-emerald-500/30 px-2.5 py-1 text-[11px] font-bold text-emerald-300 hover:bg-emerald-500/30">
                                ✓ Setujui & Tampilkan
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="rounded bg-white px-2.5 py-1 text-[11px] font-semibold text-black hover:bg-white/85">
                        Edit
                    </a>

                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded border border-red-500/30 bg-red-500/10 px-2.5 py-1 text-[11px] font-semibold text-red-300 hover:bg-red-500/20">
                            Hapus
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-white/20 p-12 text-center">
                <p class="text-base font-semibold text-white">Belum ada testimoni dalam filter ini</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
