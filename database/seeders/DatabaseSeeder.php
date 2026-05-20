<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioProfile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@portfolio.test'],
            [
                'name' => 'Admin Portfolio',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        );

        PortfolioProfile::firstOrCreate([], [
            'name' => 'Nama Kamu',
            'headline' => 'Web Developer',
            'address' => 'Makassar, Indonesia',
            'about' => 'Saya membangun aplikasi web yang rapi, fungsional, dan mudah digunakan. Portfolio ini bisa kamu ubah sepenuhnya dari dashboard.',
            'email' => 'nama@email.com',
            'phone' => '0812-3456-7890',
        ]);

        Skill::firstOrCreate(['name' => 'Laravel'], [
            'category' => 'Backend',
            'level' => 86,
            'sort_order' => 1,
        ]);

        Skill::firstOrCreate(['name' => 'MySQL'], [
            'category' => 'Database',
            'level' => 82,
            'sort_order' => 2,
        ]);

        Skill::firstOrCreate(['name' => 'UI Design'], [
            'category' => 'Frontend',
            'level' => 78,
            'sort_order' => 3,
        ]);

        Experience::firstOrCreate(['role' => 'Freelance Web Developer'], [
            'company' => 'Personal Project',
            'location' => 'Remote',
            'period' => '2025 - Sekarang',
            'description' => 'Mengerjakan website portfolio, sistem CRUD, dan aplikasi sederhana berbasis Laravel.',
            'sort_order' => 1,
        ]);

        Education::firstOrCreate(['institution' => 'Nama Sekolah atau Kampus'], [
            'degree' => 'Jurusan',
            'field' => 'Rekayasa Perangkat Lunak',
            'period' => '2023 - Sekarang',
            'description' => 'Fokus belajar pemrograman web, database, dan perancangan antarmuka.',
            'sort_order' => 1,
        ]);

        Project::firstOrCreate(['name' => 'Portfolio Website'], [
            'description' => 'Website portfolio pribadi dengan halaman publik, dashboard, dan CRUD konten berbasis database.',
            'tech_stack' => 'Laravel, MySQL, CSS',
            'link' => null,
            'sort_order' => 1,
        ]);
    }
}
