<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import User model
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mobils';
    protected $primaryKey = 'id'; // Pastikan ini adalah primary key yang benar
    protected $fillable = ['id', 'user_id', 'nopolisi', 'merk', 'jenis', 'kapasitas', 'harga', 'foto']; // Perbaiki use_id menjadi user_id

    public function user(): BelongsTo
    {
        // Perbaiki relasi dengan User
        return $this->belongsTo(User::class, 'user_id'); // Gantilah 'user_id' sesuai dengan nama kolom foreign key
    }
}