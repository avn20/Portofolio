@extends('layouts.admin')

@section('title', 'Tambah Keahlian')

@section('content')
<div class="mx-auto max-w-xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Tambah Keahlian Baru</h2>
            <p class="mt-1 text-xs text-white/50">Masukkan nama teknologi atau soft skill beserta persentasenya.</p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Keahlian <span class="text-red-400">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Laravel Framework / Problem Solving" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori Keahlian <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="hard_skill" {{ old('category') === 'hard_skill' ? 'selected' : '' }}>Hard Skill (Kemampuan Teknis)</option>
                    <option value="soft_skill" {{ old('category') === 'soft_skill' ? 'selected' : '' }}>Soft Skill (Non-Teknis / Sikap)</option>
                </select>
            </div>

            <div>
                <label for="level_name" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tingkat Kemahiran <span class="text-red-400">*</span>
                </label>
                <select id="level_name" name="level_name" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Mahir" {{ old('level_name') === 'Mahir' ? 'selected' : '' }}>Mahir (Advanced)</option>
                    <option value="Menengah" {{ old('level_name', 'Menengah') === 'Menengah' ? 'selected' : '' }}>Menengah (Intermediate)</option>
                    <option value="Pemula" {{ old('level_name') === 'Pemula' ? 'selected' : '' }}>Pemula (Beginner)</option>
                </select>
            </div>
        </div>

        <div>
            <label for="percentage" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Persentase Kemampuan (1 - 100%) <span class="text-red-400">*</span>
            </label>
            <div class="mt-2 flex items-center gap-3">
                <input type="range" id="percentage-range" min="1" max="100" value="{{ old('percentage', 80) }}" oninput="document.getElementById('percentage').value = this.value" class="h-2 flex-1 rounded-lg bg-white/20 accent-white">
                <input type="number" id="percentage" name="percentage" min="1" max="100" value="{{ old('percentage', 80) }}" required oninput="document.getElementById('percentage-range').value = this.value" class="w-20 rounded-lg border border-white/15 bg-black px-3 py-2 text-center text-sm font-bold text-white focus:border-white focus:outline-none">
                <span class="text-sm font-bold text-white">%</span>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.skills.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Simpan Keahlian
            </button>
        </div>
    </form>
</div>
@endsection
