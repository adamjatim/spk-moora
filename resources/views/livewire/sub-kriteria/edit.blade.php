@section('modals')
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/2 lg:w-1/3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Penjelasan Jenis Parameter</h3>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <h4 class="font-semibold">1. String Tunggal</h4>
                    <p class="text-sm text-gray-600">
                        Digunakan untuk input parameter yang berupa teks atau string. Parameter ini cocok untuk data yang
                        bersifat kategorikal atau deskriptif.
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-semibold">Contoh Penggunaan:</span> Pendidikan: "SMA", "SMK", "D3", "S1".
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Format Input:</span> Masukkan nilai parameter sebagai teks, dipisahkan
                        dengan koma jika ada lebih dari satu nilai. Contoh: <code>SMA, SMK, D3, S1</code>.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold">2. Nominal Tunggal</h4>
                    <p class="text-sm text-gray-600">
                        Digunakan untuk input parameter yang berupa angka tunggal. Parameter ini cocok untuk data numerik
                        yang tidak memerlukan rentang nilai.
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-semibold">Contoh Penggunaan:</span> Jumlah Pengalaman Kerja: <code>1, 2, 3,
                            4</code>.
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Format Input:</span> Masukkan nilai parameter sebagai angka, dipisahkan
                        dengan koma jika ada lebih dari satu nilai. Contoh: <code>1, 2, 3, 4</code>.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold">3. Nominal Range</h4>
                    <p class="text-sm text-gray-600">
                        Digunakan untuk input parameter yang berupa rentang nilai numerik. Parameter ini cocok untuk data
                        yang memiliki batasan minimum dan maksimum.
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-semibold">Contoh Penggunaan:</span> Rentang Usia: <code>18-25</code>, Rentang
                        Gaji: <code>3000000-5000000</code>.
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Format Input:</span> Masukkan nilai minimum dan maksimum sebagai angka.
                        Contoh: Minimum <code>18</code>, Maksimum <code>25</code>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="mt-6 mx-6">
    <x-jet-form-section submit="update">
        <x-slot name="title">
            Edit Sub Kriteria
        </x-slot>

        <x-slot name="description">
            Ubah data sub kriteria parameter beserta nilainya.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <a class="flex items-center text-gray-500 transition-colors duration-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                    href="{{ route('subkriteria.index') }}">
                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            <!-- Dropdown Kode Kriteria -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="kode_kriteria" value="Kode Kriteria" />
                <select id="kode_kriteria" wire:model="kode_kriteria"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Pilih Kode Kriteria</option>
                    @foreach ($kriteriaList as $kriteria)
                        <option value="{{ $kriteria->kode_kriteria }}">{{ $kriteria->kode_kriteria }} -
                            {{ $kriteria->nama_kriteria }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="kode_kriteria" class="mt-2" />
            </div>

            <!-- Input Nama Kriteria Otomatis -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nama_kriteria" value="Nama Kriteria" />
                <x-jet-input id="nama_kriteria" type="text" class="mt-1 block w-full bg-gray-100"
                    wire:model="nama_kriteria" readonly />
                <x-jet-input-error for="nama_kriteria" class="mt-2" />
            </div>

            <!-- Dropdown Parameter Type -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="parameter_type" value="Jenis Parameter" />
                <select id="parameter_type" wire:model="parameter_type"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Pilih Jenis Parameter</option>
                    <option value="string">String Tunggal (untuk teks/kategorikal)</option>
                    <option value="nominal">Nominal Tunggal (untuk angka tunggal)</option>
                    <option value="range">Nominal Range (untuk rentang angka)</option>
                </select>
                <x-jet-input-error for="parameter_type" class="mt-2" />
            </div>

            <!-- Input Parameter Berdasarkan Pilihan -->
            @if ($parameter_type === 'string')
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="parameter_values" value="Parameter (Pisahkan dengan koma)" />
                    <x-jet-input id="parameter_values" wire:model="parameter_values" type="text"
                        class="mt-1 block w-full" placeholder="Contoh: SMA, SMK, D3, S1" />
                    <x-jet-input-error for="parameter_values" class="mt-2" />
                </div>
            @elseif ($parameter_type === 'nominal')
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="parameter_nominal" value="Parameter (Pisahkan dengan koma)" />
                    <x-jet-input id="parameter_nominal" wire:model="parameter_nominal" type="text"
                        class="mt-1 block w-full" placeholder="Contoh: 1, 2, 3, 4" />
                    <x-jet-input-error for="parameter_nominal" class="mt-2" />
                </div>
            @elseif($parameter_type === 'range')
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="parameter_min" value="Parameter Minimum" />
                    <x-jet-input id="parameter_min" wire:model="parameter_min" type="text"
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="parameter_min" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="parameter_max" value="Parameter Maksimum" />
                    <x-jet-input id="parameter_max" wire:model="parameter_max" type="text" class="mt-1 block w-full"
                        placeholder="Opsional" />
                    <x-jet-input-error for="parameter_max" class="mt-2" />
                </div>
            @endif

            <!-- Input Nilai -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nilai" value="Nilai (Pisahkan dengan koma jika lebih dari satu)" />
                <x-jet-input id="nilai" wire:model="nilai" type="text" class="mt-1 block w-full"
                    placeholder="Contoh: 1, 2, 3" />
                <x-jet-input-error for="nilai" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Berhasil Diperbarui.
            </x-jet-action-message>

            <x-jet-button>
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>

@section('scripts')
    <script>
        // Ambil elemen modal dan tombol
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');

        // Fungsi untuk membuka modal
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Fungsi untuk menutup modal
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Tutup modal saat mengklik di luar area modal
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
@endsection
