@extends('customer.template.main')

@section('content')
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        @if(session('berhasil'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('berhasil')}}
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('gagal'))
        <<div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('gagal')}}
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="card p-4 shadow col-sm-6">
                <h3 class="text-center">Profile {{Auth::user()->username}}</h3>
                <hr>
                <form action="/customer/profile-change/{{$data->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" value="{{$data->username}}" name="username" id="username" class="form-control" required
                            placeholder="Masukkan Username...">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" readonly value="{{$data->email}}" name="email" id="email" class="form-control" required
                            placeholder="Masukkan Email...">
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_hp">No. HP</label>
                        <input type="text" value="{{$data->no_hp}}" name="no_hp" id="no_hp" class="form-control" required
                            placeholder="Masukkan No. HP...">
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" value="{{$data->alamat}}" name="alamat" id="alamat" class="form-control" required
                            placeholder="Masukkan Alamat...">
                    </div>
                    <hr>
                    <div class="form-group mb-2">
                        <center><img style="border-radius:100%" src="{{ Storage::url('foto_users/' . $data->foto) }}" alt="Foto Pengguna" width="250" height="250"></center>
                    </div>
                    <div class="form-group mb-2">
                        <label for="foto">Foto</label>
                        <input type="file" value="{{$data->foto}}" name="foto" id="foto" class="form-control"
                            placeholder="Masukkan Foto...">
                        <p style="color: red; font-style: italic; font-size: 0.875rem;">
                            *Jika ingin mengubah foto, silakan masukkan foto baru pada inputbox di atas
                        </p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">New Password?</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan Password...">
                        <p style="color: red; font-style: italic; font-size: 0.875rem;">
                            *Jika ingin mengubah password, silakan masukkan password baru pada inputbox di atas
                        </p>
                    </div>

                    <div class="form-group mb-2">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
