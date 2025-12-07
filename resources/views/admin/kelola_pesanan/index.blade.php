@extends('admin.template.main')
@section('title', 'Kelola Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row justify-content-center">
        <div class="col-sm-12 card p-4 shadow">
            <div class="card-body">
                @if(session('berhasil'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('berhasil')}}
                </div>
                @endif
                @if(session('gagal'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('gagal')}}
                </div>
                @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="example1">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Tanggal Pesanan</th>
                            <th class="text-center align-middle">Nama Pemesan</th>
                            <th class="text-center align-middle">No. Telp</th>
                            <th class="text-center align-middle">Nama Penerima</th>
                            <th class="text-center align-middle">Lokasi Antar</th>
                            <th class="text-center align-middle">Total Bayar</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr class="table-body-row">
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">
                                {{ \Carbon\Carbon::parse($row->tanggal_pesanan)->format('d M Y | H:i:s') }}</td>
                            <td class="text-center align-middle"><a href="/admin/kelola_pesanan/profile-customer/{{$row->users->id}}">{{$row->users->username}}</a></td>
                            <td class="text-center align-middle">{{$row->users->no_hp}}</td>
                            <td class="text-center align-middle">{{$row->nama_penerima}}</td>
                            <td class="text-center align-middle">{{$row->lokasi_antar}}</td>
                            <td class="text-center align-middle">Rp {{ number_format($row->total_bayar, 0, ',', '.') }}</td>
                            <td class="text-center align-middle">{{$row->status_pesanan}}</td>
                            <td class="text-center align-middle">
                                <a href="/admin/kelola_pesanan/{{$row->id}}" class="btn btn-success">Detail</a>
                                <form action="/admin/kelola_pesanan/{{$row->id}}" method="POST"
                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        @endforeach
                        @foreach($selesai as $s)
                        <tr class="table-body-row">
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">
                                {{ \Carbon\Carbon::parse($s->tanggal_pesanan)->format('d M Y | H:i:s') }}</td>
                            <td class="text-center align-middle"><a href="/admin/kelola_pesanan/profile-customer/{{$s->users->id}}">{{$s->users->username}}</a></td>
                            <td class="text-center align-middle">{{$s->users->no_hp}}</td>
                            <td class="text-center align-middle">{{$s->nama_penerima}}</td>
                            <td class="text-center align-middle">{{$s->lokasi_antar}}</td>
                            <td class="text-center align-middle">Rp {{ number_format($s->total_bayar, 0, ',', '.') }}</td>
                            <td class="text-center align-middle">{{$s->status_pesanan}}</td>
                            <td class="text-center align-middle">
                                <a href="/admin/kelola_pesanan/{{$s->id}}" class="btn btn-success">Detail</a>
                                <form action="/admin/kelola_pesanan/{{$s->id}}" method="POST"
                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
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
