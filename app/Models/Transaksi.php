<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mobil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksis';
    protected $primaryKey = 'id';  // Ubah dari $primary ke $primaryKey
    protected $fillable = ['id', 'user_id', 'mobil_id', 'nama', 'ponsel', 'alamat', 'lama', 'tgl_pesan', 'total', 'status'];  // Ubah use_id menjadi user_id

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');  // Pastikan menggunakan user_id
    }

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}