<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-black px-4 py-8 text-white antialiased sm:px-5">
    <main class="mx-auto max-w-2xl">
        <div class="mb-8">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">Admin</p>
            <h1 class="mt-3 text-3xl font-semibold tracking-tight">Tambah Proyek</h1>
            <p class="mt-3 text-sm leading-6 text-white/55">
                Isi data proyek. Setelah disimpan, proyek akan otomatis tampil di bagian Karya & Kolaborasi.
            </p>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-md border border-white/10 bg-white/[0.03] p-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-semibold text-white/75">Judul Proyek</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required maxlength="255" class="mt-2 w-full rounded-md border border-white/10 bg-black px-4 py-3 text-white outline-none transition focus:border-white/40">
                @error('title') <p class="mt-2 text-sm text-white/55">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-white/75">Deskripsi Proyek</label>
                <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-md border border-white/10 bg-black px-4 py-3 text-white outline-none transition focus:border-white/40">{{ old('description') }}</textarea>
                @error('description') <p class="mt-2 text-sm text-white/55">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-white/75">Gambar Proyek</label>
                <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/jpg,image/webp" required class="mt-2 w-full rounded-md border border-white/10 bg-black px-4 py-3 text-sm text-white file:mr-4 file:rounded-md file:border-0 file:bg-white file:px-3 file:py-2 file:text-sm file:font-semibold file:text-black">
                @error('image') <p class="mt-2 text-sm text-white/55">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="link" class="block text-sm font-semibold text-white/75">Link Proyek</label>
                <input id="link" name="link" type="url" value="{{ old('link') }}" maxlength="255" placeholder="https://contoh.com" class="mt-2 w-full rounded-md border border-white/10 bg-black px-4 py-3 text-white outline-none transition focus:border-white/40">
                @error('link') <p class="mt-2 text-sm text-white/55">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-col gap-3 border-t border-white/10 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.projects.index') }}" class="inline-flex justify-center rounded-md border border-white/15 px-4 py-3 text-sm font-semibold text-white transition hover:border-white/40">
                    Batal
                </a>
                <button type="submit" class="rounded-md bg-white px-4 py-3 text-sm font-semibold text-black transition hover:bg-white/85">
                    Simpan Proyek
                </button>
            </div>
        </form>
    </main>
</body>
</html>
