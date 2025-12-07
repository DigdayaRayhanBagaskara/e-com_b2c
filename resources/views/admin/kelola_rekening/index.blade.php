@extends('admin.template.main')
@section('title', 'Kelola Rekening')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row justify-content-center">
        <div class="col-sm-12 card p-4 shadow">
            <div class="card-body">
                <div class="">
                    <a href="/admin/kelola_rekening/create" class="btn btn-primary px-5 mb-2">Tambah</a>
                </div>
                @if(session('berhasil'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('berhasil')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('gagal'))
                <<div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('gagal')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Nama Rekening</th>
                                <th class="text-center align-middle">Nomor Rekening</th>
                                <th class="text-center align-middle">Nama Bank</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">{{$row->nama_rekening}}</td>
                                <td class="text-center align-middle">{{$row->nomor_rekening}}</td>
                                <td class="text-center align-middle">{{$row->nama_bank}}</td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/admin/kelola_rekening/{{$row->id}}/edit" class="btn btn-warning">Edit</a>
                                        <form action="/admin/kelola_rekening/{{$row->id}}" method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>

    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
