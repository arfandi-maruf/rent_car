<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class UsersComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = "bootstrap";
    public $addpage,$editpage = false;
    public $nama, $email, $password, $role,$id;
    public function render()
    {
        $data['users'] = User::paginate(2);
        return view('livewire.users-component',$data);
    }
    public function create()
    {
        $this->reset();
        $this->addpage = true;
    }
    public function store()
    {
        $this->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'role'=>'required',
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
            'email.required' => 'email Tidak Boleh Kosong!',
            'email.email' => 'format email salah!',
            'password.required' => 'password Tidak Boleh Kosong!',
            'role.required' => 'role Tidak Boleh Kosong!',
        ]);
        User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);
        session()->flash('success', 'Berhasil Simpan Data!');
        $this->reset();
    }
    public function destory($id){
        $cari=User::find($id);
        $cari->delete();
        session()->flash('success','Berhasil Hapus Data!');
        $this->reset();
    }
    public function edit($id)
    {
        $this->reset();
        $cari = User::find($id);
        $this->nama = $cari->name;
        $this->email = $cari->email;
        $this->role = $cari->role;
        $this->id = $cari->id;
        $this->editpage = true;
    }
    public function update()
    {
        $cari = User::find($this->id);
        if ($this->password== "")
        {
            $cari->update([
                'name'=> $this->nama,
                'email' => $this->email,
                'role'=> $this->role,
            ]);
        }else {
            $cari->update([
                'name'=> $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role'=> $this->role,
            ]);
        }
        session()->flash('success','Berhasil Ubah Data!');
        $this->reset();
    }
    }
