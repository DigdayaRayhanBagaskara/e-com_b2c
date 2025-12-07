<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://e-com_b2c.test/frontend/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>E-Commerce</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/customer">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li><a class="mt-4" href="/customer/">Halaman Utama</a></li>
                                <li><a class="mt-4" href="/customer/menu">Menu</a></li>
                                <li><a class="mt-4" href="/customer/riwayat">Riwayat</a></li>
                                <li><a class="mt-4" href="/customer/keranjang">Keranjang</a></li>
                                <li><a class="mt-4">Selamat Datang, {{ Auth::user()->username }}!</a>
									<ul class="sub-menu mt-4">
                                        <li><a href="/customer/profile">Profil</a></li>
										<li>
                                            <div class="header-icons">
                                                <a href="{{ route('logout') }}" onclick="if(confirm('Apakah anda yakin ingin Logout?')) { event.preventDefault(); document.getElementById('logout-form').submit(); } else { event.preventDefault(); }">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
									</ul>
								</li>
                            </ul>
                        </nav>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="berhasil" style="display: none; position: fixed; top: 20px; right: 20px; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; z-index: 9999;"></div>
    <div id="gagal" style="display: none; position: fixed; top: 20px; right: 20px; background-color:rgb(246, 22, 22); color: white; padding: 10px 20px; border-radius: 5px; z-index: 9999;"></div>

    <!-- end header -->
    @yield('content')
    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class=" col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">Tentang Kami</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Kontak Kami</h2>
                        <ul>
                            <li>Kantin Menara Dang Merdu Bank Riau Kepri Syari'ah</li>
                            <li>kantindangmerdu@gmail.com</li>
                            <li>+628122449598</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>E-Commerce, All Rights Reserved</a>
                    </p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
    <script>
        function tambahKeKeranjang(menu) {
        let keranjang = sessionStorage.getItem('keranjang');
        keranjang = keranjang ? JSON.parse(keranjang) : [];

        const index = keranjang.findIndex(item => item.id === menu.id);

        const berhasil = document.getElementById('berhasil');
        const gagal = document.getElementById('gagal');

        if (index !== -1) {
            if (keranjang[index].jumlah_menu >= menu.stok_menu) {
                gagal.innerText = menu.nama_menu + " tersedia " + menu.stok_menu + ", gagal ditambahkan ke keranjang!";
                gagal.style.display = 'block';
                setTimeout(() => {
                    gagal.style.display = 'none';
                }, 1000);
                return;
            }
            keranjang[index].jumlah_menu += 1;
        } else {
            keranjang.push({
                id: menu.id,
                nama_menu: menu.nama_menu,
                harga_menu: menu.harga_menu,
                jumlah_menu: 1,
                jenis_menu: menu.jenis_menu,
                foto_menu: menu.foto_menu
            });
        }

        sessionStorage.setItem('keranjang', JSON.stringify(keranjang));

        berhasil.innerText = menu.nama_menu + " berhasil ditambahkan ke keranjang!";
        berhasil.style.display = 'block';
        setTimeout(() => {
            berhasil.style.display = 'none';
        }, 1000);
    }


    </script>
</body>

</html>
