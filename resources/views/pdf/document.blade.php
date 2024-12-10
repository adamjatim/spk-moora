<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Styles -->
    @livewireStyles
    <style></style>
</head>

<body class="">
    <div class="min-h-screen bg-gray-100">
        <h1 class="text-center font-bold" style="font-size: 1.25rem; font-weight:1.5rem">{{ $title }}
        </h1>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row gap-4">
                    <!-- Total Calon Pegawai -->
                    <div id="total-pegawai" class="mt-4 text-5xl">
                      Total Data Calon Pegawai : {{ $totals['totalPegawai'] }}
                    </div>

                    <!-- Total Layak -->
                    <div id="total-layak" class="mt-4 text-5xl">
                      Total Data Calon Pegawai Layak : {{ $totals['totalLayak'] }}
                    </div>

                    <!-- Total Tidak Layak -->
                    <div id="total-tidak-layak" class="mt-4 text-5xl">
                      Total Data Calon Pegawai Tidak Layak : {{ $totals['totalTidakLayak'] }}
                    </div>
                </div>

                <!-- Tabel Nilai Seleksi -->
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; margin-top: 2rem;">
                    <thead>
                        <tr>
                            <th style="padding: 8px; border: 1px solid #ddd;">Ranking</th>
                            <th style="padding: 8px; border: 1px solid #ddd;">Nama Calon Pegawai</th>
                            <th style="padding: 8px; border: 1px solid #ddd;">Nilai Hasil Sistem</th>
                            <th style="padding: 8px; border: 1px solid #ddd;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataHasils as $nilai)
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd;">{{ $nilai['id'] }}</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">{{ $nilai['nama_calon'] }}</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">{{ $nilai['nilai_yi'] }}</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">{{ $nilai['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
