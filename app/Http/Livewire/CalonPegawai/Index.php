<?php

namespace App\Http\Livewire\CalonPegawai;

use App\Models\Alternatif;
use Livewire\Component;

class Index extends Component
{
	public function render()
	{
		$alternatifs = Alternatif::orderBy('kode')->get();

		return view('livewire.calonpegawai.index', compact('alternatifs'));
		// jangan lupa ketik "npm run build" di Windows PowerShell
	}

	public function delete($id)
	{
		Alternatif::find($id)->delete();
	}
}
