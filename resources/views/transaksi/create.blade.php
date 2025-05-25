<!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Transaksi</h6>
                            <form>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" wire:model="nama" id="nama" value="{{ @old('nama') }}">
                                    @error('nama')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ponsel" class="form-label">Nomor Ponsel Pemesan</label>
                                    <input type="text" class="form-control" wire:model="ponsel" id="ponsel" value="{{ @old('ponsel') }}">
                                    @error('ponsel')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                 <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Pemesan</label>
                                    <input type="text" class="form-control" wire:model="alamat" id="alamat" value="{{ @old('alamat') }}">
                                    @error('alamat')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lama" class="form-label">Lama Pemesan</label>
                                    <input type="number" class="form-control" wire:change.live="hitung" wire:model="lama" id="lama" value="{{ @old('lama') }}">
                                    @error('lama')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tglpesan" class="form-label">Tanggal Pemesan</label>
                                    <input type="date" class="form-control" wire:model="tglpesan" id="tglpesan" value="{{ @old('tglpesan') }}">
                                    @error('tglpesan')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Harga per Hari</label>
                                    <input type="text" class="form-control" value="Rp {{ number_format($harga, 0, ',', '.') }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Harga</label>
                                    <input type="text" class="form-control fw-bold" value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                                </div>

                                <button type="button" wire:click="store" class="btn btn-primary">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>