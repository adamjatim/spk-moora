<div class="mt-6 mx-6">
    <x-jet-form-section submit="store">
        <x-slot name="title">
            Tambah Sub Kriteria
        </x-slot>

        <x-slot name="description">
            Tambah data sub kriteria parameter beserta nilainya.
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
                    <option value="string">String</option>
                    <option value="nominal">Nominal/Range</option>
                </select>
                <x-jet-input-error for="parameter_type" class="mt-2" />
            </div>

            <!-- Input Parameter Berdasarkan Pilihan -->
            @if ($parameter_type === 'string')
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="parameter_values" value="Parameter (Pisahkan dengan koma)" />
                    <x-jet-input id="parameter_values" wire:model="parameter_values" type="text"
                        class="mt-1 block w-full" placeholder="Contoh: sma, smk, d3, s1" />
                    <x-jet-input-error for="parameter_values" class="mt-2" />
                </div>
            @elseif($parameter_type === 'nominal')
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
                Tersimpan.
            </x-jet-action-message>

            <x-jet-button>
                Simpan
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
