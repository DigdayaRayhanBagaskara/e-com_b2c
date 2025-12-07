@extends('admin.template.main')
@section('title', 'Kelola Menu - Ubah Data')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow col-sm-6">
            <form action="/admin/kelola_menu/{{$menu->id}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('put')
                <div class="form-group mb-2">
                    <label for="nama_menu">Nama</label>
                    <input type="text" value="{{$menu->nama_menu}}" name="nama_menu" id="nama_menu" class="form-control" required
                        placeholder="Masukkan Nama...">
                </div>
                <div class="form-group mb-2">
                    <label for="harga_menu">Harga</label>
                    <input type="text" value="{{$menu->harga_menu}}" name="harga_menu" id="harga_menu" class="form-control" required
                        placeholder="Masukkan Harga...">
                </div>
                <div class="form-group mb-2">
                    <label for="jenis_menu">Jenis</label>
                    <select name="jenis_menu" id="jenis_menu" class="form-control" required>
                        <option value="">← Silahkan dipilih! →</option>
                        <option value="Makanan" {{ $menu->jenis_menu == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ $menu->jenis_menu == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="deskripsi_menu">Deskripsi</label>
                    <input type="text" value="{{$menu->deskripsi_menu}}" name="deskripsi_menu" id="deskripsi_menu" class="form-control" required
                        placeholder="Masukkan Deskripsi...">
                </div>
                <div class="form-group mb-2 row ">
                    <div class="col-sm-4 d-flex justify-content-center align-items-center">
                        <img src="{{ Storage::url('foto_menu/' . $menu->foto_menu) }}" alt="Foto Menu" width="150" height="150">
                    </div>
                    <div class="col-sm-8 d-flex flex-column justify-content-center">
                        <label for="foto_menu">Foto</label>
                        <input type="file" name="foto_menu" id="foto_menu" class="form-control">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="stok_menu">Stok</label>
                    <input type="text" value="{{$menu->stok_menu}}" name="stok_menu" id="stok_menu" class="form-control" required
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
