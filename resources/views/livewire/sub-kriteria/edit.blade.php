<div class="mt-6 mx-6">
    <x-jet-form-section submit="update">
        <x-slot name="title">
            Edit Sub Kriteria
        </x-slot>

        <x-slot name="description">
            Ubah data sub kriteria parameter beserta nilainya.
        </x-slot>

        <x-slot name="form">
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
                    <x-jet-label for="parameter_values" value="Parameter" />
                    <x-jet-input id="parameter_values" wire:model="parameter_values" type="text"
                        class="mt-1 block w-full" placeholder="Parameter" />
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
                Berhasil Diperbarui.
            </x-jet-action-message>

            <x-jet-button>
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>



{{-- <div class="mt-6 mx-6">
	<x-jet-form-section submit="update">
		<x-slot name="title">
			Ubah Kriteria
		</x-slot>

		<x-slot name="description">
			Ubah data kriteria penilaian beserta bobotnya.
		</x-slot>

		<x-slot name="form">
			<div class="col-span-6 sm:col-span-4">
				<x-jet-label for="kode" value="Kode Kriteria" />
				<x-jet-input id="kode" wire:model="sub-kriteria.kode" type="text" class="mt-1 block w-full" autofocus />
				<x-jet-input-error for="kode" class="mt-2" />
			</div>
			<div class="col-span-6 sm:col-span-4">
				<x-jet-label for="name" value="Nama Kriteria" />
				<x-jet-input id="name" wire:model="sub-kriteria.name" type="text" class="mt-1 block w-full" />
				<x-jet-input-error for="name" class="mt-2" />
			</div>
			<div class="col-span-6 sm:col-span-4">
				<x-jet-label for="bobot" value="Bobot Kriteria" />
				<x-jet-input id="bobot" wire:model="sub-kriteria.bobot" type="number" step="any" class="mt-1 block w-full" />
				<x-jet-input-error for="bobot" class="mt-2" />
			</div>
			<div class="col-span-6 sm:col-span-4">
				<x-jet-label for="type" value="Jenis Kriteria" />
				<x-select id="type" wire:model="sub-kriteria.type" type="text" class="mt-1 block w-full">
					<option value="1">Benefit</option>
					<option value="0">Cost</option>
				</x-select>
				<x-jet-input-error for="type" class="mt-2" />
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
</div> --}}
