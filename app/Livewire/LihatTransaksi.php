<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Transaksi;
use Livewire\Attributes\on;

class LihatTransaksi extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[on('lihat-transaksi')]
    public function render()
    {
        $data['transaksi']=transaksi::paginate(10);
        return view('livewire.lihat-transaksi', $data);
    }
   public function approved($id)
{
    $transaksi = Transaksi::find($id);

    if (!$transaksi) {
        session()->flash('error', 'Data transaksi tidak ditemukan.');
        return;
    }

    $transaksi->update([
        'status' => 'approved'
    ]);

    session()->flash('success', 'Berhasil Proses Data!');
}

     public function completed($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => 'completed'
        ]);
        session()->flash('success', 'Berhasil Proses Data!');
}
}
