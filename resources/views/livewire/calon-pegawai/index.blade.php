<div>

    {{-- tabel data calon pegawai --}}
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Data Calon Pegawai</h2>
                <x-button-link href="{{ route('calon-pegawai.create') }}">Tambah Calon Pegawai</x-button-link>
            </div>

            <!-- Pesan Sukses -->
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
                                    Nama Lengkap
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Pendidikan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Pengalaman
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Usia
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kesehatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Hasil Tes
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($calonPegawais as $pegawai => $alt)
                                <tr>
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
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('calon-pegawai.edit', $alt->id) }}"
                                                class="uppercase font-medium text-xs text-gray-700">Ubah</a>
                                            <x-jet-button wire:click="delete({{ $alt->id }})">Hapus</x-jet-button>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="8">
                                        Data calon pegawai masih kosong.
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
