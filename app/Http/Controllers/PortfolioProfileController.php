<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioProfileController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'photo_url' => ['nullable', 'url', 'max:2048'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'remove_photo' => ['nullable', 'boolean'],
        ]);

        $profile = PortfolioProfile::firstOrCreate([], ['name' => $validated['name']]);

        $data = [
            'name' => $validated['name'],
            'headline' => $validated['headline'] ?? null,
            'address' => $validated['address'] ?? null,
            'about' => $validated['about'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ];

        if ($request->boolean('remove_photo')) {
            $this->deleteLocalFile($profile->photo_path);
            $data['photo_path'] = null;
        }

        if ($request->filled('photo_url')) {
            $this->deleteLocalFile($profile->photo_path);
            $data['photo_path'] = $validated['photo_url'];
        }

        if ($request->hasFile('photo')) {
            $this->deleteLocalFile($profile->photo_path);
            $data['photo_path'] = $request->file('photo')->store('profile', 'public');
        }

        $profile->update($data);

        return redirect(route('dashboard').'#profile')->with('success', 'Profil berhasil diperbarui.');
    }

    private function deleteLocalFile(?string $path): void
    {
        if (! $path || Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
