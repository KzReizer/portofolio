<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Ensure storage/app/public exists
        $storagePath = storage_path('app/public');
        if (!File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Ensure public/storage symlink exists
        $linkPath = public_path('storage');
        if (!File::exists($linkPath) || !is_link($linkPath)) {
            if (is_link($linkPath)) {
                unlink($linkPath);
            }

            if (PHP_OS_FAMILY === 'Windows') {
                $targetAbsolute = realpath($storagePath);
                $linkAbsolute = realpath(public_path()).DIRECTORY_SEPARATOR.'storage';
                @exec("mklink /J \"{$linkAbsolute}\" \"{$targetAbsolute}\"");
                @symlink($storagePath, $linkPath);
            } else {
                @symlink($storagePath, $linkPath);
            }
        }
    }
}
