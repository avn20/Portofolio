@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-6">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">✉️ Mengelola Pesan Yang Masuk</h2>
            <p class="mt-1 text-xs text-white/50">Kesan, pesan, masukan penguji UKK, atau peluang kolaborasi dari formulir website.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.messages.index', ['filter' => 'all']) }}" class="rounded-md px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'all' ? 'bg-white text-black' : 'border border-white/15 text-white/60 hover:text-white' }}">
                Semua ({{ $allCount }})
            </a>
            <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="rounded-md px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'unread' ? 'bg-red-500 text-white' : 'border border-red-500/30 text-red-300 hover:bg-red-500/10' }}">
                Belum Dibaca ({{ $unreadCount }})
            </a>
            <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}" class="rounded-md px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'read' ? 'bg-white text-black' : 'border border-white/15 text-white/60 hover:text-white' }}">
                Sudah Dibaca
            </a>
        </div>
    </div>

    <div class="mt-8 space-y-4">
        @forelse ($messages as $msg)
            <div class="rounded-xl border {{ $msg->is_read ? 'border-white/10 bg-white/[0.02]' : 'border-red-500/40 bg-red-500/[0.03]' }} p-5 transition hover:border-white/25">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-white/10 pb-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 font-bold text-white text-sm">
                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold text-white">{{ $msg->name }}</h3>
                                @if (!$msg->is_read)
                                    <span class="rounded bg-red-500/20 px-2 py-0.5 text-[10px] font-bold text-red-300 border border-red-500/30 uppercase">Baru</span>
                                @endif
                            </div>
                            <p class="text-xs text-white/50">{{ $msg->email }} • <span class="text-white/70">{{ $msg->category }}</span></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-white/40 text-[11px]">{{ $msg->created_at->format('d M Y, H:i') }}</span>
                        <a href="mailto:{{ $msg->email }}?subject=Balasan:%20Portofolio%20Alvin%20Nabil" class="rounded bg-white/10 px-2.5 py-1 text-xs font-semibold text-white hover:bg-white/20">
                            Balas Email ↗
                        </a>
                        @if ($msg->is_read)
                            <form action="{{ route('admin.messages.unread', $msg) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="rounded border border-white/15 px-2 py-1 text-[11px] text-white/60 hover:text-white">
                                    Tandai Belum Dibaca
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.messages.read', $msg) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="rounded bg-emerald-500/20 border border-emerald-500/30 px-2 py-1 text-[11px] font-bold text-emerald-300 hover:bg-emerald-500/30">
                                    ✓ Tandai Sudah Dibaca
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded border border-red-500/30 bg-red-500/10 px-2 py-1 text-[11px] font-semibold text-red-300 hover:bg-red-500/20">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm leading-6 text-white/80 whitespace-pre-line">{{ $msg->message }}</p>
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-dashed border-white/20 p-12 text-center">
                <p class="text-base font-semibold text-white">Tidak ada pesan masuk</p>
                <p class="mt-1 text-xs text-white/50">Pesan dari pengunjung yang mengisi Formulir Kesan & Pesan di beranda akan tampil di sini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
