@extends('admin.template.main')
@section('title', 'Kelola Menu - Tambah Data')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow col-sm-6">
            <form action="/admin/kelola_menu" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="nama_menu">Nama</label>
                    <input type="text" name="nama_menu" id="nama_menu" class="form-control" required
                        placeholder="Masukkan Nama...">
                </div>
                <div class="form-group mb-2">
                    <label for="harga_menu">Harga</label>
                    <input type="text" name="harga_menu" id="harga_menu" class="form-control" required
                        placeholder="Masukkan Harga...">
                </div>
                <div class="form-group mb-2">
                    <label for="jenis_menu">Jenis</label>
                    <select name="jenis_menu" id="jenis_menu" class="form-control" required>
                        <option value=""><-- Silahkan dipilih! --></option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="deskripsi_menu">Deskripsi</label>
                    <input type="text" name="deskripsi_menu" id="deskripsi_menu" class="form-control" required
                        placeholder="Masukkan Deskripsi...">
                </div>
                <div class="form-group mb-2">
                    <label for="foto_menu">Foto</label>
                    <input type="file" name="foto_menu" id="foto_menu" class="form-control" required
                        placeholder="Masukkan Foto...">
                </div>
                <div class="form-group mb-2">
                    <label for="stok_menu">Stok</label>
                    <input type="text" name="stok_menu" id="stok_menu" class="form-control" required
                        placeholder="Masukkan Stok...">
                </div>
                <div class="form-group mb-2">
                    <a href="/admin/kelola_menu" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
