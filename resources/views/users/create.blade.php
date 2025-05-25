<!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">ADD Users</h6>
                            <form>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" wire:model="nama" id="nama" value="{{ @old('nama') }}">
                                    @error('nama')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control"  wire:model="email" id="email" value="{{ @old('email') }}">
                                    @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                <div class="mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control"  wire:model="password" id="Password" value="{{ @old('password') }}">
                                     @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select id="role" class="form-select"  wire:model="role">
                                        <option value="">--pilih--</option>
                                        <option value="admin">admin</option>
                                        <option value="pemilik">pemilik</option>
                                    </select>
                                     @error('role')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="button" wire:click="store" class="btn btn-primary">Sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>