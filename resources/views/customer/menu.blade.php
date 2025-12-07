@extends('customer.template.main')

@section('content')
<!-- product section -->
<div class="product-section card" style="height: 9rem; background-color:#051922"></div>
<div class="hero-bg">
    <div class="container" style="min-height: 45rem; padding:5rem 0rem">
        <div class="card p-4 shadow">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3>Produk Kami</h3>
                    <hr>
                </div>
            </div>

            <div class="row">
                @foreach($menu as $m)
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="#"><img src="{{ Storage::url('foto_menu/' . $m->foto_menu) }}" alt="Foto Menu"
                                    width="150" height="250"></a>
                        </div>
                        <h3>{{$m->nama_menu}}</h3>
                        <p class="product-price">
                            {{ 'Rp ' . number_format((float)$m->harga_menu, 0, ',', '.')}}/porsi<span>Tersedia :
                                {{$m->stok_menu}}</span></p>
                        <a class="cart-btn" onclick='tambahKeKeranjang(@json($m))'><i
                                class="fas fa-shopping-cart"></i>Beli</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- end product section -->

@endsection
