<?php

namespace App\Http\Livewire\CalonPegawai;

use Livewire\Component;
use App\Models\CalonPegawai;

class Index extends Component
{
    public function render()
    {
        // Mengambil semua data calon pegawai
        $calonPegawais = CalonPegawai::all();

        return view('livewire.calon-pegawai.index', [
            'calonPegawais' => $calonPegawais,
        ]);
    }

    // Fungsi untuk menghapus calon pegawai
    public function delete($id)
    {
        $calonPegawai = CalonPegawai::find($id);
        $calonPegawai->delete();

        session()->flash('message', 'Data calon pegawai berhasil dihapus.');
    }
}
