<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioProfile;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index', [
            'profile' => PortfolioProfile::first() ?? new PortfolioProfile([
                'name' => 'Nama Kamu',
                'headline' => 'Web Developer',
                'address' => 'Makassar, Indonesia',
                'about' => 'Tuliskan cerita singkat tentang diri kamu lewat dashboard.',
            ]),
            'skills' => Skill::orderBy('sort_order')->orderBy('name')->get(),
            'experiences' => Experience::orderBy('sort_order')->latest()->get(),
            'educations' => Education::orderBy('sort_order')->latest()->get(),
            'projects' => Project::orderBy('sort_order')->latest()->get(),
        ]);
    }
}
