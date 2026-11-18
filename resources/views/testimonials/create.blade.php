@extends('layouts.admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="mx-auto max-w-xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Tambah Testimoni Manual</h2>
            <p class="mt-1 text-xs text-white/50">Masukkan testimoni dari guru pembimbing, rekan siswa, klien, atau tempat PLK.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Lengkap Pemberi Testimoni <span class="text-red-400">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Bapak Guru Pembimbing, S.Kom" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori Testimoni (KIK UKK) <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Guru Pembimbing" {{ old('category') === 'Guru Pembimbing' ? 'selected' : '' }}>Guru Pembimbing</option>
                    <option value="Teman" {{ old('category') === 'Teman' ? 'selected' : '' }}>Teman / Rekan Siswa</option>
                    <option value="Pengguna" {{ old('category') === 'Pengguna' ? 'selected' : '' }}>Pengguna / Klien</option>
                    <option value="Tempat PLK" {{ old('category') === 'Tempat PLK' ? 'selected' : '' }}>Tempat PLK / Industri</option>
                </select>
            </div>

            <div>
                <label for="role" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Jabatan / Instansi <span class="text-red-400">*</span>
                </label>
                <input type="text" id="role" name="role" value="{{ old('role') }}" required placeholder="Contoh: Guru Produktif PPLG SMKN 2" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="content" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Isi Testimoni <span class="text-red-400">*</span>
            </label>
            <textarea id="content" name="content" rows="4" required placeholder="Tuliskan ulasan pengalaman berkolaborasi..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('content') }}</textarea>
        </div>

        <div>
            <label for="avatar" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Foto Profil (Opsional)
            </label>
            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2 text-xs text-white file:mr-4 file:rounded file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-bold file:text-black">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_approved" name="is_approved" value="1" {{ old('is_approved', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-white/20 bg-black text-white focus:ring-0">
            <label for="is_approved" class="text-xs font-medium text-white/80">Langsung setujui dan tampilkan di beranda</label>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.testimonials.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Simpan Testimoni
            </button>
        </div>
    </form>
</div>
@endsection
