<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        Education::create($this->validated($request));

        return redirect(route('dashboard.index').'#education')->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    public function update(Request $request, Education $education)
    {
        $education->update($this->validated($request));

        return redirect(route('dashboard.index').'#education')->with('success', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect(route('dashboard.index').'#education')->with('success', 'Pendidikan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['nullable', 'string', 'max:255'],
            'field' => ['nullable', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
