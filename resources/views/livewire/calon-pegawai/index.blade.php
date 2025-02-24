<div>

    {{-- tabel data calon pegawai --}}
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Data Calon Pegawai</h2>
                <div class="flex items-center justify-between my-auto gap-2">
                    <x-button-link class="gap-2" href="{{ route('calon-pegawai.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                        </svg>
                        <span>Tambah Calon Pegawai</span>
                    </x-button-link>
                    {{-- <form action="{{ route('calon-pegawai.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex items-center space-x-4">
                        @csrf
                        <input type="file" name="file" accept=".xlsx, .xls" class="border p-2 rounded-lg">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Import Excel
                        </button>
                    </form> --}}
                    <div>
                        <button wire:click="importExcel"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36">
                                <path fill="currentColor"
                                    d="M28 4H14.87L8 10.86V15h2v-1.39h7.61V6H28v24H8a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m-12 8h-6v-.32L15.7 6h.3Z"
                                    class="clr-i-outline clr-i-outline-path-1" />
                                <path fill="currentColor"
                                    d="M11.94 26.28a1 1 0 1 0 1.41 1.41L19 22l-5.68-5.68a1 1 0 0 0-1.41 1.41L15.2 21H3a1 1 0 1 0 0 2h12.23Z"
                                    class="clr-i-outline clr-i-outline-path-2" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                            <span>Import Excel</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between my-auto mt-2">
                <div class="flex flex-row gap-2">
                    <button
                        wire:click="toggleSelectAll(
                          @if (!$tahun_filter) {{ '0' }}@else ($tahun_filter){{ $tahun_filter }} @endif)"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold text-xs py-2 px-4 rounded-md uppercase tracking-widest flex flex-row gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M9.854 5.854a.5.5 0 0 0-.708-.708L6.5 7.793L5.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0zM2 4.5A2.5 2.5 0 0 1 4.5 2h5A2.5 2.5 0 0 1 12 4.5v5A2.5 2.5 0 0 1 9.5 12h-5A2.5 2.5 0 0 1 2 9.5zM4.5 3A1.5 1.5 0 0 0 3 4.5v5A1.5 1.5 0 0 0 4.5 11h5A1.5 1.5 0 0 0 11 9.5v-5A1.5 1.5 0 0 0 9.5 3zM7 14a2.5 2.5 0 0 1-2-1h4.5A3.5 3.5 0 0 0 13 9.5V4c.607.456 1 1.182 1 2v3.5A4.5 4.5 0 0 1 9.5 14z" />
                        </svg>
                        Pilih semua data
                    </button>
                    <button wire:click="applyFilter"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold text-xs py-2 px-4 rounded-md uppercase tracking-widest flex flex-row gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0s.41-1.08 0-1.49zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14" />
                        </svg>
                        Pilih Data
                    </button>
                </div>
                <div class="flex gap-4 items-center">
                    <label for="tahun_filter">Pilih Tahun</label>
                    <select id="tahun_filter" wire:change="filterByYear($event.target.value)"
                        class="border border-gray-300 rounded-md py-2 ps-4 pe-5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seluruh Tahun</option>
                        @foreach ($tahun_tersedia as $tahun)
                            <option value="{{ $tahun }}" {{ $tahun == $tahun_filter ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session()->has('message'))
                <div id="toast"
                    class="fixed top-0 right-0 flex m-5 transition ease-in-out delay-300 duration-300 cursor-default">
                    <div class="text-green-800 bg-green-50 rounded-lg shadow-lg w-96">
                        <div class="px-6 py-4 flex flex-row justify-between items-center">
                            <div class="flex flex-col">
                                <p class="mt-2 text-md ">{{ session('message') }}</p>
                                @if (session()->has('filterSuccess'))
                                    <a href="{{ route('penilaian.index') }}"
                                        class="flex flex-row mt-2 gap-3 cursor-pointer text-md bg-green-600 hover:bg-green-700 text-gray-100 px-4 py-2 items-center rounded-md">
                                        {{ session('filterSuccess') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 15 15">
                                            <path fill="currentColor"
                                                d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                            <button id="closeToast">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div id="animatedDiv" class="h-1 bg-green-300 rounded-lg"></div>
                    </div>

                    <script>
                        const animatedDiv = document.getElementById("animatedDiv");
                        let currentWidth = 100; // Start at 100%

                        // Gradually decrease the width of the progress bar
                        const interval = setInterval(() => {
                            currentWidth -= 1; // Decrease width by 1% per step
                            animatedDiv.style.width = currentWidth + "%";

                            if (currentWidth <= 0) {
                                clearInterval(interval); // Stop the interval when width reaches 0%
                                removeToast(); // Remove the toast once animation is complete
                            }
                        }, 40); // 40ms per step for 4000ms total (100 steps)

                        // Close the toast on button click
                        const removeToastButton = document.getElementById('closeToast');
                        removeToastButton.addEventListener('click', () => {
                            clearInterval(interval); // Stop the width animation
                            removeToast();
                        });

                        // Function to remove the toast
                        function removeToast() {
                            const toast = document.getElementById('toast');
                            if (toast) {
                                toast.remove();
                            }
                        }

                        // Auto-remove the toast after 4 seconds if not closed manually
                        setTimeout(() => {
                            removeToast();
                        }, 4000);
                    </script>
                </div>
            @endif

            <!-- Modal Konfirmasi Penghapusan -->
            <div>
                <x-jet-modal wire:model="confirmingDelete">
                    <div class="px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Penghapusan</h2>
                        <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus data ini? Tindakan ini
                            tidak dapat dibatalkan.</p>
                        <p class="mt-2 text-sm text-gray-600">Nama: <strong>{{ $dataToDelete['nama'] ?? '' }}</strong>
                        </p>
                    </div>

                    <div class="flex justify-end px-6 py-3 bg-gray-50">
                        <button wire:click="deleteData({{ $dataToDelete['id'] ?? '' }})"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-500">
                            Hapus
                        </button>
                        <button {{-- wire:click="$set('confirmingDelete', false)" --}} wire:click="redirectIndex"
                            class="ml-2 bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </button>
                    </div>
                </x-jet-modal>
            </div>

            <!-- Modal Import data Excel -->
            <div>
                <x-jet-modal wire:model="importingExcel">
                    <div class="px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">Import Data Excel</h2>
                        <p class="mt-2 text-sm text-gray-600">*Pastikan data excel memiliki kolom seperti : </p>
                        <div class="flex flex-row rounded-md border ">
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">nama</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">pendidikan</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">pengalaman</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">usia</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">kesehatan</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">hasil_test</p>
                            <p class="py-2 px-3 border w-auto grow text-sm text-gray-600">tahun_daftar</p>
                        </div>
                    </div>
                    <form action="{{ route('calon-pegawai.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col">
                        @csrf
                        {{-- <input type="file" name="file" accept=".xlsx, .xls" class="border p-2 rounded-lg mx-6 mb-3 active:border-gray-500"> --}}

                        <div class="px-6 pb-3">
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload file</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 p-2"
                                aria-describedby="file_input_help" id="file_input" type="file" name="file"
                                accept=".xlsx, .xls">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Format file
                                harus
                                : <strong>.xlsx</strong>, <strong>.xls</strong></p>
                        </div>

                        <div class="flex justify-end px-6 py-3 bg-gray-50">
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Import Excel
                            </button>
                            <button {{-- wire:click="$set('confirmingDelete', false)" --}} wire:click="redirectIndex"
                                class="ml-2 bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                                Batal
                            </button>

                        </div>
                    </form>
                </x-jet-modal>
            </div>


            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table id="calonPegawaiTable" class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                    Filter
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Nama Lengkap
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Pendidikan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Pengalaman
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Usia
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Kesehatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Hasil Tes
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                    Tahun Daftar
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold  uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calonPegawais as $pegawai => $alt)
                                <tr>
                                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        <input type="checkbox" class="form-checkbox text--gray-600" id="applyFilterButton"
                                            wire:click="toggleFilter({{ $alt->id }},
                                            @if (!$tahun_filter) {{ 'null' }}
                                            @else ($tahun_filter){{ $tahun_filter }} @endif)"
                                            {{ $alt->filter === 'true' ? 'checked' : '' }}>
                                    </td> --}}
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        <input type="checkbox" class="form-checkbox text-gray-600 candidate-checkbox"
                                            wire:click="toggleFilter({{ $alt->id }},
                                          @if (!$tahun_filter) {{ 'null' }} @else ($tahun_filter){{ $tahun_filter }} @endif)"
                                            {{ $alt->filter === 'true' ? 'checked' : '' }}>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $pegawai + 1 }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->nama }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->pendidikan }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->pengalaman }}
                                        <span> Tahun</span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->usia }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->kesehatan }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->nilai_test }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $alt->tahun_daftar }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('calon-pegawai.edit', $alt->id) }}"
                                                class="uppercase font-medium text-xs text-gray-700">Ubah</a>
                                            <x-jet-button
                                                wire:click="confirmDelete({{ $alt->id }})">Hapus</x-jet-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <tr>
  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="10">
      Data calon pegawai masih kosong.
  </td>
</tr> --}}

@section('scripts')

<script>
  $(document).ready(function() {

      $('#calonPegawaiTable').DataTable({
          pageLength: 50, // Atur jumlah data per halaman
          language: {
              url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" || "/id.json" // Bahasa Indonesia
          },
          responsive: true,
          autoWidth: false,
          order: [
              [1, 'asc'] // Urutkan berdasarkan kolom usia terkecil
          ],
      });
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const applyFilterButton = document.querySelector("[wire\\:click='applyFilter']");

    applyFilterButton.addEventListener("click", function (event) {
        let selectedCount = 0;

        document.querySelectorAll(".candidate-checkbox").forEach((checkbox) => {
            if (checkbox.checked) {
                selectedCount++;
            }
        });

        if (selectedCount < 10) {
            // alert("Terjadi kesalahan, data yang dipilih minimal 10 Alternatif. Alternatif terpilih saat ini : " + selectedCount);
            event.preventDefault(); // Mencegah eksekusi Livewire jika kurang dari 10
        }
    });
});
</script>
@endsection
