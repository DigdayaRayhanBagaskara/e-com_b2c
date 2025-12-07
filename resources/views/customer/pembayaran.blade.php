@extends('customer.template.main')

@section('content')
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        <div class="card p-4 shadow">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3>Pembayaran</h3>
                    <hr>
                </div>
            </div>
            @if(session('gagal'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('gagal')}}
            </div>
            @endif
            <div class="card p-4 shadow">
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <img src="assets/img/qris.png" alt="QRIS">
                    </div>
                    <div class="col-sm-6">
                        <form action="/customer/pembayaranProses" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="id_rekening">Pilih Rekening</label>
                                <select name="id_rekening" id="id_rekening" class="form-control" required>
                                    <option value="">
                                        <-- Silahkan dipilih! -->
                                    </option>
                                    @foreach($rekening as $r)
                                    <option value="{{$r->id}}">{{$r->nama_bank}} - {{$r->nama_rekening}} -
                                        {{$r->nomor_rekening}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required
                                    placeholder="Masukkan Nama Penerima...">
                            </div>
                            <div class="form-group mb-2">
                                <label for="lokasi_antar">Lokasi Antar</label>
                                <input type="text" name="lokasi_antar" id="lokasi_antar" class="form-control" required
                                    placeholder="Masukkan Lokasi Antar...">
                            </div>
                            <div class="form-group mb-2">
                                <label for="total_bayar">Total Bayar</label>
                                <input type="text" name="total_bayar" id="total_bayar" class="form-control" required
                                    placeholder="Masukkan Total Bayar..." readonly>
                                <input type="hidden" name="pesanan" id="pesanan" class="form-control" required
                                    placeholder="Masukkan Total Bayar..." readonly>
                            </div>

                            <div class="form-group mb-2">
                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control"
                                    required placeholder="Masukkan Bukti Pembayaran...">
                            </div>
                            <div class="form-group mb-2">
                                <a href="/customer/keranjang" class="btn btn-secondary">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const keranjang = JSON.parse(sessionStorage.getItem('keranjang') || '[]');
        if (keranjang.length === 0) {
            location.href = '/customer/keranjang';
            const gagal = document.getElementById('gagal');
            gagal.innerText = "Keranjang anda masih kosong! ";
            gagal.style.display = 'block';
            setTimeout(() => {
                gagal.style.display = 'none';
            }, 1000);
            return;
        }

        let total = 0;
        keranjang.forEach(item => {
            total += item.harga_menu * item.jumlah_menu;
        });

        // Ambil / buat angka unik dari sessionStorage
        let unik = sessionStorage.getItem('unik');
        if (!unik) {
            unik = Math.floor(Math.random() * 251); // 0 - 250
            sessionStorage.setItem('unik', unik);
        } else {
            unik = parseInt(unik);
        }

        // Tambahkan angka unik di belakang ribuan
        total = Math.floor(total / 1000) * 1000 + unik;

        // Masukkan ke form pembayaran
        document.getElementById('total_bayar').value = formatRupiah(total);
        document.getElementById('pesanan').value = JSON.stringify(keranjang);
    });

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

</script>

@endsection
