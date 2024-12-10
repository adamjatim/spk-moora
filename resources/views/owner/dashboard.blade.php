<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selamat Datang Owner 👋') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Total Calon Pegawai -->
                <div class="bg-sky-700 text-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 h-full flex flex-col justify-between">
                        <div class="text-2xl font-semibold">
                            <span>Total Data Calon Pegawai</span>
                        </div>
                        <div id="total-pegawai" class="mt-4 text-5xl">
                            0
                        </div>
                    </div>
                </div>

                <!-- Total Layak -->
                <div class="bg-green-700 text-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 h-full flex flex-col justify-between">
                        <div class="text-2xl font-semibold">
                            <span>Total Data Calon Pegawai Layak</span>
                        </div>
                        <div id="total-layak" class="mt-4 text-5xl">
                            0
                        </div>
                    </div>
                </div>

                <!-- Total Tidak Layak -->
                <div class="bg-rose-700 text-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 h-full flex flex-col justify-between">
                        <div class="text-2xl font-semibold">
                            <span>Total Data Calon Pegawai Tidak Layak</span>
                        </div>
                        <div id="total-tidak-layak" class="mt-4 text-5xl">
                            0
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Nilai Seleksi -->
            <table
                class="table inline-block min-w-full shadow rounded-lg overflow-hidden leading-normal border-collapse border border-gray-300 mt-4 my-5">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                            Ranking</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                            Nama Calon Pegawai</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                            Nilai Hasil Sistem</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                            Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataHasils as $nilai)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                {{ $nilai['id'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                {{ $nilai['nama_calon'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                {{ $nilai['nilai_yi'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                {{ $nilai['keterangan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row-reverse">
            <a class="px-4 py-2 bg-blue-300 hover:bg-blue-400 rounded-md flex flex-row gap-2 cursor-pointer" href="{{ route('generatePDF') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                </svg>
                Export Data
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>
    <script>
        // Data dari Blade ke JavaScript
        let dataHasils = {!! json_encode($dataHasils) !!};

        // Hitung Total Data, Layak, dan Tidak Layak
        let totalPegawai = dataHasils.length;
        let totalLayak = dataHasils.filter(data => data.keterangan === 'Layak').length;
        let totalTidakLayak = dataHasils.filter(data => data.keterangan === 'Tidak Layak').length;

        // Tampilkan Data di Div
        document.getElementById('total-pegawai').textContent = totalPegawai;
        document.getElementById('total-layak').textContent = totalLayak;
        document.getElementById('total-tidak-layak').textContent = totalTidakLayak;

        // Buat Doughnut Chart
        // const ctx = document.getElementById('pegawai-doughnut-chart').getContext('2d');
        const doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Layak', 'Tidak Layak'],
                datasets: [{
                    data: [totalLayak, totalTidakLayak],
                    backgroundColor: ['#2ecc71', '#e74c3c'],
                }]
            },
            options: {
                plugins: {
                    doughnutlabel: {
                        labels: [{
                                text: 'Total',
                                font: {
                                    size: '20',
                                    weight: 'bold'
                                }
                            },
                            {
                                text: totalPegawai.toString(),
                                font: {
                                    size: '30',
                                    weight: 'bold'
                                },
                                color: '#555'
                            }
                        ]
                    }
                }
            }
        });
    </script>
</x-app-layout>
