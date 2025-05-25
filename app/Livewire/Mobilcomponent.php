<?php

namespace App\Livewire;

use App\Models\Mobil;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class Mobilcomponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $addpage = false;
    public $editpage = false;

    public $id, $nopolisi, $merk, $jenis, $kapsitas, $harga, $foto;

    public function render()
    {
        $mobil = Mobil::paginate(10);
        return view('livewire.mobilcomponent', compact('mobil'));
    }

    public function create()
    {
        $this->addpage = true;
    }

    public function store()
    {
        $this->validate([
            'nopolisi' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
            'foto' => 'required|image',
        ], [
            'nopolisi.required' => 'Nomor Polisi Tidak Boleh Kosong!',
            'merk.required' => 'Merek Tidak Boleh Kosong!',
            'jenis.required' => 'Jenis Tidak Boleh Kosong!',
            'harga.required' => 'Harga Tidak Boleh Kosong!',
            'foto.required' => 'Foto Tidak Boleh Kosong!',
            'foto.image' => 'Foto harus dalam format gambar!',
        ]);

        $this->foto->store('mobil', 'public');

        Mobil::create([
            'user_id' => Auth::id(),
            'nopolisi' => $this->nopolisi,
            'merk' => $this->merk,
            'jenis' => $this->jenis,
            'harga' => $this->harga,
            'foto' => $this->foto->hashName(),
        ]);

        session()->flash('success', 'Berhasil simpan data!');
        $this->reset();
    }

    public function edit($id)
    {
        $this->editpage = true;
        $this->id = $id;

        $mobil = Mobil::find($id);

        if ($mobil) {
            $this->nopolisi = $mobil->nopolisi;
            $this->merk = $mobil->merk;
            $this->jenis = $mobil->jenis;
            $this->harga = $mobil->harga;
        }
    }

    public function update()
    {
        $mobil = Mobil::find($this->id);

        if (!$mobil) {
            session()->flash('error', 'Data tidak ditemukan!');
            return;
        }

        if (!empty($this->foto)) {
            $filePath = public_path('storage/mobil/' . $mobil->foto);
            if ($mobil->foto && file_exists($filePath)) {
                unlink($filePath);
            }

            $this->foto->store('mobil', 'public');

            $mobil->update([
                'user_id' => Auth::id(),
                'nopolisi' => $this->nopolisi,
                'merk' => $this->merk,
                'jenis' => $this->jenis,
                'harga' => $this->harga,
                'foto' => $this->foto->hashName(),
            ]);
        } else {
            $mobil->update([
                'user_id' => Auth::id(),
                'nopolisi' => $this->nopolisi,
                'merk' => $this->merk,
                'jenis' => $this->jenis,
                'harga' => $this->harga,
            ]);
        }

        session()->flash('success', 'Berhasil update data!');
        $this->reset();
    }

    public function destroy($id)
    {
        $mobil = Mobil::find($id);

        if (!$mobil) {
            session()->flash('error', 'Data tidak ditemukan!');
            return;
        }

        $filePath = public_path('storage/mobil/' . $mobil->foto);
        if ($mobil->foto && file_exists($filePath)) {
            unlink($filePath);
        }

        $mobil->delete();
        session()->flash('success', 'Berhasil hapus!');
        $this->reset();
    }
}
