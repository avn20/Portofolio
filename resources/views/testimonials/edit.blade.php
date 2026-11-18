@extends('layouts.admin')

@section('title', 'Edit Testimoni')

@section('content')
<div class="mx-auto max-w-xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Edit Testimoni: {{ $testimonial->name }}</h2>
            <p class="mt-1 text-xs text-white/50">Perbarui konten ulasan atau status persetujuan.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Lengkap Pemberi Testimoni <span class="text-red-400">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori Testimoni (KIK UKK) <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Guru Pembimbing" {{ old('category', $testimonial->category) === 'Guru Pembimbing' ? 'selected' : '' }}>Guru Pembimbing</option>
                    <option value="Teman" {{ old('category', $testimonial->category) === 'Teman' ? 'selected' : '' }}>Teman / Rekan Siswa</option>
                    <option value="Pengguna" {{ old('category', $testimonial->category) === 'Pengguna' ? 'selected' : '' }}>Pengguna / Klien</option>
                    <option value="Tempat PLK" {{ old('category', $testimonial->category) === 'Tempat PLK' ? 'selected' : '' }}>Tempat PLK / Industri</option>
                </select>
            </div>

            <div>
                <label for="role" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Jabatan / Instansi <span class="text-red-400">*</span>
                </label>
                <input type="text" id="role" name="role" value="{{ old('role', $testimonial->role) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="content" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Isi Testimoni <span class="text-red-400">*</span>
            </label>
            <textarea id="content" name="content" rows="4" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('content', $testimonial->content) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Foto Avatar Saat Ini
            </label>
            <div class="mt-2 flex items-center gap-3">
                @if ($testimonial->avatar)
                    <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full object-cover border border-white/20">
                @else
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1 space-y-1.5">
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="text-xs text-white file:mr-3 file:rounded file:border-0 file:bg-white file:px-2.5 file:py-1 file:text-xs file:font-bold file:text-black">
                    @if ($testimonial->avatar)
                        <div>
                            <label class="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300 cursor-pointer">
                                <input type="checkbox" name="remove_avatar" value="1" class="rounded border-white/20 bg-black text-red-500 focus:ring-0">
                                <span>Hapus foto profil testimoni (gunakan inisial nama)</span>
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_approved" name="is_approved" value="1" {{ old('is_approved', $testimonial->is_approved) ? 'checked' : '' }} class="h-4 w-4 rounded border-white/20 bg-black text-white focus:ring-0">
            <label for="is_approved" class="text-xs font-medium text-white/80">Setujui testimoni ini (Tampilkan di beranda)</label>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.testimonials.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Perbarui Testimoni
            </button>
        </div>
    </form>
</div>
@endsection
