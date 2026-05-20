<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::put('/dashboard/profile', [ProfileController::class, 'update'])->name('dashboard.profile.update');

Route::post('/dashboard/skills', [SkillController::class, 'store'])->name('dashboard.skills.store');
Route::put('/dashboard/skills/{skill}', [SkillController::class, 'update'])->name('dashboard.skills.update');
Route::delete('/dashboard/skills/{skill}', [SkillController::class, 'destroy'])->name('dashboard.skills.destroy');

Route::post('/dashboard/experiences', [ExperienceController::class, 'store'])->name('dashboard.experiences.store');
Route::put('/dashboard/experiences/{experience}', [ExperienceController::class, 'update'])->name('dashboard.experiences.update');
Route::delete('/dashboard/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('dashboard.experiences.destroy');

Route::post('/dashboard/educations', [EducationController::class, 'store'])->name('dashboard.educations.store');
Route::put('/dashboard/educations/{education}', [EducationController::class, 'update'])->name('dashboard.educations.update');
Route::delete('/dashboard/educations/{education}', [EducationController::class, 'destroy'])->name('dashboard.educations.destroy');

Route::post('/dashboard/projects', [ProjectController::class, 'store'])->name('dashboard.projects.store');
Route::put('/dashboard/projects/{project}', [ProjectController::class, 'update'])->name('dashboard.projects.update');
Route::delete('/dashboard/projects/{project}', [ProjectController::class, 'destroy'])->name('dashboard.projects.destroy');
