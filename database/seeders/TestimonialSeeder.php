<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();

        Testimonial::create([
            'name' => 'M RIDHA PUTRA KESUMA, S.PD',
            'role' => 'Guru Produktif PPLG SMKN 2 Banjarmasin',
            'content' => 'Terampil dalam problem solving dan sikap tanggung jawab dalam project dan tim yang baik, lebih banyak explore dan coba teknologi baru dan perkembangan teknologi terkini, jos gandosss ;D',
            'avatar' => null,
            'is_approved' => true,
        ]);

        Testimonial::create([
            'name' => 'Sincung Firdaus, S.Kom.',
            'role' => 'Guru Produktif PPLG SMKN 2 Banjarmasin',
            'content' => 'Program berjalan dengan baik, front end dan Backendnya berfungsi dan tampilan cukup bagus, tinggal perpaduan warna dan dashboard msh agak kaku.',
            'avatar' => null,
            'is_approved' => true,
        ]);
    }
}
