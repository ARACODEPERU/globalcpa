<?php

namespace Modules\Security\Http\Controllers;

use App\Models\User;
use FilesystemIterator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('security::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function storageIndicador()
    {
        //dd(public_path());
        $folderPath = public_path();

        $sizes = $this->getFolderSizeAndTypes($folderPath);

        $totalSizeBytes = $sizes['totalSize'];
        $imageSizeBytes = $sizes['imageSize'];
        $pdfSizeBytes = $sizes['pdfSize'];
        $otherSizeBytes = $sizes['otherSize'];

        $totalSize = $this->formatSize($totalSizeBytes);
        $imageSize = $this->formatSize($imageSizeBytes);
        $pdfSize = $this->formatSize($pdfSizeBytes);
        $otherSize = $this->formatSize($otherSizeBytes);

        return response()->json([
            'totalSize' => $totalSize,
            'imageSize' => $imageSize,
            'pdfSize'   => $pdfSize,
            'otherSize' => $otherSize,
            'disc_space' => env('DISC_SPACE', 20)
        ]);
    }

    function getFolderSizeAndTypes($folderPath)
    {
        $totalSize = 0;
        $imageSize = 0;
        $pdfSize = 0;
        $otherSize = 0;
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath, FilesystemIterator::SKIP_DOTS));

        foreach ($files as $file) {
            $fileSize = $file->getSize();
            $totalSize += $fileSize;
            $extension = strtolower($file->getExtension());

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'tiff', 'svg'])) {
                $imageSize += $fileSize;
            } elseif ($extension === 'pdf') {
                $pdfSize += $fileSize;
            } else {
                $otherSize += $fileSize;
            }
        }

        return [
            'totalSize' => $totalSize,
            'imageSize' => $imageSize,
            'pdfSize' => $pdfSize,
            'otherSize' => $otherSize
        ];
    }

    private function formatSize($bytes)
    {
        $sizeKB = $bytes / 1024;
        $sizeMB = $sizeKB / 1024;
        $sizeGB = $sizeMB / 1024;
        return [
            'bytes' => number_format($bytes, 0),
            'KB' => number_format($sizeKB, 4),
            'MB' => number_format($sizeMB, 4),
            'GB' => number_format($sizeGB, 4)
        ];
    }

    public function usersOnline()
    {
        // cantidad por página (puedes cambiarlo o recibirlo por parámetro)
        $perPage = 10;

        // paginar desde la BD (MUY IMPORTANTE si tienes cientos o miles)
        $users = User::paginate($perPage);

        // transformar la data manteniendo la estructura de la paginación
        $users->getCollection()->transform(function ($user) {

            $online = $user->isOnline();
            $lastActivity = $user->lastActivity();

            return [
                'id' => $user->id,
                'name' => $user->name,
                'online' => $online,
                'last_activity' =>
                    $online
                        ? 'En línea'
                        : ($lastActivity
                            ? \Carbon\Carbon::parse($lastActivity)->diffForHumans()
                            : 'Sin actividad'),
                'avatar' => $user->avatar,
            ];
        });

        return response()->json([
            'usersOnline' => $users
        ]);
    }

}
