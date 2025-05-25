<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Mobil; // <-- Import Mobil model
use App\Models\User;  // <-- Import User model jika diperlukan

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mobil::class); // Menggunakan foreignIdFor dengan model Mobil
            $table->foreignIdFor(User::class);  // Jika ada relasi dengan User
            $table->string('nama');
            $table->string('ponsel');
            $table->string('alamat');
            $table->integer('lama');
            $table->date('tgl_pesan');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'approved', 'completed']);
            $table->timestamps();
            $table->softDeletes(); // Jika kamu ingin menggunakan soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
