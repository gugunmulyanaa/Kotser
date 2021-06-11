<?= $this->layout('index'); ?>
<!-- Start about section -->
<section class="about-section section-gap-full relative" id="about-section" style="padding-bottom:0px;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-6 about-left">
                <img class="img-fluid" src="<?= $this->asset('/img/rabeg.jpg') ?>" alt="">
            </div>
            <div class="col-lg-5 col-md-5 about-right">
                <h1>Apa itu Rabeg Online?</h1>
                <h5 style="text-align:justify;">
                    RABEG (Reaksi Atas Berita Warga), yaitu aplikasi berbasis online. Sebuah aplikasi Pengaduan,
                    Aspirasi, Keluhan, Opini, dll.Yang disampaikan oleh warga melalui media sosial,
                    kotak saran/aduan kepada pemerintah Kota Serang sehingga dapat dijangkau oleh semua pihak.
                    Baik warga maupun Pemerintah Kota Serang.
                </h5>
                <br>
                <a class="primary-btn" href="https://www.youtube.com/watch?v=QwP76quae98&list=PL_8K63laN3dTfDgk4tAX_C_nOdrhAEi77"><span class="ti-desktop"></span> Sekilas RABEG</a>
                <a class="primary-btn" data-target="#loginRabeg" data-toggle="modal" href="#loginRabeg"><span class="ti-announcement"></span> Posting Berita</a>
            </div>
        </div>
    </div>
    <div class="floating-shapes">
        <span data-parallax='{"x": 150, "y": -20, "rotateZ":500}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-1.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": 250, "y": 150, "rotateZ":500}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-2.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-3.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": -20, "y": 180}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-4.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": 300, "y": 70}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-5.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": 250, "y": 180, "rotateZ":1500}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-6.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": 180, "y": 10, "rotateZ":2000}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-7.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": 60, "y": -100}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-9.png') ?>" alt="">
        </span>
        <span data-parallax='{"x": -30, "y": 150, "rotateZ":1500}'>
            <img src="<?= $this->asset('/img/shape/fl-shape-10.png') ?>" alt="">
        </span>
    </div>
</section>
<!-- End about section -->

<!-- Start testimonial section -->
<section class="testimonial-section" id="testimonial-section" style="padding-top:60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 testimonial-left">
                <h2>Apa Kata Warga ?</h2>
                <p style="color:#222222">
                    Laporan Terkhir Warga Kota Serang.
                </p>
                <a class="primary-btn" href="https://rabeg.serangkota.go.id/_rbgportal/home">See Detail
                    <span class="ti-arrow-right"></span>
                </a>
            </div>
            <div class="col-lg-8 testimonial-right">
                <div class="testimonial-carusel  owl-carousel" id="testimonial-carusel">
                    <?php
                    include 'konek.php';
                    $rabeg = mysqli_query($koneksi, "SELECT * from rbg_aduan ORDER BY ID_ADUAN DESC LIMIT 10");
                    foreach ($rabeg as $row) {
                        echo "<div class='single-testimonial item'>
                                <h4>" . substr($row['JUDUL_ADUAN'], 0, 30) . "...</h4><br>
                                <p>"
                            . substr($row['ISI_ADUAN'], 0, 100) .
                            "...</p>
                                <div class='user-details d-flex flex-row align-items-center'>
                                    <div class='img-wrap'>
                                        <img src='account.png' alt=''>
                                    </div>
                                    <div class='details'>
                                        <h4> TRX ID : " . $row['ID_ADUAN'] . "</h4>
                                        <p>" . $row['TGL_ADUAN'] . "</p>
                                    </div>
                                </div>
                            </div>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End testimonial section -->

<!-- Start download section -->
<section class="download-section section-gap-full" id="download-section">
    <div class="container">
        <div class="row download-wrap justify-items-between align-items-center">
            <div class="col-lg-6">
                <h1>Download RABEG Online</h1>
                <p style="color:#222222">
                    Download Aplikasi Rabeg Mobile (Android/iOs) untuk memudahkan Warga Kota Serang
                    dalam menyampaikan Aspirasi/Aduan Melalui Smartphone/HP
                </p>
            </div>
            <div class="col-lg-6 dload-btn">
                <a href="#" class="primary-btn">
                    <span>Google Play</span>
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" style="fill:#fff">
                        <g id="surface1">
                            <path style=" " d="M 7.125 2 L 28.78125 23.5 L 34.71875 17.5625 L 8.46875 2.40625 C 8.03125 2.152344 7.5625 2.011719 7.125 2 Z M 5.3125 3 C 5.117188 3.347656 5 3.757813 5 4.21875 L 5 46 C 5 46.335938 5.070313 46.636719 5.1875 46.90625 L 27.34375 24.90625 Z M 36.53125 18.59375 L 30.1875 24.90625 L 36.53125 31.1875 L 44.28125 26.75 C 45.382813 26.113281 45.539063 25.304688 45.53125 24.875 C 45.519531 24.164063 45.070313 23.5 44.3125 23.09375 C 43.652344 22.738281 38.75 19.882813 36.53125 18.59375 Z M 28.78125 26.3125 L 6.9375 47.96875 C 7.300781 47.949219 7.695313 47.871094 8.0625 47.65625 C 8.917969 47.160156 26.21875 37.15625 26.21875 37.15625 L 34.75 32.25 Z "></path>
                        </g>
                    </svg>
                </a>
                <a href="#" class="primary-btn">
                    <span>App Store</span>
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 30 30" style="fill:#fff;">
                        <path d="M25.565,9.785c-0.123,0.077-3.051,1.702-3.051,5.305c0.138,4.109,3.695,5.55,3.756,5.55 c-0.061,0.077-0.537,1.963-1.947,3.94C23.204,26.283,21.962,28,20.076,28c-1.794,0-2.438-1.135-4.508-1.135 c-2.223,0-2.852,1.135-4.554,1.135c-1.886,0-3.22-1.809-4.4-3.496c-1.533-2.208-2.836-5.673-2.882-9 c-0.031-1.763,0.307-3.496,1.165-4.968c1.211-2.055,3.373-3.45,5.734-3.496c1.809-0.061,3.419,1.242,4.523,1.242 c1.058,0,3.036-1.242,5.274-1.242C21.394,7.041,23.97,7.332,25.565,9.785z M15.001,6.688c-0.322-1.61,0.567-3.22,1.395-4.247 c1.058-1.242,2.729-2.085,4.17-2.085c0.092,1.61-0.491,3.189-1.533,4.339C18.098,5.937,16.488,6.872,15.001,6.688z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End download section -->