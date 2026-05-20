<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PortfolioProfile extends Model
{
    protected $fillable = [
        'name',
        'headline',
        'address',
        'about',
        'photo_path',
        'email',
        'phone',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo_path) {
            return null;
        }

        if (Str::startsWith($this->photo_path, ['http://', 'https://'])) {
            return $this->photo_path;
        }

        return asset('storage/'.$this->photo_path);
    }
}
