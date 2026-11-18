@extends('layouts.admin')

@section('title', 'Edit Pengalaman')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Edit Pengalaman: {{ $experience->title }}</h2>
            <p class="mt-1 text-xs text-white/50">Perbarui data riwayat pengalaman ini.</p>
        </div>
        <a href="{{ route('admin.experiences.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="type" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tipe Pengalaman <span class="text-red-400">*</span>
                </label>
                <select id="type" name="type" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="plk" {{ old('type', $experience->type) === 'plk' ? 'selected' : '' }}>Pengalaman PLK (Industri)</option>
                    <option value="organisasi" {{ old('type', $experience->type) === 'organisasi' ? 'selected' : '' }}>Organisasi & Kepanitiaan</option>
                    <option value="lomba" {{ old('type', $experience->type) === 'lomba' ? 'selected' : '' }}>Perlombaan & Kompetisi</option>
                </select>
            </div>

            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Posisi / Jabatan / Predikat <span class="text-red-400">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $experience->title) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="organization" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Perusahaan / Organisasi / Penyelenggara <span class="text-red-400">*</span>
            </label>
            <input type="text" id="organization" name="organization" value="{{ old('organization', $experience->organization) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="period" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Periode Waktu
                </label>
                <input type="text" id="period" name="period" value="{{ old('period', $experience->period) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <div>
                <label for="location" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Lokasi / Kota
                </label>
                <input type="text" id="location" name="location" value="{{ old('location', $experience->location) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Deskripsi Tugas & Pencapaian
            </label>
            <textarea id="description" name="description" rows="4" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div>
            <label for="skills_gained" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Keahlian / Teknologi yang Dipelajari (Pisahkan dengan koma)
            </label>
            <input type="text" id="skills_gained" name="skills_gained" value="{{ old('skills_gained', $experience->skills_gained) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.experiences.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Perbarui Pengalaman
            </button>
        </div>
    </form>
</div>
@endsection
