<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        Skill::create($this->validated($request));

        return redirect(route('dashboard').'#skills')->with('success', 'Skill berhasil ditambahkan.');
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validated($request));

        return redirect(route('dashboard').'#skills')->with('success', 'Skill berhasil diperbarui.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect(route('dashboard').'#skills')->with('success', 'Skill berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
