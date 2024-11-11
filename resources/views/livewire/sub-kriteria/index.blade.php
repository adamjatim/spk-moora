<div>

    {{-- tabel data kriteria --}}
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Data Sub Kriteria</h2>
                <x-button-link href="{{ route('subkriteria.create') }}">Tambah Sub Kriteria</x-button-link>
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
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Parameter
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nilai
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subKriteria as $index => $subKrit)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $subKrit->kode_kriteria }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $subKrit->kriteria->nama_kriteria }}
                                    </td>
                                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $subKrit->parameter }}
                                    </td> --}}
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        @if ($subKrit->parameter_min == 0 && $subKrit->parameter_max == 0 && $subKrit->parameter_nominal == 0)
                                            {{ $subKrit->parameter }}
                                        @elseif ($subKrit->parameter == 0 && $subKrit->parameter_max == 0 && $subKrit->parameter_min == 0)
                                            {{ $subKrit->parameter_nominal }}
                                        @elseif ($subKrit->parameter == 0 && $subKrit->parameter_nominal == 0)
                                            {{ $subKrit->parameter_min }} - {{ $subKrit->parameter_max }}
                                        @endif
                                    </td>
                                    {{-- {{ $subKrit->nilai }} --}}
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                        {{ $subKrit->nilai }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center justify-center gap-4">
                                            <a href="{{ route('subkriteria.edit', $subKrit->id) }}"
                                                class="uppercase font-medium text-xs text-gray-700">Edit</a>
                                            <x-jet-button wire:click="delete({{ $subKrit->id }})">Hapus</x-jet-button>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="8">
                                        Data Sub kriteria masih kosong.
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
