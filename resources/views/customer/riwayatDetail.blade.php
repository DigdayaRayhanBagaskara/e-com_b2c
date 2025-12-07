@extends('customer.template.main')

@section('content')
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        <div class="card p-4 shadow">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3>Riwayat Detail</h3>
                    <hr>
                </div>
            </div>

            <div class="mb-3">
                <a href="/customer/riwayat" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="row">
                <div class="col-lg-5">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center align-middle">Tanggal Pesanan</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">
                                        {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y | H:i:s') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Nama Pesanan</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">{{$pesanan->users->username}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">No. Telepon</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">{{$pesanan->users->no_hp}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Nama Penerima</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">{{$pesanan->nama_penerima}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Lokasi Antar</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">{{$pesanan->lokasi_antar}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Status Pesanan</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">{{$pesanan->status_pesanan}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Bukti Pembayaran</th>
                                    <td class="text-center align-middle">:</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Bukti Pembayaran
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <center><img
                                                        src="{{ Storage::url('bukti_pembayaran/' . $pesanan->bukti_pembayaran) }}"
                                                        width="400" alt="Foto Menu"></center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th>No</th>
                                    <th>Gambar Menu</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang-body">
                                <tr id="row-template" class="table-body-row" style="display: none;">
                                    <td class="nomor"></td>
                                    <td><img src="" width="80"></td>
                                    <td class="nama_menu"></td>
                                    <td class="harga_menu"></td>
                                    <td class="jumlah_menu"></td>
                                    <td class="total"></td>
                                </tr>

                            </tbody>
                            <tbody style="font-weight: bold;" id="keranjang-body">
                                <tr class="total-data">
                                    <td colspan="5"><strong>Subtotal:</strong></td>
                                    <td id="subtotal">Rp 0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }
    document.addEventListener('DOMContentLoaded', () => {
        const keranjang = JSON.parse(@json($pesanan['pesanan'] ?? '[]'));
        console.log(keranjang);
        const tbody = document.getElementById('keranjang-body');
        const template = document.getElementById('row-template');
        let subtotal = 0;

        tbody.innerHTML = '';

        if (!keranjang.length) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center">Keranjang masih kosong.</td></tr>`;
            return;
        }

        keranjang.forEach((item, i) => {
            const row = template.cloneNode(true);
            row.style.display = '';
            row.removeAttribute('id');

            row.querySelector('.nomor').textContent = i + 1;
            row.querySelector('img').src = `/storage/foto_menu/${item.foto_menu}`;
            row.querySelector('.nama_menu').textContent = item.nama_menu;
            row.querySelector('.harga_menu').textContent = formatRupiah(parseInt(item.harga_menu));
            row.querySelector('.jumlah_menu').textContent = item.jumlah_menu;

            const total = item.harga_menu * item.jumlah_menu;
            row.querySelector('.total').textContent = formatRupiah(total);
            subtotal += total;

            tbody.appendChild(row);
        });

        document.getElementById('subtotal').textContent = formatRupiah(subtotal);
    });

</script>


@endsection
