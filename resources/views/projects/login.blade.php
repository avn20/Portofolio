<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin | Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen flex-col items-center justify-center bg-black px-5 py-8 text-white antialiased">
    <div class="mb-6 w-full max-w-md">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-white/60 transition hover:text-white">
            <span>← Kembali ke Portofolio</span>
        </a>
    </div>

    <main class="w-full max-w-md rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8 shadow-2xl backdrop-blur">
        <div class="flex items-center gap-2">
            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-400 border border-emerald-500/30">CMS Panel</span>
            <span class="text-xs text-white/40">Alvin Nabil Saputra</span>
        </div>
        <h1 class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-white">Masuk Admin</h1>
        <p class="mt-2 text-xs sm:text-sm leading-6 text-white/60">
            Masukkan password admin untuk mengelola proyek, testimoni, sertifikat, artikel, keahlian, dan konten profil.
        </p>

        <form action="{{ route('admin.authenticate') }}" method="POST" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-white/70">Password Admin</label>
                <input id="password" name="password" type="password" required maxlength="100" autocomplete="current-password" placeholder="Masukkan password admin..." class="mt-2 w-full rounded-xl border border-white/15 bg-black px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('password') <p class="mt-2 text-xs font-medium text-red-400">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full rounded-xl bg-white px-4 py-3 text-sm font-bold text-black transition hover:bg-white/90 shadow">
                Masuk ke Dashboard →
            </button>
        </form>
    </main>
</body>
</html>
