@extends('layouts.admin')

@section('title', 'Kelola Informasi Profil & Konten')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between border-b border-white/10 pb-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">⚙️ Mengelola Informasi Profil & Konten</h2>
            <p class="mt-1 text-xs text-white/50">
                Fitur KIK UKK: <strong>Mengubah Konten tanpa Menghapus Kode</strong>. Seluruh teks, biodata, dan kontak di beranda dapat diedit di bawah ini.
            </p>
        </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 rounded-xl border border-white/10 bg-white/[0.02] p-6 sm:p-8">
        @csrf
        @method('PUT')

        <!-- Bagian 1: Identitas Siswa & Hero Section -->
        <div>
            <h3 class="border-b border-white/10 pb-2 text-sm font-bold uppercase tracking-wider text-emerald-400">
                1. Identitas Pribadi & Halaman Beranda (Hero)
            </h3>
            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-white/80">Nama Lengkap</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $settings['full_name'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="nickname" class="block text-xs font-bold uppercase tracking-wider text-white/80">Nama Panggilan</label>
                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $settings['nickname'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="class_major" class="block text-xs font-bold uppercase tracking-wider text-white/80">Kelas dan Kompetensi Keahlian</label>
                    <input type="text" id="class_major" name="class_major" value="{{ old('class_major', $settings['class_major'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="school_name" class="block text-xs font-bold uppercase tracking-wider text-white/80">Nama Sekolah</label>
                    <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $settings['school_name'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label for="hero_role" class="block text-xs font-bold uppercase tracking-wider text-white/80">Headline / Role Hero</label>
                    <input type="text" id="hero_role" name="hero_role" value="{{ old('hero_role', $settings['hero_role'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label for="personal_branding" class="block text-xs font-bold uppercase tracking-wider text-white/80">Deskripsi Singkat / Personal Branding</label>
                    <textarea id="personal_branding" name="personal_branding" rows="3" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('personal_branding', $settings['personal_branding'] ?? '') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="core_skills" class="block text-xs font-bold uppercase tracking-wider text-white/80">Keahlian Utama (Highlight Badges Hero)</label>
                    <input type="text" id="core_skills" name="core_skills" value="{{ old('core_skills', $settings['core_skills'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-white/80">Foto Profil / Avatar</label>
                    <div class="mt-2 flex items-center gap-4">
                        @php
                            $currentAvatar = !empty($settings['avatar_image'])
                                ? (str_starts_with($settings['avatar_image'], 'assets/') ? asset($settings['avatar_image']) : asset('storage/' . $settings['avatar_image']))
                                : asset('assets/img/me.jpg');
                        @endphp
                        <img src="{{ $currentAvatar }}" alt="Avatar" class="h-16 w-16 rounded-full object-cover border border-white/20">
                        <div class="space-y-2 flex-1">
                            <input type="file" id="avatar_image" name="avatar_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="text-xs text-white file:mr-3 file:rounded file:border-0 file:bg-white file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-black">
                            @if (!empty($settings['avatar_image']))
                                <div>
                                    <label class="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300 cursor-pointer">
                                        <input type="checkbox" name="remove_avatar" value="1" class="rounded border-white/20 bg-black text-red-500 focus:ring-0">
                                        <span>Hapus foto custom (kembalikan ke foto profil bawaan)</span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Tentang Saya (About Me) -->
        <div>
            <h3 class="border-b border-white/10 pb-2 text-sm font-bold uppercase tracking-wider text-sky-400">
                2. Rincian Tentang Saya (About Me)
            </h3>
            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="about_bio" class="block text-xs font-bold uppercase tracking-wider text-white/80">Biodata Lengkap / Cerita Diri</label>
                    <textarea id="about_bio" name="about_bio" rows="4" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('about_bio', $settings['about_bio'] ?? '') }}</textarea>
                </div>

                <div>
                    <label for="birth_place_date" class="block text-xs font-bold uppercase tracking-wider text-white/80">Tempat, Tanggal Lahir</label>
                    <input type="text" id="birth_place_date" name="birth_place_date" value="{{ old('birth_place_date', $settings['birth_place_date'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="spoken_languages" class="block text-xs font-bold uppercase tracking-wider text-white/80">Penguasaan Bahasa</label>
                    <input type="text" id="spoken_languages" name="spoken_languages" value="{{ old('spoken_languages', $settings['spoken_languages'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label for="interest_tech" class="block text-xs font-bold uppercase tracking-wider text-white/80">Minat dan Bidang Teknologi yang Dikuasai</label>
                    <input type="text" id="interest_tech" name="interest_tech" value="{{ old('interest_tech', $settings['interest_tech'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label for="career_objective" class="block text-xs font-bold uppercase tracking-wider text-white/80">Cita - Cita / Tujuan Karir</label>
                    <textarea id="career_objective" name="career_objective" rows="3" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">{{ old('career_objective', $settings['career_objective'] ?? '') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="education_history" class="block text-xs font-bold uppercase tracking-wider text-white/80">Riwayat Pendidikan (Satu per baris)</label>
                    <textarea id="education_history" name="education_history" rows="4" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 font-mono text-sm text-white focus:border-white focus:outline-none">{{ old('education_history', $settings['education_history'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Kontak & Media Sosial -->
        <div>
            <h3 class="border-b border-white/10 pb-2 text-sm font-bold uppercase tracking-wider text-amber-400">
                3. Kontak & Media Sosial
            </h3>
            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-white/80">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-white/80">Nomor Telepon / HP</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="github" class="block text-xs font-bold uppercase tracking-wider text-white/80">Link GitHub</label>
                    <input type="url" id="github" name="github" value="{{ old('github', $settings['github'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="instagram" class="block text-xs font-bold uppercase tracking-wider text-white/80">Link Instagram</label>
                    <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="linkedin" class="block text-xs font-bold uppercase tracking-wider text-white/80">Link LinkedIn</label>
                    <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $settings['linkedin'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div>
                    <label for="whatsapp" class="block text-xs font-bold uppercase tracking-wider text-white/80">Link WhatsApp Langsung</label>
                    <input type="url" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label for="location" class="block text-xs font-bold uppercase tracking-wider text-white/80">Lokasi / Domisili</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $settings['location'] ?? '') }}" class="mt-1.5 w-full rounded-lg border border-white/15 bg-black px-4 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-6">
            <button type="submit" class="rounded-lg bg-white px-8 py-3 text-xs font-bold uppercase tracking-wider text-black transition hover:bg-white/85 shadow-xl">
                Simpan Semua Perubahan Konten
            </button>
        </div>
    </form>
</div>
@endsection
