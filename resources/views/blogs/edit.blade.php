@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Edit Artikel: {{ $blog->title }}</h2>
            <p class="mt-1 text-xs text-white/50">Perbarui konten artikel atau status publikasi.</p>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Judul Artikel <span class="text-red-400">*</span>
            </label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori <span class="text-red-400">*</span>
                </label>
                <select id="category" name="category" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    <option value="Catatan Ngoding" {{ old('category', $blog->category) === 'Catatan Ngoding' ? 'selected' : '' }}>Catatan Ngoding</option>
                    <option value="Tutorial Singkat" {{ old('category', $blog->category) === 'Tutorial Singkat' ? 'selected' : '' }}>Tutorial Singkat Pemrograman</option>
                    <option value="Problem Solving" {{ old('category', $blog->category) === 'Problem Solving' ? 'selected' : '' }}>Dokumentasi Problem Solving / Bug</option>
                    <option value="Pengalaman PLK & Lomba" {{ old('category', $blog->category) === 'Pengalaman PLK & Lomba' ? 'selected' : '' }}>Pengalaman PLK & Lomba</option>
                </select>
            </div>

            <div>
                <label for="read_time" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Estimasi Waktu Baca
                </label>
                <input type="text" id="read_time" name="read_time" value="{{ old('read_time', $blog->read_time) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>
        </div>

        <div>
            <label for="summary" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Ringkasan Artikel (Excerpt)
            </label>
            <textarea id="summary" name="summary" rows="2" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('summary', $blog->summary) }}</textarea>
        </div>

        <div>
            <label for="content" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                Isi Lengkap Artikel <span class="text-red-400">*</span>
            </label>
            <textarea id="content" name="content" rows="10" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 font-mono text-sm text-white focus:border-white focus:outline-none">{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="tags" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tags (Pisahkan koma)
                </label>
                <input type="text" id="tags" name="tags" value="{{ old('tags', $blog->tags) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Gambar Cover Saat Ini
                </label>
                <div class="mt-2 flex items-center gap-3">
                    @if ($blog->image_url)
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="h-12 w-20 rounded object-cover border border-white/20">
                    @else
                        <div class="flex h-12 w-20 items-center justify-center rounded border border-white/10 bg-white/5 text-[10px] text-white/40">
                            Tanpa Cover
                        </div>
                    @endif
                    <div class="flex-1 space-y-1.5">
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full text-xs text-white file:mr-3 file:rounded file:border-0 file:bg-white file:px-2.5 file:py-1 file:text-xs file:font-bold file:text-black">
                        @if ($blog->image)
                            <div>
                                <label class="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300 cursor-pointer">
                                    <input type="checkbox" name="remove_image" value="1" class="rounded border-white/20 bg-black text-red-500 focus:ring-0">
                                    <span>Hapus gambar cover artikel ini (jadikan tanpa gambar)</span>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }} class="h-4 w-4 rounded border-white/20 bg-black text-white focus:ring-0">
            <label for="is_published" class="text-xs font-medium text-white/80">Publikasikan artikel ini di beranda</label>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-5">
            <a href="{{ route('admin.blogs.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Perbarui Artikel
            </button>
        </div>
    </form>
</div>
@endsection
