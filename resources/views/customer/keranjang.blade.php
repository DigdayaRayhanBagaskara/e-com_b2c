@extends('customer.template.main')

@section('content')
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        <div class="card p-4 shadow">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3>Keranjang</h3>
                    <hr>
                </div>
            </div>

            <div class="mb-3">
                <a href="/customer/menu" class="btn btn-success">+ Tambah Belanja</a>
                <button onclick="kosongkan()" class="btn btn-warning">Kosongkan</button>
                <a href="/customer/pembayaran" class="btn btn-primary"
                    onclick="return periksaKeranjang()">Pembayaran</a>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th></th>
                                <th>Gambar Menu</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="keranjang-body">
                            <tr id="row-template" class="table-body-row" style="display: none;">
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="">X</button>
                                </td>
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
<script>
    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }
    document.addEventListener('DOMContentLoaded', () => {
        const keranjang = JSON.parse(sessionStorage.getItem('keranjang')) || [];
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

            row.querySelector('button').onclick = () => hapusItem(i);
            row.querySelector('img').src = `/storage/foto_menu/${item.foto_menu}`;
            row.querySelector('.nama_menu').textContent = item.nama_menu;
            row.querySelector('.harga_menu').textContent = formatRupiah(parseInt(item.harga_menu));
            row.querySelector('.jumlah_menu').textContent = item.jumlah_menu;

            const total = item.harga_menu * item.jumlah_menu;
            row.querySelector('.total').textContent = formatRupiah(total);
            subtotal += total;

            tbody.appendChild(row);
        });

        // Cek apakah sudah ada angka unik di sessionStorage
        let unik = sessionStorage.getItem('unik');
        if (!unik) {
            unik = Math.floor(Math.random() * 251); // 0 - 250
            sessionStorage.setItem('unik', unik);
        } else {
            unik = parseInt(unik);
        }

        // Tambahkan angka unik di belakang ribuan
        subtotal = Math.floor(subtotal / 1000) * 1000 + unik;

        document.getElementById('subtotal').textContent = formatRupiah(subtotal);
    });



    function hapusItem(i) {
        if (confirm('Hapus item ini?')) {
            const keranjang = JSON.parse(sessionStorage.getItem('keranjang')) || [];
            keranjang.splice(i, 1);
            sessionStorage.setItem('keranjang', JSON.stringify(keranjang));
            location.reload();
        }
    }

    function kosongkan() {
        if (confirm('Kosongkan Keranjang?')) {
            sessionStorage.removeItem('keranjang');
            sessionStorage.removeItem('unik');
            location.reload();
        }
    }

    function periksaKeranjang() {
        const keranjang = JSON.parse(sessionStorage.getItem('keranjang') || '[]');
        if (keranjang.length === 0) {
            alert('Keranjang anda masih kosong!');
            return false;
        }
        return confirm('Periksa kembali keranjang anda sebelum lanjut ke pembayaran.');
    }

</script>


@endsection
