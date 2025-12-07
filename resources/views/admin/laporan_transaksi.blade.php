@extends('admin.template.main')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row justify-content-center">
        <div class="col-sm-12 card p-4 shadow">
            <form action="/admin/laporan_transaksi/cetak" style="margin-left: -20px;" target="_blank" method="POST">
                <div class="mb-2 ml-3 d-flex">
                    <button class="btn btn-success ml-auto" type="submit">Cetak</button>
                </div>
                <hr>
                @csrf
                <div class="row align-items-center ml-1 mb-2">
                    <div class="col-sm-8 d-flex align-items-center">
                        <label for="tanggal_mulai" class="mr-2">Mulai: </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                            class="form-control mr-3">

                        <label for="tanggal_selesai" class="mr-2">Selesai: </label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                            class="form-control">
                    </div>
                </div>
            </form>
            <div class="card-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr class="table-body-row">
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">
                                    {{ \Carbon\Carbon::parse($row->tanggal_pesanan)->format('d M Y | H:i:s') }}
                                </td>
                                <td class="text-center align-middle">{{$row->users->username}}</td>
                                <td class="text-center align-middle">{{$row->users->no_hp}}</td>
                                <td class="text-center align-middle">{{$row->nama_penerima}}</td>
                                <td class="text-center align-middle">{{$row->lokasi_antar}}</td>
                                <td class="text-center align-middle">Rp {{ number_format($row->total_bayar, 0, ',', '.') }}</td>
                                <td class="text-center align-middle">{{$row->status_pesanan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data = @json($data);
        var tanggalMulaiInput = document.getElementById('tanggal_mulai');
        var tanggalSelesaiInput = document.getElementById('tanggal_selesai');

        tanggalMulaiInput.addEventListener('change', function () {
            var tanggalMulaiValue = tanggalMulaiInput.value;
            var tanggalSelesaiValue = tanggalSelesaiInput.value;
            filterAndDisplay(tanggalMulaiValue, tanggalSelesaiValue);
        });

        tanggalSelesaiInput.addEventListener('change', function () {
            var tanggalMulaiValue = tanggalMulaiInput.value;
            var tanggalSelesaiValue = tanggalSelesaiInput.value;
            filterAndDisplay(tanggalMulaiValue, tanggalSelesaiValue);
        });

        function filterAndDisplay(tanggalMulai, tanggalSelesai) {
            var filteredData = data.filter(function (item) {
                var tanggalTransaksi = new Date(item.created_at).toISOString().slice(0, 10);
                return tanggalTransaksi >= tanggalMulai && tanggalTransaksi <= tanggalSelesai;
            });
            
            displayTable(filteredData);
        }

        function displayTable(data) {
            var tbody = document.querySelector('#example1 tbody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td class="text-center" colspan="8">No data available in table</td></tr>`;
                return;
            }

            data.forEach(function (item, index) {
                var row =
                    `<tr>
                    <td class="text-center align-middle">${index + 1}</td>
                    <td class="text-center align-middle">${moment.utc(item.created_at).format('DD MMMM YYYY | HH:mm:ss')}</td>
                    <td class="text-center align-middle">${item.users.username}</td>
                    <td class="text-center align-middle">${item.users.no_hp}</td>
                    <td class="text-center align-middle">${item.nama_penerima}</td>
                    <td class="text-center align-middle">${item.lokasi_antar}</td>
                    <td class="text-center align-middle">Rp ${parseInt(item.total_bayar).toLocaleString('id-ID')}</td>
                    <td class="text-center align-middle">${item.status_pesanan}</td>
                </tr>`;
                tbody.innerHTML += row;
            });
        }
    });

</script>

@endsection

