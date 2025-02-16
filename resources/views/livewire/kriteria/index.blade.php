<div>

    {{-- tabel data kriteria --}}
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Data Kriteria</h2>
                <x-button-link href="{{ route('kriteria.create') }}">Tambah Kriteria</x-button-link>
            </div>

            <!-- Pesan sukses -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kode Kriteria
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama Kriteria
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider hidden">
                                    Nilai Bobot (WJ)
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Persen
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                {{-- <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Sub Kriteria
                                </th> --}}
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kriterias as $index => $krit)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $krit->kode_kriteria }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $krit->nama_kriteria }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm hidden">
                                        {{ $krit->nilai_bobot }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $krit->persentase }}%
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $krit->keterangan }}
                                    </td>
                                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        <x-button-link
                                            href="{{ route('subkriteria.create', $krit->id) }}">Tambah</x-button-link>
                                    </td> --}}
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('kriteria.edit', $krit->id) }}"
                                                class="uppercase font-medium text-xs text-gray-700">Edit</a>
                                            <x-jet-button wire:click="delete({{ $krit->id }})">Hapus</x-jet-button>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="8">
                                        Data kriteria masih kosong.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
