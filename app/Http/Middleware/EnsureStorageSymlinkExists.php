<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class EnsureStorageSymlinkExists
{
    public function handle(Request $request, Closure $next): Response
    {
        $this->ensureStorageSymlink();

        return $next($request);
    }

    private function ensureStorageSymlink(): void
    {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Create storage/app/public directory if it doesn't exist
        if (!File::isDirectory($target)) {
            File::makeDirectory($target, 0755, true);
        }

        // If symlink doesn't exist or is broken, create it
        if (!File::exists($link) || !is_link($link)) {
            // Remove existing symlink if it's broken
            if (is_link($link)) {
                unlink($link);
            }

            // On Windows, use relative path or junction
            // On Unix, use symlink
            if (PHP_OS_FAMILY === 'Windows') {
                // Use Windows junction
                $targetAbsolute = realpath($target);
                $linkAbsolute = dirname(realpath(public_path())).DIRECTORY_SEPARATOR.'storage';
                exec("mklink /J \"{$linkAbsolute}\" \"{$targetAbsolute}\"", $output, $returnCode);
                
                if ($returnCode !== 0) {
                    // Fallback: try with PHP symlink (might need Windows 10+)
                    @symlink($target, $link);
                }
            } else {
                symlink($target, $link);
            }
        }
    }
}
