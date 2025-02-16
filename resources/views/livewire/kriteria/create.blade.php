<div class="mt-6 mx-6">
    <x-jet-form-section submit="store">
        <x-slot name="title">
            Tambah Kriteria
        </x-slot>

        <x-slot name="description">
            Tambah data kriteria penilaian beserta bobotnya.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <a class="flex items-center text-gray-500 transition-colors duration-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                    href="{{ route('kriteria.index') }}">
                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            {{-- input kode --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="kode_kriteria" value="Kode Kriteria" />
                <x-jet-input id="kode_kriteria" wire:model="kode_kriteria" type="text" class="mt-1 block w-full"
                    autofocus />
                <x-jet-input-error for="kode_kriteria" class="mt-2" />
            </div>
            {{-- input nama kriteria --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nama_kriteria" value="Nama Kriteria" />
                <x-jet-input id="nama_kriteria" wire:model="nama_kriteria" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nama_kriteria" class="mt-2" />
            </div>
            {{-- input nilai bobot --}}
            <div class="col-span-6 sm:col-span-4 hidden">
                <x-jet-label for="nilai_bobot" value="Nilai Bobot (WJ)" />
                <x-jet-input id="nilai_bobot" wire:model="nilai_bobot" type="number" step="any"
                    class="mt-1 block w-full" value="" readonly/>
                <x-jet-input-error for="nilai_bobot" class="mt-2" />

            </div>
            {{-- input persen --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="persentase" value="Persentase (%)" />
                <x-jet-input id="persentase" wire:model="persentase" type="number" step="any"
                    class="mt-1 block w-full" />
                <x-jet-input-error for="persentase" class="mt-2" />
            </div>
            {{-- input keterangan --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="keterangan" value="Keterangan" />
                <x-select id="keterangan" wire:model="keterangan" type="text" class="mt-1 block w-full">
                    <option value="" selected class="text-gray-400">Keterangan</option>
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                </x-select>
                <x-jet-input-error for="keterangan" class="mt-2" />
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
