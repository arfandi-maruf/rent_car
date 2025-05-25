<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Mobil;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;




class TransaksiComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $addpage, $editpage = false;
    public $nama, $ponsel, $alamat, $lama, $tglpesan, $mobil_id, $harga, $total;
     public $lihatpage = false; // ✅ tambahkan ini
    public $dataTransaksi = []; // ✅ diperlukan untuk menyimpan data transaksis

    public function render()
    {
        $data['mobil'] = Mobil::paginate(5);
        return view('livewire.transaksi-component', $data);
    }
    public function create($id,$harga)
    {
        $this->mobil_id = $id;
        $this->harga = $harga;
        $this->addpage = true;
        $this->hitung(); // agar langsung muncul jika lama sudah terisi
    }
   public function hitung()
    {
    if (is_numeric($this->lama) && is_numeric($this->harga)) {
        $this->total = $this->lama * $this->harga;
    } else {
        $this->total = 0;
    }
    }
    public function updatedLama()
    {
    $this->hitung();
    }

public function store()
{
    $this->validate([
        'nama' => 'required',
        'ponsel' => 'required',
        'alamat' => 'required',
        'lama' => 'required',
        'tglpesan' => 'required|date',
    ], [
        'nama.required' => 'Nama tidak boleh kosong!',
        'ponsel.required' => 'Nomor Ponsel tidak boleh kosong!',
        'alamat.required' => 'Alamat tidak boleh kosong!',
        'lama.required' => 'Lama pesan tidak boleh kosong!',
        'tglpesan.required' => 'Tgl Pesan tidak boleh kosong!',
    ]);
$cari=Transaksi::where('mobil_id',$this->mobil_id)
    ->where('tglpesan', $this->tglpesan)
    ->where('status', '!=', 'completed')->count();
    //dd($cari);
if ($cari == 1) {
    session()->flash('error', 'Mobil Sudah Ada Yang Memesan!');
} else {    
Transaksi::create([
    'user_id' => Auth::user()->id,
    'mobil_id' => $this->mobil_id,
    'nama' => $this->nama,
    'ponsel' => $this->ponsel,
    'alamat' => $this->alamat,
    'lama' => $this->lama, // wajib diisi sesuai kolom NOT NULL di DB
    'tgl_pesan' => $this->tglpesan,
    'total' => $this->total,
    'status' => 'pending'
]);
   
    session()->flash('success', 'Transaksi berhasil disimpan!');
    }
    $this->dispatch('lihat-tansaksi');
    $this->reset();

    }
    public function lihat() 
    {
        $this->dataTransaksi['transaksi'] = Transaksi::paginate(10);
        $this->lihatpage = true;
    }
}