@extends('layouts.admin')

@section('title', 'Edit Sertifikat')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Edit Sertifikat: {{ $certificate->title }}</h2>
            <p class="mt-1 text-xs text-white/50">Perbarui data atau gambar sertifikasi.</p>
        </div>
        <a href="{{ route('admin.certificates.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Sertifikat / Prestasi <span class="text-red-400">*</span>
            </label>
            <input type="text" id="title" name="title" value="{{ old('title', $certificate->title) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div>
            <label for="issuer" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Penerbit / Penyelenggara <span class="text-red-400">*</span>
            </label>
            <input type="text" id="issuer" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Sertifikasi Kompetensi" {{ old('category', $certificate->category) === 'Sertifikasi Kompetensi' ? 'selected' : '' }}>Sertifikasi Kompetensi</option>
                    <option value="Prestasi / Lomba" {{ old('category', $certificate->category) === 'Prestasi / Lomba' ? 'selected' : '' }}>Prestasi / Lomba</option>
                    <option value="Pelatihan & Kursus" {{ old('category', $certificate->category) === 'Pelatihan & Kursus' ? 'selected' : '' }}>Pelatihan & Kursus</option>
                </select>
            </div>

            <div>
                <label for="issue_date" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tahun / Tanggal Terbit
                </label>
                <input type="text" id="issue_date" name="issue_date" value="{{ old('issue_date', $certificate->issue_date) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="credential_id" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    No. Kredensial / ID Sertifikat
                </label>
                <input type="text" id="credential_id" name="credential_id" value="{{ old('credential_id', $certificate->credential_id) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <div>
                <label for="credential_url" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Verifikasi Online (URL)
                </label>
                <input type="url" id="credential_url" name="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Dokumen Saat Ini
            </label>
            <div class="mt-2 flex items-center gap-4">
                <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" class="h-16 w-24 rounded-lg object-cover border border-white/20">
                <div class="flex-1 space-y-1.5">
                    <label for="image" class="block text-xs font-medium text-white/60">Ganti Foto Dokumen (Opsional):</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-1 w-full rounded-lg border border-white/15 bg-black px-3 py-2 text-xs text-white file:mr-4 file:rounded file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-bold file:text-black">
                    @if ($certificate->image)
                        <div>
                            <label class="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300 cursor-pointer">
                                <input type="checkbox" name="remove_image" value="1" class="rounded border-white/20 bg-black text-red-500 focus:ring-0">
                                <span>Hapus gambar/scan sertifikat ini</span>
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Deskripsi Singkat / Keterangan
            </label>
            <textarea id="description" name="description" rows="3" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('description', $certificate->description) }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.certificates.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Perbarui Sertifikat
            </button>
        </div>
    </form>
</div>
@endsection
