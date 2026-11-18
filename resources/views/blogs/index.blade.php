@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">📝 Artikel</h2>
            <p class="mt-1 text-xs text-white/50">Kelola artikel, tutorial singkat, cerita proses proyek, dan dokumentasi catatan ngoding.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tulis Artikel Baru
        </a>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($blogs as $blog)
            <article class="flex flex-col justify-between overflow-hidden rounded-xl border border-white/10 bg-white/[0.03] transition hover:border-white/30">
                <div>
                    @if ($blog->image_url)
                        <div class="relative h-44 w-full overflow-hidden bg-white/5">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                            <span class="absolute top-3 left-3 rounded-md bg-black/80 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur">
                                {{ $blog->category }}
                            </span>
                            <span class="absolute top-3 right-3 rounded-md {{ $blog->is_published ? 'bg-emerald-500/80' : 'bg-amber-500/80' }} px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $blog->is_published ? 'Terbit' : 'Draf' }}
                            </span>
                        </div>
                    @else
                        <div class="px-5 pt-5 flex items-center justify-between">
                            <span class="rounded-md bg-white/10 px-2.5 py-1 text-[11px] font-semibold text-white/80">
                                {{ $blog->category }}
                            </span>
                            <span class="rounded-md {{ $blog->is_published ? 'bg-emerald-500/80' : 'bg-amber-500/80' }} px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $blog->is_published ? 'Terbit' : 'Draf' }}
                            </span>
                        </div>
                    @endif

                    <div class="p-5">
                        <h3 class="text-base font-bold text-white">{{ $blog->title }}</h3>
                        <p class="mt-1 text-[11px] text-white/40">
                            {{ $blog->created_at->format('d M Y') }} • {{ $blog->read_time }}
                        </p>

                        <p class="mt-3 line-clamp-3 text-xs leading-5 text-white/60">
                            {{ $blog->summary }}
                        </p>

                        @if ($blog->tags)
                            <div class="mt-4 flex flex-wrap gap-1">
                                @foreach ($blog->tags_list as $tag)
                                    <span class="rounded bg-white/10 px-2 py-0.5 text-[10px] text-white/70">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-white/10 p-4 bg-white/[0.01]">
                    <a href="{{ route('blogs.show', $blog) }}" target="_blank" class="text-xs font-semibold text-sky-400 hover:underline">
                        Lihat Artikel ↗
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-black transition hover:bg-white/85">
                            Edit
                        </a>
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md border border-red-500/30 bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-300 transition hover:bg-red-500/20">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-white/20 p-12 text-center">
                <p class="text-base font-semibold text-white">Belum ada artikel</p>
                <p class="mt-1 text-xs text-white/50">Klik tombol di atas untuk menulis artikel atau tutorial pertama Anda.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
