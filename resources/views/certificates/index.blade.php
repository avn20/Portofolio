@extends('layouts.admin')

@section('title', 'Kelola Sertifikat & Prestasi')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">📜 Sertifikat dan Prestasi</h2>
            <p class="mt-1 text-xs text-white/50">Kelola dokumentasi sertifikasi kompetensi (BNSP/LSP), piagam lomba, dan sertifikat pelatihan.</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tambah Sertifikat Baru
        </a>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($certificates as $cert)
            <article class="flex flex-col justify-between overflow-hidden rounded-xl border border-white/10 bg-white/[0.03] transition hover:border-white/30">
                <div>
                    <div class="relative h-44 w-full overflow-hidden bg-white/5">
                        <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="h-full w-full object-cover">
                        <span class="absolute top-3 left-3 rounded-md bg-black/80 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur">
                            {{ $cert->category }}
                        </span>
                        @if ($cert->issue_date)
                            <span class="absolute top-3 right-3 rounded-md bg-emerald-500/80 px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $cert->issue_date }}
                            </span>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="text-base font-bold text-white">{{ $cert->title }}</h3>
                        <p class="mt-1 text-xs font-medium text-white/70">Penerbit: {{ $cert->issuer }}</p>

                        @if ($cert->credential_id)
                            <p class="mt-1 text-[11px] text-white/40">No: {{ $cert->credential_id }}</p>
                        @endif

                        <p class="mt-3 line-clamp-3 text-xs leading-5 text-white/60">
                            {{ $cert->description }}
                        </p>

                        @if ($cert->credential_url)
                            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener" class="mt-3 inline-block text-xs font-semibold text-sky-400 hover:underline">
                                Verifikasi Online ↗
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-white/10 p-4 bg-white/[0.01]">
                    <a href="{{ route('admin.certificates.edit', $cert) }}" class="rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-black transition hover:bg-white/85">
                        Edit
                    </a>
                    <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?');">
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
                <p class="text-base font-semibold text-white">Belum ada sertifikat</p>
                <p class="mt-1 text-xs text-white/50">Klik tombol di atas untuk menambahkan sertifikat dan prestasi pertama Anda.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
