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
                                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-center text-sm">
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
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm nilai-kriteria">
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

            <div class="table-nilai-normalisasi inline-block min-w-full shadow rounded-lg overflow-hidden mt-4"></div>
        </div>

        <div class="my-5">
            <h2 class="text-2xl font-semibold leading-tight">Tabel Perkalian Data Matriks</h2>

            <div class="table-perkalian-matriks inline-block min-w-full shadow rounded-lg overflow-hidden mt-4"></div>
        </div>

        <div class="my-5">
            <h2 class="text-2xl font-semibold leading-tight">Tabel Perhitungan Yi</h2>

            <div class="table-perhitungan-yi inline-block min-w-full shadow rounded-lg overflow-hidden mt-4"></div>
        </div>

    </div>
</div>

<script>
    // #################################################
    // Get data and insert into arrays
    // #################################################
    let Xij = [],
        MatrixXij = [],
        MatrixXijYij;

    // Ambil setiap baris calon pegawai
    document.querySelectorAll('.calon-pegawai-row').forEach((row) => {
        let nilaiKriteria = [];

        // Ambil nilai setiap kriteria dari kolom yang memiliki class "nilai-kriteria"
        row.querySelectorAll('.nilai-kriteria').forEach((cell, index) => {
            // Sub-array pertama tetap sebagai string (nama), yang lainnya konversi ke Number
            if (index === 0) {
                nilaiKriteria.push(cell.textContent.trim());
            } else {
                nilaiKriteria.push(Number(cell.textContent.trim()));
            }
        });

        Xij.push(nilaiKriteria);
    });

    // #################################################
    // Proccess create table with data from Xij table
    // #################################################

    // Calculate square root sums for normalization, starting from index 1 to skip names
    let sqrtSums = Array(Xij[0].length).fill(0);
    Xij.forEach(row => {
        row.forEach((value, colIndex) => {
            if (colIndex > 0) { // Skip name column for sqrt calculation
                sqrtSums[colIndex] += value ** 2;
            }
        });
    });
    sqrtSums = sqrtSums.map(sum => sum > 0 ? Math.sqrt(sum) : 1); // Avoid dividing by zero

    // Normalize each numeric value by the square root sum of its column
    let normalizedMatrix = Xij.map((row, rowIndex) => {
        return row.map((value, colIndex) => {
            if (colIndex === 0) return value; // Keep names as-is
            let normalizedValue = (value / sqrtSums[colIndex]).toFixed(4);
            return `A${rowIndex + 1}${colIndex} = ${value}/${sqrtSums[colIndex].toFixed(4)} = ${normalizedValue}`;
        });
    });

    // Generate HTML table for normalized data, including calculation row at the bottom
    function generateTable(matrix) {
        let tableHTML = `<table class="min-w-full leading-normal rounded-lg pt-4">`;
        tableHTML +=
            `<thead><tr><th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider" rowspan="2">No</th><th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider" rowspan="2">Nama</th>`;

        // Add dynamic headers
        for (let i = 1; i < matrix[0].length; i++) {
            tableHTML +=
                `<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">C${i}</th>`;
        }
        tableHTML += `</tr>`;

        // Add calculation row
        tableHTML += `<tr>`;
        for (let colIndex = 1; colIndex < sqrtSums.length; colIndex++) {
            // Build the formula string
            let formula = Xij.map(row => `${row[colIndex]}<sup>2</sup>`).join(" + ");
            tableHTML +=
                `<th class="px-5 py-5 border-b border-gray-200 bg-gray-100 text-center text-sm">&radic;<span style="text-decoration:overline;">${formula}</span> = &radic;<span style="text-decoration:overline;">${(sqrtSums[colIndex] ** 2).toFixed(0)}</span> = ${sqrtSums[colIndex].toFixed(4)}</th>`;
        }

        tableHTML += `</tr></thead><tbody>`;

        // Populate table rows with normalized data
        matrix.forEach((row, rowIndex) => {
            tableHTML +=
                `<tr><td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">${rowIndex + 1}</td>`;
            row.forEach(cell => tableHTML +=
                `<td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">${cell}</td>`);
            tableHTML += `</tr>`;
        });

        tableHTML += `</tbody></table>`;
        return tableHTML;
    }

    // Render the table in HTML
    document.querySelector('.table-nilai-normalisasi').innerHTML = generateTable(normalizedMatrix);




    // #################################################
    // Proccess create table with data from Xij table
    // #################################################

    // Initialize weights (bobot) and prepare the multiplication matrix
    const bobot = {!! json_encode($kriterias->pluck('nilai_bobot')->toArray()) !!};

    // Multiply normalized matrix values by weights and store in a new matrix array
    let multiplicationMatrix = normalizedMatrix.map(row => {
        let rowArray = []; // Temporary array for the current row
        row.forEach((value, colIndex) => {
            if (colIndex === 0) {
                // Skip name column; add the original name to the row
                rowArray.push(value);
                return;
            }
            let numericValue = parseFloat(value.split(" = ").pop()); // Get the normalized numeric value
            rowArray.push(numericValue.toFixed(4)); // Add the value to the row array
        });
        MatrixXij.push(rowArray); // Add the processed row to MatrixXij
        return row.map((value, colIndex) => {
            if (colIndex === 0) return value; // Keep the name as-is
            let numericValue = parseFloat(value.split(" = ").pop());
            return (numericValue * (bobot[colIndex - 1])).toFixed(4); // Multiply by weight
        });
    });

    // Log MatrixXij to see the result
    console.log(MatrixXij);




    // #################################################
    // Generate HTML table for multiplication matrix with numericValue and bobot testing
    // #################################################

    function generateMultiplicationTable(matrix) {
        let tableHTML = `<table class="min-w-full leading-normal rounded-lg pt-4">`;
        tableHTML +=
            `<thead><tr><th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">No</th><th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">Nama</th>`;

        // Add headers for each criterion
        for (let i = 1; i < matrix[0].length; i++) {
            tableHTML +=
                `<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">C${i}</th>`;
        }
        tableHTML += `</tr></thead><tbody>`;

        // Iterate through each row in the matrix
        matrix.forEach((row, rowIndex) => {
            tableHTML +=
                `<tr><td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">${rowIndex + 1}</td>`;

            row.forEach((cell, colIndex) => {
                tableHTML +=
                    `<td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">`;

                if (colIndex > 0) { // Skip the name column
                    let weight = bobot[colIndex - 1]; // Get corresponding weight
                    let numericValue = (parseFloat(MatrixXij[rowIndex][colIndex])); // Parse numeric value
                    let multipliedValue = (numericValue * weight).toFixed(4); // Multiply and format

                    // Display numericValue, bobot, and result of multiplication
                    tableHTML += `${numericValue} * ${weight} = ${multipliedValue}`;
                } else {
                    // Display name as it is in the first column
                    tableHTML += cell;
                }

                tableHTML += `</td>`;
            });

            tableHTML += `</tr>`;
        });

        tableHTML += `</tbody></table>`;
        return tableHTML;
    }

    // Render the multiplication matrix table in HTML
    // document.querySelector('.table-perkalian-matriks').innerHTML = generateMultiplicationTable(multiplicationMatrix);
    document.querySelector('.table-perkalian-matriks').innerHTML = generateMultiplicationTable(MatrixXij);




    // #################################################
    // Store multiplicationMatrix in an array variable for further processing
    // #################################################

    console.log(bobot);
</script>
