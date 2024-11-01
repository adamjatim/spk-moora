<div class="mt-6 mx-6">
    <x-jet-form-section submit="update">
        <x-slot name="title">
            Edit Calon
        </x-slot>

        <x-slot name="description">
            Perbarui data calon yang sudah ada.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <a class="flex items-center text-gray-500 transition-colors duration-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                    href="{{ route('calon-pegawai.index') }}">
                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Input nama alternatif --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nama" value="Nama Calon" />
                <x-jet-input id="nama" wire:model="nama" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nama" class="mt-2" />
            </div>

            {{-- Input pendidikan --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="pendidikan" value="Pendidikan" />
                <select id="pendidikan" wire:model="pendidikan"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" disabled selected>Pilih Pendidikan</option>
                    <option value="SMA">SMA</option>
                    <option value="SMK">SMK</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                </select>
                <x-jet-input-error for="pendidikan" class="mt-2" />
            </div>

            {{-- Input pengalaman --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="pengalaman" value="Pengalaman (Tahun)" />
                <x-jet-input id="pengalaman" wire:model="pengalaman" type="number" class="mt-1 block w-full" />
                <x-jet-input-error for="pengalaman" class="mt-2" />
            </div>

            {{-- Input usia --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="usia" value="Usia" />
                <x-jet-input id="usia" wire:model="usia" type="number" class="mt-1 block w-full" />
                <x-jet-input-error for="usia" class="mt-2" />
            </div>

            {{-- Input kesehatan --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="kesehatan" value="Kesehatan" />

                <!-- Deskripsi Kriteria Kesehatan -->
                <p class="text-sm text-gray-500 mb-3">
                    Penilaian pada masing-masing tanda vital menggunakan penilaian skala likert dengan sub kriteria:
                </p>
                <div class="mx-[1rem]">
                    <ul class="text-sm text-gray-500 mb-4 list-disc ml-5">
                        <li>a. Tekanan darah normal: <strong>90/60 mmHg hingga 120/80 mmHg</strong></li>
                        <li>b. Denyut nadi dan denyut jantung normal: <strong>60 - 100 per menit</strong></li>
                        <li>c. Pernapasan normal: <strong>12 - 20 per menit</strong></li>
                        <li>d. Suhu tubuh normal: <strong>36 - 37 °C</strong></li>
                        <li>e. Berat badan normal (dihitung dengan Indeks Massa Tubuh)</li>
                    </ul>
                </div>

                <select id="kesehatan" wire:model="kesehatan"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" disabled selected>Pilih Kesehatan</option>
                    <option value="1"><=1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">>=5</option>
                </select>
                <x-jet-input-error for="kesehatan" class="mt-2" />
            </div>

            {{-- Input nilai test --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nilai_test" value="Nilai Test" />
                <x-jet-input id="nilai_test" wire:model="nilai_test" type="number" class="mt-1 block w-full" />
                <x-jet-input-error for="nilai_test" class="mt-2" />
            </div>
            {{-- input lainnya dst --}}

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Tersimpan.
            </x-jet-action-message>

            <x-jet-button>
                Simpan
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
