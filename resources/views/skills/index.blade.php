@extends('layouts.admin')

@section('title', 'Kelola Keahlian')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">⚡ Kelola Keahlian (Skills)</h2>
            <p class="mt-1 text-xs text-white/50">Atur kemampuan teknis (hard skill) dan kemampuan non-teknis (soft skill) beserta persentase kompetensinya.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
            <span>+</span> Tambah Keahlian Baru
        </a>
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <!-- Hard Skills -->
        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-6">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h3 class="text-base font-bold text-white">💻 Kemampuan Teknis (Hard Skills)</h3>
                <span class="rounded bg-sky-500/20 px-2 py-0.5 text-xs font-bold text-sky-300">{{ $hardSkills->count() }} Skill</span>
            </div>

            <div class="mt-4 space-y-4">
                @forelse ($hardSkills as $skill)
                    <div class="rounded-lg border border-white/10 bg-black/40 p-3.5 transition hover:border-white/25">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $skill->name }}</h4>
                                <span class="text-[11px] text-white/50">{{ $skill->level_name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-emerald-400">{{ $skill->percentage }}%</span>
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="rounded bg-white/10 px-2 py-1 text-[11px] font-medium text-white hover:bg-white/20">Edit</a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus keahlian ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded border border-red-500/30 bg-red-500/10 px-2 py-1 text-[11px] text-red-300 hover:bg-red-500/20">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-2 h-1.5 w-full rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-white/90" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-xs text-white/40">Belum ada hard skill.</p>
                @endforelse
            </div>
        </div>

        <!-- Soft Skills -->
        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-6">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h3 class="text-base font-bold text-white">🤝 Kemampuan Non-Teknis (Soft Skills)</h3>
                <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-xs font-bold text-emerald-300">{{ $softSkills->count() }} Skill</span>
            </div>

            <div class="mt-4 space-y-4">
                @forelse ($softSkills as $skill)
                    <div class="rounded-lg border border-white/10 bg-black/40 p-3.5 transition hover:border-white/25">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $skill->name }}</h4>
                                <span class="text-[11px] text-white/50">{{ $skill->level_name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-emerald-400">{{ $skill->percentage }}%</span>
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="rounded bg-white/10 px-2 py-1 text-[11px] font-medium text-white hover:bg-white/20">Edit</a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus keahlian ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded border border-red-500/30 bg-red-500/10 px-2 py-1 text-[11px] text-red-300 hover:bg-red-500/20">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-2 h-1.5 w-full rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-emerald-400" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-xs text-white/40">Belum ada soft skill.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
