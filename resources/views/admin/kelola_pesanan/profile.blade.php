@extends('admin.template.main')
@section('title', "Kelola Pesanan - Profile {$user->username}")

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow col-sm-6">
            <form>
                <div class="form-group mb-2">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                </div>
                <hr>
                <div class="form-group mb-2">
                    <center><img style="border-radius:100%" src="{{ Storage::url('foto_users/' . $user->foto) }}" alt="Foto Pengguna" width="250" height="250"></center>
                </div>
                <hr>
                <div class="form-group mb-2">
                    <label for="username">Username</label>
                    <input type="text" value="{{$user->username}}" name="username" id="username" class="form-control" required
                        placeholder="Masukkan Username...">
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="email" readonly value="{{$user->email}}" name="email" id="email" class="form-control" required
                        placeholder="Masukkan Email...">
                </div>
                <div class="form-group mb-2">
                    <label for="no_hp">No. HP</label>
                    <input type="text" value="{{$user->no_hp}}" name="no_hp" id="no_hp" class="form-control" required
                        placeholder="Masukkan No. HP...">
                </div>
                <div class="form-group mb-2">
                    <label for="alamat">Alamat</label>
                    <input type="text" value="{{$user->alamat}}" name="alamat" id="alamat" class="form-control" required
                        placeholder="Masukkan Alamat...">
                </div>
                <hr>
            </form>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
