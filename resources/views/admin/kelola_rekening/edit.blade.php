@extends('admin.template.main')
@section('title', 'Kelola Rekening - Ubah Data')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow col-sm-6">
            <form action="/admin/kelola_rekening/{{$rekening->id}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group mb-2">
                    <label for="nama_rekening">Nama Rekening</label>
                    <input type="text" value="{{$rekening->nama_rekening}}" name="nama_rekening" id="nama_rekening" class="form-control" required
                        placeholder="Masukkan Nama Rekening...">
                </div>
                <div class="form-group mb-2">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input type="text" value="{{$rekening->nomor_rekening}}" name="nomor_rekening" id="nomor_rekening" class="form-control" required
                        placeholder="Masukkan Nomor Rekening...">
                </div>
                <div class="form-group mb-2">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" value="{{$rekening->nama_bank}}" name="nama_bank" id="nama_bank" class="form-control" required
                        placeholder="Masukkan Nama Bank...">
                </div>
                <div class="form-group mb-2">
                    <a href="/admin/kelola_rekening" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
