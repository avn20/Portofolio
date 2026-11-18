@extends('layouts.admin')

@section('title', 'Tambah Sertifikat')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Tambah Sertifikat / Prestasi</h2>
            <p class="mt-1 text-xs text-white/50">Masukkan data sertifikasi kompetensi keahlian atau piagam penghargaan.</p>
        </div>
        <a href="{{ route('admin.certificates.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf

        <div>
            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Nama Sertifikat / Prestasi <span class="text-red-400">*</span>
            </label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Sertifikasi BNSP Junior Web Developer" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
        </div>

        <div>
            <label for="issuer" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Penerbit / Penyelenggara <span class="text-red-400">*</span>
            </label>
            <input type="text" id="issuer" name="issuer" value="{{ old('issuer') }}" required placeholder="Contoh: BNSP / LSP SMK / Dicoding / Dinas Pendidikan" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Sertifikasi Kompetensi" {{ old('category') === 'Sertifikasi Kompetensi' ? 'selected' : '' }}>Sertifikasi Kompetensi</option>
                    <option value="Prestasi / Lomba" {{ old('category') === 'Prestasi / Lomba' ? 'selected' : '' }}>Prestasi / Lomba</option>
                    <option value="Pelatihan & Kursus" {{ old('category') === 'Pelatihan & Kursus' ? 'selected' : '' }}>Pelatihan & Kursus</option>
                </select>
            </div>

            <div>
                <label for="issue_date" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tahun / Tanggal Terbit
                </label>
                <input type="text" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" placeholder="Contoh: 2026 / Mei 2025" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="credential_id" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    No. Kredensial / ID Sertifikat
                </label>
                <input type="text" id="credential_id" name="credential_id" value="{{ old('credential_id') }}" placeholder="Contoh: BNSP-RPL-2026-7789" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <div>
                <label for="credential_url" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Verifikasi Online (URL)
                </label>
                <input type="url" id="credential_url" name="credential_url" value="{{ old('credential_url') }}" placeholder="https://..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="image" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Foto / Scan Dokumen Sertifikat
            </label>
            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-xs text-white file:mr-4 file:rounded file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-bold file:text-black">
        </div>

        <div>
            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Deskripsi Singkat / Keterangan
            </label>
            <textarea id="description" name="description" rows="3" placeholder="Jelaskan kompetensi yang diujikan atau capaian lomba..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.certificates.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Simpan Sertifikat
            </button>
        </div>
    </form>
</div>
@endsection
