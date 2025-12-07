@extends('customer.template.main')

@section('content')
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        <div class="card p-4 shadow" > 
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3>Riwayat</h3>
                    <hr>
                </div>
            </div>
            @if(session('berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('berhasil')}}
            </div>
            <script>
                sessionStorage.removeItem('keranjang');
                sessionStorage.removeItem('unik');

            </script>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
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
                                @foreach($pesanan as $p)
                                <tr class="table-body-row">
                                    <td class="text-center align-middle">{{$loop->iteration}}</td>
                                    <td class="text-center align-middle">
                                        {{ \Carbon\Carbon::parse($p->tanggal_pesanan)->format('d M Y | H:i:s') }}</td>
                                    <td class="text-center align-middle">{{$p->users->username}}</td>
                                    <td class="text-center align-middle">{{$p->users->no_hp}}</td>
                                    <td class="text-center align-middle">{{$p->nama_penerima}}</td>
                                    <td class="text-center align-middle">{{$p->lokasi_antar}}</td>
                                    <td class="text-center align-middle">{{'Rp ' . number_format($p->total_bayar)}}</td>
                                    <td class="text-center align-middle">{{$p->status_pesanan}}</td>
                                    <td class="text-center align-middle">
                                        @if($p->status_pesanan == 'diproses')
                                        <a href="/customer/riwayatDetail/{{$p->id}}" class="btn btn-success">detail</a>
                                        <form action="/customer/riwayatHapus/{{$p->id}}" method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Hapus</button>
                                        </form>
                                        @else
                                        <a href="/customer/riwayatDetail/{{$p->id}}" class="btn btn-success">detail</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end cart -->


@endsection
