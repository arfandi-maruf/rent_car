<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                @if (@session()->has('succes'))
                <div class="alert alert-succes" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th>
                                Proses
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role }}</td>
                                <td>
                    <button class="btn btn-info" wire:click="edit({{ $data->id }})">Edit</button>
                    <button class="btn btn-danger" wire:click="destory({{ $data->id }})">Delete</button>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
                <button wire:click="create" class="btn btn-primary">TAMBAH</button>
                @if ($addpage)
                    @include('users.create')
                @endif
            </div>
        </div>
    </div>
    @if ($editpage)
        @include('users.edit')
    @endif
</div>
