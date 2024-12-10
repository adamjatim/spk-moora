<!-- Pesan Sukses -->
@if (session()->has('message'))
    <div id="toast" class="fixed top-0 right-0 flex m-5 transition ease-in-out delay-300 duration-300">
        <div class="bg-green-200 rounded-lg shadow-lg w-96">
            <div class="px-6 py-4 flex flex-row justify-between items-center">
                <p class="mt-2 text-md text-gray-600">{{ session('message') }}</p>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endif

<!-- Modal Konfirmasi Hapus -->
@if (session()->has('remove-data'))
    <div class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-500/75">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Penghapusan</h2>
                <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak
                    dapat dibatalkan.</p>
                <p class="mt-2 text-sm text-gray-600">Nama : <strong>{{ session('data') }}</strong></p>
            </div>
            <div class="flex justify-end px-6 py-3 bg-gray-50">
                <button wire:click="delete({{ session('idData') }})"
                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-500">Hapus</button>
                <button wire:click="cancelDelete()"
                    class="ml-2 bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Batal</button>
            </div>
        </div>
    </div>
@endif

<div>
    {{-- tabel data calon pegawai --}}
    <div class="container mx-auto px-4 sm:px-8">
        <div class="pt-8 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Data Calon Pegawai</h2>
                <div class="flex items-center justify-between my-auto gap-2">
                    <x-button-link href="{{ route('calon-pegawai.create') }}">Tambah Calon Pegawai</x-button-link>
                </div>

            </div>
            <div class="flex items-center justify-between my-auto gap-2">
                <button wire:click="applyFilter"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-semibold text-xs py-2 px-4 rounded-md uppercase tracking-widest">
                    Pilih Data
                </button>
                {{-- Filter Tahun --}}
                <div class="flex items-center gap-2">
                    <label for="tahun_filter">Pilih Tahun</label>
                    <select id="tahun_filter" wire:change="filterByYear($event.target.value)"
                        class="border border-gray-300 rounded-md py-2 ps-4 pe-5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seluruh Tahun</option>
                        @foreach ($tahun_tersedia as $tahun)
                            <option value="{{ $tahun }}" {{ $tahun == $tahun_filter ? 'selected' : '' }}>
                                {{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Filter
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                No
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Nama Lengkap
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Pendidikan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Pengalaman
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Usia
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Kesehatan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Hasil Tes
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                                Tahun Daftar
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-900 text-white text-center text-xs font-semibold uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($calonPegawais as $pegawai => $alt)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-center text-sm">
                                    <input type="checkbox" class="form-checkbox text-gray-600"
                                        wire:click="toggleFilter({{ $alt->id }})"
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

                        @empty

                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="10">
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

<script>
    const removeToast = document.querySelector('#toast');
    if (removeToast) {
        removeToast.addEventListener('click', () => {
            removeToast.classList.add("hidden", "invisible");
        });
        setTimeout(() => {
            // removeToast.remove();
            removeToast.classList.add("hidden", "invisible");
        }, 5000);
    }
</script>
