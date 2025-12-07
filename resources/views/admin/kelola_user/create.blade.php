@extends('admin.template.main')
@section('title', 'Kelola User - Tambah Data')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow col-sm-6">
            <form action="/admin/kelola_user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required
                        placeholder="Masukkan Username...">
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required
                        placeholder="Masukkan Email...">
                </div>
                <div class="form-group mb-2">
                    <label for="no_hp">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" required
                        placeholder="Masukkan No. HP...">
                </div>
                <div class="form-group mb-2">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required
                        placeholder="Masukkan Alamat...">
                </div>
                <div class="form-group mb-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control"
                        placeholder="Masukkan Foto...">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required
                        placeholder="Masukkan Password...">
                </div>
                <div class="form-group mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="Customer">Customer</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <a href="/admin/kelola_user" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
