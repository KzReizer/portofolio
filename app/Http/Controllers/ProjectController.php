<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PortfolioProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'profile' => PortfolioProfile::first(),
            'projects' => Project::orderBy('sort_order')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image_path'] = $this->imagePathFrom($request);

        Project::create($data);

        return redirect(route('dashboard.index').'#projects')->with('success', 'Project berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);

        if ($request->boolean('remove_image')) {
            $this->deleteLocalFile($project->image_path);
            $data['image_path'] = null;
        }

        $imagePath = $this->imagePathFrom($request);
        if ($imagePath) {
            $this->deleteLocalFile($project->image_path);
            $data['image_path'] = $imagePath;
        }

        $project->update($data);

        return redirect(route('dashboard.index').'#projects')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $this->deleteLocalFile($project->image_path);
        $project->delete();

        return redirect(route('dashboard.index').'#projects')->with('success', 'Project berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'image' => ['nullable', 'image', 'max:3072'],
            'remove_image' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        unset($validated['image_url'], $validated['image'], $validated['remove_image']);

        return $validated;
    }

    private function imagePathFrom(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('projects', 'public');
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return null;
    }

    private function deleteLocalFile(?string $path): void
    {
        if (! $path || Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
