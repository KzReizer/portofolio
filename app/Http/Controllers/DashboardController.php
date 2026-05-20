<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioProfile;
use App\Models\Project;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'profile' => PortfolioProfile::firstOrCreate([], [
                'name' => 'Nama Kamu',
                'headline' => 'Web Developer',
                'address' => 'Makassar, Indonesia',
                'about' => 'Tuliskan ringkasan singkat tentang diri kamu, fokus pekerjaan, dan nilai yang kamu bawa.',
            ]),
            'skills' => Skill::orderBy('sort_order')->orderBy('name')->get(),
            'experiences' => Experience::orderBy('sort_order')->latest()->get(),
            'educations' => Education::orderBy('sort_order')->latest()->get(),
            'projects' => Project::orderBy('sort_order')->latest()->get(),
        ]);
    }
}
