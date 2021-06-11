<?= $this->layout('index'); ?>
<!-- Start about section -->
<section class="about-section section-gap-full relative" id="about-section" style="padding-bottom:0px;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 col-md-5 about-left">
                <img class="img-fluid" src="images/img1.jpg" alt="">
            </div>
            <div class="col-lg-6 col-md-6">
                <h1 style="text-align:center;">Apa itu Layanan SIAGA 112 ?</h1>
                <br>
                <h5 style="text-align:justify;">
                    Layanan SIAGA 112, yaitu Layanan bantuan kegawat daruratan untuk warga kota serang seperti
                    <b> Bencana Alam, Tindakan Kriminal, Kebakaran, Permintaan Ambulan, Kecelakaan, dan Penyelamatan
                        Manusia</b>. Dengan adanya layanan ini diharapkan memberikan daya dan budaya bagi masyarakat
                    dalam mencipakan Kota Serang yang beradab.
                </h5>
                <br>
                <h1 style="text-align:center;">Hubungi Nomor 112 </h1>
                <p style="text-align:center;">Panggilan ini tidak dipungut biaya. Tekan Tombol ini</p>
                <img style="margin-left: auto;margin-right: auto;display:block" class="img-fluid" src="images/phone.png" alt="" width="80">
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

<!-- Start portfolio section -->
<section class="portfolio-section section-gap-full" style="padding:40px">
    <div class="container">
        <div class="section-title" style="margin-bottom:10px">
            <h2 class="text-center">Layanan SIAGA 112</h2>
            <p class="text-center">Layanan Kondisi Gawat Darurat Warga Kota Serang</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img2.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Layanan Ambulance</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img3.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Keselamatan Manusia</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img4.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Penanganan Kebakaran</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img5.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Kecelakaan Kendaraan</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img6.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Tindakan Kriminal</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-portfolio">
                    <img class="img-fluid" src="images/img7.jpg" alt="">
                    <div class="box-content">
                        <h5 class="title">Bencana Alam</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End portfolio section -->