@extends('layouts.admin')

@section('title', 'Tambah Proyek')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Tambah Proyek Baru</h2>
            <p class="mt-1 text-xs text-white/50">Lengkapi instrumen KIK UKK Rekayasa Perangkat Lunak untuk galeri portofolio Anda.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="rounded-md border border-white/20 px-3.5 py-2 text-xs font-semibold text-white/70 hover:text-white">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf

        <div class="grid gap-6 sm:grid-cols-2">
            <!-- Nama Proyek -->
            <div class="sm:col-span-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Nama Proyek <span class="text-red-400">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Ulangan Sekolah SDN TELUK DALAM 3" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Kategori Proyek -->
            <div>
                <label for="category" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Kategori Proyek
                </label>
                <input type="text" id="category" name="category" value="{{ old('category', 'Web Application') }}" placeholder="Contoh: Web Application / Sistem Sekolah / POS" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Peran dalam Proyek -->
            <div>
                <label for="role" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Peran dalam Proyek
                </label>
                <input type="text" id="role" name="role" value="{{ old('role', 'Fullstack Developer') }}" placeholder="Contoh: Fullstack Developer / Frontend Lead" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Gambar / Screenshot Aplikasi -->
            <div class="sm:col-span-2">
                <label for="image" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Screenshot / Banner Proyek (Opsional)
                </label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-xs text-white file:mr-4 file:rounded file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-bold file:text-black">
                <p class="mt-1 text-[11px] text-white/40">Format: JPG, PNG, atau WebP (Maks. 2MB). Jika dikosongkan, gambar default akan digunakan.</p>
            </div>

            <!-- Deskripsi Singkat -->
            <div class="sm:col-span-2">
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Deskripsi Ringkas Proyek <span class="text-red-400">*</span>
                </label>
                <textarea id="description" name="description" rows="3" required placeholder="Deskripsikan gambaran umum aplikasi ini..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <!-- Permasalahan yang Ingin Diselesaikan -->
            <div class="sm:col-span-2">
                <label for="problem_statement" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Permasalahan yang Ingin Diselesaikan
                </label>
                <textarea id="problem_statement" name="problem_statement" rows="3" placeholder="Jelaskan latar belakang masalah atau kendala yang dihadapi sebelum adanya proyek ini..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('problem_statement') }}</textarea>
            </div>

            <!-- Tujuan Dibuatnya Proyek -->
            <div class="sm:col-span-2">
                <label for="project_objective" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Tujuan Dibuatnya Proyek
                </label>
                <textarea id="project_objective" name="project_objective" rows="3" placeholder="Tujuan yang ingin dicapai melalui aplikasi ini..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('project_objective') }}</textarea>
            </div>

            <!-- Teknologi yang Digunakan -->
            <div class="sm:col-span-2">
                <label for="tech_stack" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Teknologi yang Digunakan (Pisahkan dengan koma)
                </label>
                <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack') }}" placeholder="Contoh: Laravel 11, Tailwind CSS, MySQL, Alpine.js, REST API" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Fitur-Fitur dalam Proyek -->
            <div class="sm:col-span-2">
                <label for="features" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Fitur-Fitur dalam Proyek (Satu fitur per baris)
                </label>
                <textarea id="features" name="features" rows="4" placeholder="• Manajemen Bank Soal&#10;• Ujian Online dengan Timer&#10;• Rekapitulasi Nilai Otomatis" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('features') }}</textarea>
            </div>

            <!-- Link Demo Proyek -->
            <div>
                <label for="link" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Demo Proyek (URL)
                </label>
                <input type="url" id="link" name="link" value="{{ old('link') }}" placeholder="https://suj.modulia.web.id" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Link Source Code GitHub -->
            <div>
                <label for="github_url" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Link Source Code GitHub (URL)
                </label>
                <input type="url" id="github_url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/avn20/proyek-nama" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">
            </div>

            <!-- Dokumentasi Proses Pekerjaan -->
            <div class="sm:col-span-2">
                <label for="process_flow" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Dokumentasi Proses Pekerjaan
                </label>
                <textarea id="process_flow" name="process_flow" rows="3" placeholder="1. Analisis Kebutuhan -> 2. Desain Figma -> 3. Pengkodean Laravel -> 4. Pengujian UAT -> 5. Deployment" class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('process_flow') }}</textarea>
            </div>

            <!-- Feedback User -->
            <div class="sm:col-span-2">
                <label for="user_feedback" class="block text-xs font-bold uppercase tracking-wider text-white/80">
                    Feedback / Ulasan Pengguna
                </label>
                <textarea id="user_feedback" name="user_feedback" rows="2" placeholder="Ulasan pengguna atau guru tentang proyek ini..." class="mt-2 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-white focus:outline-none">{{ old('user_feedback') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-6">
            <a href="{{ route('admin.projects.index') }}" class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold text-white/70 hover:text-white">
                Batal
            </a>
            <button type="submit" class="rounded-lg bg-white px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow">
                Simpan Proyek
            </button>
        </div>
    </form>
</div>
@endsection
