<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="my-5">
            <h2 class="text-2xl font-semibold leading-tight">Tabel Nilai Seleksi Calon Pegawai</h2>

            <div class="mt-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider"
                                    rowspan="2">
                                    No</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider"
                                    rowspan="2">
                                    Nama</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider"
                                    colspan="{{ $kriterias->count() }}">Nilai Seleksi Calon Pegawai</th>
                            </tr>
                            <tr>
                                @foreach ($kriterias as $kriteria)
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-400 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                        {{ $kriteria->kode_kriteria }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calonPegawais as $index => $calonPegawai)
                                <tr class="calon-pegawai-row">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $index + 1 }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm nilai-kriteria">
                                        {{ $calonPegawai->nama }}</td>



                                    @foreach ($kriterias as $kriteria)
                                        @php
                                            $Xij = [];
                                            $colName = strtolower($kriteria->nama_kriteria); // Nama kolom yang dicari
                                            $value = $calonPegawai->$colName ?? 'null'; // Ambil nilai atau tampilkan 'null' jika tidak ada
                                            $nilai = 0;

                                            // Debug kode kriteria untuk memastikan sesuai
                                            $kodeKriteria = $kriteria->kode_kriteria;

                                            // Filter subKriteriaItems dengan kode_kriteria yang sesuai
                                            $subKriteriaItems = $subKriterias->where('kode_kriteria', $kodeKriteria);

                                            $tipePenilaian = $subKriteriaItems->first()->tipe_penilaian ?? null;

                                            if ($value !== 'null') {
                                                // Periksa jika nilai tidak 'null'
                                                if ($tipePenilaian === 'string') {
                                                    $nilai =
                                                        $subKriteriaItems->where('parameter', $value)->first()->nilai ??
                                                        0;
                                                } elseif ($tipePenilaian === 'nominal') {
                                                    $nilai =
                                                        $subKriteriaItems->where('parameter_nominal', $value)->first()
                                                            ->nilai ?? 0;
                                                } elseif ($tipePenilaian === 'range') {
                                                    $rangeItem = $subKriteriaItems
                                                        ->where('parameter_min', '<=', $value)
                                                        ->where('parameter_max', '>=', $value)
                                                        ->first();

                                                    if ($rangeItem) {
                                                        $nilai = $rangeItem->nilai;
                                                    } else {
                                                        $nilai = 0; // Rentang tidak cocok
                                                    }
                                                }
                                            }
                                        @endphp

                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm nilai-kriteria">
                                            {{ $nilai }} <br>
                                            {{-- <span class="text-xs text-gray-500">kodeKriteria: {{ $kodeKriteria }}</span>
                                      <br>
                                      <span class="text-xs text-gray-500">tipePenilaian: {{ $tipePenilaian }}</span>
                                      <br>
                                      <span class="text-xs text-gray-500">colName: {{ $colName }}</span> <br>
                                      <span class="text-xs text-gray-500">Value: {{ $value }}</span> --}}
                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="my-5">
            <h2 class="text-2xl font-semibold leading-tight">Tabel Nilai Normalisasi Data pada tiap kriteria</h2>

            <div class="table-nilai-normalisasi"></div>
        </div>

    </div>
</div>

<script>
    // // Inisialisasi array 2 dimensi untuk menyimpan data kriteria
    // let Xij = [];

    // // Asumsikan setiap baris calon pegawai memiliki class "calon-pegawai-row"
    // // dan setiap kolom nilai kriteria memiliki class "nilai-kriteria"
    // document.querySelectorAll('.calon-pegawai-row').forEach(row => {
    //     // Array sementara untuk nilai kriteria pada calon pegawai saat ini
    //     let nilaiKriteria = [];

    //     // Ambil nilai setiap kriteria dari kolom yang memiliki class "nilai-kriteria"
    //     row.querySelectorAll('.nilai-kriteria').forEach(cell => {
    //         // Parsing nilai ke tipe number dan tambahkan ke array nilaiKriteria
    //         nilaiKriteria.push(Number(cell.textContent.trim()));
    //     });

    //     // Tambahkan array nilaiKriteria ke dalam Xij
    //     Xij.push(nilaiKriteria);
    // });

    // // Cetak array 2 dimensi untuk verifikasi
    // console.log(Xij);



    // Inisialisasi array 2 dimensi untuk menyimpan data kriteria
    let Xij = [];

    // Asumsikan setiap baris calon pegawai memiliki class "calon-pegawai-row"
    // dan setiap kolom nilai kriteria memiliki class "nilai-kriteria"
    document.querySelectorAll('.calon-pegawai-row').forEach((row) => {
        // Array sementara untuk nilai kriteria pada calon pegawai saat ini
        let nilaiKriteria = [];

        // Ambil nilai setiap kriteria dari kolom yang memiliki class "nilai-kriteria"
        row.querySelectorAll('.nilai-kriteria').forEach((cell, rowIndex) => {
            // Jika ini adalah sub-array pertama, push tanpa Number
            // Jika bukan, konversi ke Number sebelum push
            if (rowIndex === 0) {
                nilaiKriteria.push(cell.textContent.trim());
            } else {
                nilaiKriteria.push(Number(cell.textContent.trim()));
            }
        });

        // Tambahkan array nilaiKriteria ke dalam Xij
        Xij.push(nilaiKriteria);
    });

    // Cetak array 2 dimensi untuk verifikasi
    console.log(Xij);

    
</script>
