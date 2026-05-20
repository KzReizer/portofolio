<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        Experience::create($this->validated($request));

        return redirect(route('dashboard.index').'#experiences')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update($this->validated($request));

        return redirect(route('dashboard.index').'#experiences')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect(route('dashboard.index').'#experiences')->with('success', 'Pengalaman berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'role' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
