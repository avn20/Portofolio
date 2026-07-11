<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Proyek | Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-black px-4 py-8 text-white antialiased sm:px-5">
    <main class="mx-auto max-w-6xl">
        <header class="flex flex-col gap-5 border-b border-white/10 pb-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/45">Admin</p>
                <h1 class="mt-3 text-3xl font-semibold tracking-tight md:text-4xl">Kelola Proyek</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-white/55">
                    Halaman ini khusus admin untuk menambah, mengubah, dan menghapus proyek yang tampil di portofolio.
                </p>
            </div>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <a href="{{ route('home') }}" class="inline-flex justify-center rounded-md border border-white/15 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40">
                    Lihat Website
                </a>
                <a href="{{ route('admin.projects.create') }}" class="inline-flex justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-black transition hover:bg-white/85">
                    Tambah Proyek
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="w-full rounded-md border border-white/15 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40" type="submit">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        @if (session('success'))
            <div class="mt-6 rounded-md border border-white/15 bg-white/[0.04] px-4 py-3 text-sm text-white/75">
                {{ session('success') }}
            </div>
        @endif

        <section class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                @php
                    $imageSource = filter_var($project->image, FILTER_VALIDATE_URL)
                        ? $project->image
                        : asset('storage/' . $project->image);
                @endphp

                <article class="overflow-hidden rounded-md border border-white/10 bg-white/[0.03]">
                    <img src="{{ $imageSource }}" alt="{{ $project->title }}" class="h-48 w-full object-cover">

                    <div class="p-5">
                        <h2 class="break-words text-xl font-semibold">{{ $project->title }}</h2>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/55">{{ $project->description }}</p>

                        @if ($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="mt-4 inline-flex break-all text-sm font-semibold text-white/70 hover:text-white">
                                Buka Link ↗
                            </a>
                        @endif

                        <div class="mt-5 flex items-center gap-2 border-t border-white/10 pt-4">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="rounded-md bg-white px-3 py-2 text-xs font-semibold text-black transition hover:bg-white/85">
                                Edit
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md border border-white/15 px-3 py-2 text-xs font-semibold text-white transition hover:border-white/40">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-md border border-dashed border-white/20 bg-white/[0.03] p-8 text-center md:col-span-2 lg:col-span-3">
                    <h2 class="text-xl font-semibold">Belum ada proyek</h2>
                    <p class="mt-3 text-white/55">Tambahkan 3 proyek rencana kamu dari tombol di atas.</p>
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
