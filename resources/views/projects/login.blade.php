<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin | Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen items-center justify-center bg-black px-5 py-8 text-white antialiased">
    <main class="w-full max-w-md rounded-md border border-white/10 bg-white/[0.03] p-5 sm:p-6">
        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">Admin</p>
        <h1 class="mt-3 text-3xl font-semibold tracking-tight">Masuk Admin</h1>
        <p class="mt-3 text-sm leading-6 text-white/55">
            Masukkan password untuk mengelola proyek portofolio.
        </p>

        <form action="{{ route('admin.authenticate') }}" method="POST" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="password" class="block text-sm font-semibold text-white/75">Password</label>
                <input id="password" name="password" type="password" required maxlength="100" autocomplete="current-password" class="mt-2 w-full rounded-md border border-white/10 bg-black px-4 py-3 text-white outline-none transition focus:border-white/40">
                @error('password') <p class="mt-2 text-sm text-white/55">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full rounded-md bg-white px-4 py-3 text-sm font-semibold text-black transition hover:bg-white/85">
                Masuk
            </button>
        </form>
    </main>
</body>
</html>
