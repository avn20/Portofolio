@extends('layouts.admin')

@section('title', 'Edit Proyek')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Edit Proyek: {{ $project->title }}</h2>
            <p class="mt-1 text-xs text-white/50">Perbarui rincian, fitur, atau screenshot aplikasi proyek ini.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="grid gap-6 sm:grid-cols-2">
            <!-- Nama Proyek -->
            <div class="sm:col-span-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Nama Proyek <span class="text-red-400">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Kategori Proyek -->
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori Proyek
                </label>
                <input type="text" id="category" name="category" value="{{ old('category', $project->category) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Peran dalam Proyek -->
            <div>
                <label for="role" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Peran dalam Proyek
                </label>
                <input type="text" id="role" name="role" value="{{ old('role', $project->role) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Gambar / Screenshot Aplikasi Saat Ini & Pengganti -->
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Screenshot Saat Ini
                </label>
                <div class="mt-2 flex items-center gap-4">
                    @if ($project->image_url)
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="h-20 w-32 rounded-lg object-cover border border-white/20">
                    @else
                        <div class="flex h-20 w-32 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-[11px] text-white/40">
                            Tanpa Gambar
                        </div>
                    @endif
                    <div class="flex-1 space-y-2">
                        <div>
                            <label for="image" class="block text-xs font-medium text-white/60">Ganti Foto Screenshot (Opsional):</label>
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-1 w-full rounded-lg border border-white/15 bg-black px-3 py-2 text-xs text-white file:mr-4 file:rounded file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-bold file:text-black">
                        </div>
                        @if ($project->image)
                            <div>
                                <label class="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300 cursor-pointer">
                                    <input type="checkbox" name="remove_image" value="1" class="rounded border-white/20 bg-black text-red-500 focus:ring-0">
                                    <span>Hapus foto gambar proyek ini (jadikan tanpa gambar)</span>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div class="sm:col-span-2">
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Deskripsi Ringkas Proyek <span class="text-red-400">*</span>
                </label>
                <textarea id="description" name="description" rows="3" required class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Permasalahan yang Ingin Diselesaikan -->
            <div class="sm:col-span-2">
                <label for="problem_statement" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Permasalahan yang Ingin Diselesaikan
                </label>
                <textarea id="problem_statement" name="problem_statement" rows="3" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('problem_statement', $project->problem_statement) }}</textarea>
            </div>

            <!-- Tujuan Dibuatnya Proyek -->
            <div class="sm:col-span-2">
                <label for="project_objective" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tujuan Dibuatnya Proyek
                </label>
                <textarea id="project_objective" name="project_objective" rows="3" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('project_objective', $project->project_objective) }}</textarea>
            </div>

            <!-- Teknologi yang Digunakan -->
            <div class="sm:col-span-2">
                <label for="tech_stack" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Teknologi yang Digunakan (Pisahkan dengan koma)
                </label>
                <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Fitur-Fitur dalam Proyek -->
            <div class="sm:col-span-2">
                <label for="features" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Fitur-Fitur dalam Proyek (Satu fitur per baris)
                </label>
                <textarea id="features" name="features" rows="4" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('features', $project->features) }}</textarea>
            </div>

            <!-- Link Demo Proyek -->
            <div>
                <label for="link" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Demo Proyek (URL)
                </label>
                <input type="url" id="link" name="link" value="{{ old('link', $project->link ?? $project->demo_url) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Link Source Code GitHub -->
            <div>
                <label for="github_url" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Source Code GitHub (URL)
                </label>
                <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
            </div>

            <!-- Dokumentasi Proses Pekerjaan -->
            <div class="sm:col-span-2">
                <label for="process_flow" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Dokumentasi Proses Pekerjaan
                </label>
                <textarea id="process_flow" name="process_flow" rows="3" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('process_flow', $project->process_flow) }}</textarea>
            </div>

            <!-- Feedback User -->
            <div class="sm:col-span-2">
                <label for="user_feedback" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Feedback / Ulasan Pengguna
                </label>
                <textarea id="user_feedback" name="user_feedback" rows="2" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('user_feedback', $project->user_feedback) }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-6">
            <a href="{{ route('admin.projects.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Perbarui Proyek
            </button>
        </div>
    </form>
</div>
@endsection
