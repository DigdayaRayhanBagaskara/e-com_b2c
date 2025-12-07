@extends('template')

@section('content')

<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Makanan & Minuman</p>
                        <h1>Khas Melayu</h1>
                        <div class="hero-btns">
                            <a href="/customer" class="boxed-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- product section -->
<div class="product-section mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Produk</span> Kami</h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($menu as $m)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <img src="{{ Storage::url('foto_menu/' . $m->foto_menu) }}" alt="Foto Menu"
                                width="150" height="250">
                    </div>
                    <h3>{{$m->nama_menu}}</h3>
                    <p class="product-price">
                        {{ 'Rp ' . number_format((float)$m->harga_menu, 0, ',', '.') . ',-' }}<span>Per porsi</span></p>
                    <a href="/customer" class="cart-btn"><i class="fas fa-shopping-cart"></i> Beli</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end product section -->

<!-- features list section -->
<div class="list-section pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="content">
                        <h3>Pengantaran Pesanan</h3>
                        <p>Gratis! Diatas Rp50.000,-</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="content">
                        <h3>Pesan Lewat Telepon</h3>
                        <p>Mulai Pukul 08.00 - 20.00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="list-box d-flex justify-content-start align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="content">
                        <h3>Pengembalian Uang</h3>
                        <p>Maksimal Dalam 1 Hari!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end features list section -->

@endsection
