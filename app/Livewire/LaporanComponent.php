<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LaporanComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $tanggal1, $tanggal2;

    protected $listeners = ['lihat-laporan' => 'render'];

    public function render()
    {
        $data['transaksi'] = ($this->tanggal2 != "")
            ? Transaksi::where('status', 'completed')
                ->whereBetween('tgl_pesan', [$this->tanggal1, $this->tanggal2])
                ->paginate(10)
            : Transaksi::where('status', 'completed')->paginate(10);

        return view('livewire.laporan-component', $data);
    }

    public function cari()
    {
        $this->dispatch('lihat-laporan');
    }

    public function exportpdf()
    {
        if ($this->tanggal2 != "") {
            $data['transaksi'] = Transaksi::where('status', 'completed')
                ->whereBetween('tgl_pesan', [$this->tanggal1, $this->tanggal2])
                ->get();

            $fileName = "laporan_transaksi_" . $this->tanggal1 . "_sampai_" . $this->tanggal2 . ".pdf";
        } else {
            $data['transaksi'] = Transaksi::where('status', 'completed')->get();
            $fileName = "laporan_transaksi_keseluruhan.pdf";
        }

        $pdf = Pdf::loadView('laporan.exportpdf', $data)->output();

        return response()->streamDownload(
            fn () => print($pdf),
            $fileName
        );
    }
}
