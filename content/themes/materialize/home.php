<?= $this->layout('index'); ?>

<!-- Start Banner section -->
<section class="testimonial-section section-gap-full" id="banner-section" style="padding-top:100px;padding-bottom: 0px">
    <div class="container">
        <div class="align-items-center">
            <div class="col-lg-12">
                <div class="testimonial-carusel owl-carousel" id="owl-demo">
                    <?php
                    $banners = $this->banner()->getAllBanner('id DESC');
                    foreach ($banners as $bnr) {
                        ?>
                        <div class="single-testimonial item" style="padding:0px;">
                            <div class="owl-image">
                                <img src="<?= BASE_URL . '/' . DIR_CON . '/uploads/' . $bnr['gambar']; ?>" alt="" style="border-radius:20px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="single-feature relative" style="margin:0px;padding:0px;">
                    <h3 style="margin-bottom: 20px">
                        <?php
                        $runnings = $this->runningtext()->getAllRunning('id ASC', '1');
                        foreach ($runnings as $rng) {
                            ?>
                            <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="background-color:#eeeeee;border-left:20px solid #8400ff;border-right:20px solid #8400ff;border-radius:10px">
                                <?= $rng['isitext']; ?>
                            </marquee>
                        <?php } ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner section -->

<!-- Start about section -->
<section class="about-section relative" id="about-section" style="padding-top:10px;padding-bottom:30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-8 about-left" style="text-align:center">
                <h3 style="padding:10px"><b><?= $this->e($front_foto_wali); ?></b></h3>
                <img style="margin-bottom:10px;height:300px;border-radius:20px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);" class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/walikota.jpg" alt="">
                <a class="primary-btn" href="<?= BASE_URL; ?>/pages/visi-dan-misi"><?= $this->e($front_readmore); ?></a>
            </div>
            <div class="col-lg-4 col-md-6 about-left" style="text-align:center">
                <h3 style="padding:10px"><b><?= $this->e($front_dokumen); ?></b></h3>
                <div class="single-widget recent-post-widget" style="background-color: #eeeeee;padding: 10px;border-radius: 1rem;text-align: center;margin-bottom: 10px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                    <a href="https://forms.gle/io3M8QzjxSymjKqz6"><img style="width:280px" class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/permohonan.png" alt=""></a>
                    <a href=""><img style="width:280px" class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/keberatan.png" alt=""></a>
                    <a href="https://forms.gle/x6wEFXpVCFqRvfik8"><img style="width:280px" class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/kepuasan.png" alt=""></a>
                </div>
                <a class="primary-btn" data-target="#ApppublicModal" data-toggle="modal" href="#ApppublicModal"><?= $this->e($front_readmore); ?></a>
            </div>
            <div class="col-lg-4 col-md-6 about-left" style="text-align:center">
                <h3 style="padding:10px"><b><?= $this->e($front_info); ?></b></h3>
                <div class="testimonial-carusel owl-carousel" id="owl-demo2">
                    <?php
                    $infografiss = $this->infografis()->getAllInfografis('id DESC', '');
                    foreach ($infografiss as $ifs) {
                        ?>
                        <div class="single-testimonial item" style="padding:0px">
                            <div class="owl-image">
                                <a href="<?= BASE_URL . '/' . DIR_CON . '/uploads/' . $ifs['gambar']; ?>"><img src="<?= BASE_URL . '/' . DIR_CON . '/uploads/medium/medium_' . $ifs['gambar']; ?>" alt="<?= $ifs['keterangan']; ?>" style="height:350px;border-radius:20px"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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

<!-- Start public information section -->
<section class="feature-section section-gap-full" id="feature-section" style="padding:20px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="row features-wrap">
                    <div class="col-lg-4 col-md-12">
                        <h3 style="padding:10px;text-align:center;color:white;"><b><?= $this->e($front_breaking_news); ?></b></h3>
                        <?php
                        $terkini = $this->post()->getRecent('1', 'DESC', WEB_LANG_ID);
                        foreach ($terkini as $hdln) {
                            ?>
                            <div class="single-feature relative">
                                <div class="overlay overlay-bg"></div>
                                <img style="margin-bottom:10px;position:relative;border-radius:20px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)" class="img-fluid" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/medium/medium_<?= $hdln['picture']; ?>" alt="">
                                <h6 style="float:left;padding-bottom:5px"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->pocore()->call->podatetime->tgl_indo($hdln['date']); ?></h6>
                                <h6 style="float:right;padding-bottom:5px"><i class="fa fa-eye" aria-hidden="true"></i> <?= $hdln['hits']; ?> <?= $this->e($front_hits); ?></h6>
                                <h6 style="float:left;"><i class="fa fa-user" aria-hidden="true"></i> <?= $this->post()->getAuthorName($hdln['editor']); ?></h6>
                                <h3 style="padding-top:60px;margin-bottom:10px"><?= $hdln['title']; ?></h3>
                                <p>
                                    <?= $this->pocore()->call->postring->cuthighlight('post', $hdln['content'], '300'); ?>
                                </p>
                                <br>
                                <a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $hdln); ?>" class="primary-btn primary-btn-w d-block mx-auto" style="position: relative;"><?= $this->e($front_readmore); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h3 style="padding:10px;text-align:center;color:white;"><b>BERITA <?= $this->e($page_title); ?></b></h3>
                        <div class="card">
                            <div class="card-header">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-pills justify-content-center" style="text-align:center;" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#terkini" data-toggle="tab">
                                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> <?= $this->e($front_berita); ?>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#opd" data-toggle="tab">
                                                    <i class="fa fa-university" aria-hidden="true"></i> <?= $this->e($front_berita_opd); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="terkini" role="tabpanel" aria-labelledby="home-tab" style="height:600px;overflow-y: auto;">
                                    <ul class="list-group">
                                        <?php
                                        $ambilpost = $this->post()->getPost('1,15', 'DESC', WEB_LANG_ID);
                                        foreach ($ambilpost as $pst) {
                                            ?>
                                            <a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $pst); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div class="flex-column">
                                                    <b><?= $pst['title']; ?></b>
                                                    <br>
                                                    <span class="badge badge-danger badge-pill"><i class="fa fa-user" aria-hidden="true"></i> <?= $this->post()->getAuthorName($pst['editor']); ?></span>
                                                    <br>
                                                    <span class="badge badge-primary badge-pill"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->pocore()->call->podatetime->tgl_indo($pst['date']); ?></span> <span class="badge badge-success badge-pill"><i class="fa fa-eye" aria-hidden="true"></i> <?= $pst['hits']; ?> <?= $this->e($front_hits); ?></span>
                                                </div>
                                                <div class="image-parent">
                                                    <img src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/thumbs/<?= $pst['picture']; ?>" class="img-fluid" alt="quixote" style="max-width: 80px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)">
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="opd" role="tabpanel" aria-labelledby="profile-tab" style="height:600px;overflow-y: auto;">
                                    <ul class="list-group">
                                        <?php
                                        $ambilpost = $this->post()->getPost('1,15', 'DESC', WEB_LANG_ID);
                                        foreach ($ambilpost as $pst) {
                                            ?>
                                            <a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $pst); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div class="flex-column">
                                                    <b><?= $pst['title']; ?></b>
                                                    <br>
                                                    <span class="badge badge-danger badge-pill"><i class="fa fa-user" aria-hidden="true"></i> Nama OPD</span>
                                                    <br>
                                                    <span class="badge badge-primary badge-pill"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->pocore()->call->podatetime->tgl_indo($pst['date']); ?></span> <span class="badge badge-success badge-pill"><i class="fa fa-eye" aria-hidden="true"></i> <?= $pst['hits']; ?> <?= $this->e($front_hits); ?></span>
                                                </div>
                                                <div class="image-parent">
                                                    <img src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/thumbs/<?= $pst['picture']; ?>" class="img-fluid" alt="quixote" style="max-width: 80px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)">
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h3 style="padding:10px;text-align:center;color:white;"><b><?= $this->e($front_gpr); ?></b></h3>
                        <div id="gpr-kominfo-widget-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End public information section -->

<!-- Start Galeri section -->
<section class="download-section section-gap-full" id="download-section" style="padding-top: 0px;padding-bottom: 40px;">
    <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-12">
                <h3 style="padding:10px;text-align:center"><b><?= $this->e($front_maps); ?></b></h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <a href="https://serangkota.go.id/">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/pemkot.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <a href="https://kominfo.serangkota.go.id/">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/kominfo.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="https://rabeg.serangkota.go.id/">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/arabeg.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="<?= BASE_URL; ?>/layanansiaga">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/a112.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="https://play.google.com/store/apps/details?id=com.wulan.smartdukcapil&hl=in">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/bduduk.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="https://sikondang.serangkota.go.id/">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/bkondang.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="https://sirup.lkpp.go.id/sirup/ro/rekap/klpd/D46">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/cada.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                        <div class="col-lg-6 col-md-6" style="padding-top:25px;">
                            <a href="http://perijinanmadani.serangkota.go.id/">
                            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/cizin.jpg"
                            style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></a>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3 style="padding:10px;text-align:center"><b><?= $this->e($front_gallery_foto); ?></b></h3>
                <div class="testimonial-carusel owl-carousel" id="owl-demo3" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                    <?php
                    $ambilgallery = $this->gallery()->getAllGallery('id_gallery DESC', '10');
                    foreach ($ambilgallery as $gll) {
                        ?>
                        <div class="single-testimonial item">
                            <div class="owl-image">
                                <img src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $gll['picture']; ?>" alt="<?= $gll['title']; ?>" style="height: 350px;">
                            </div>
                            <a href="single-portfolio.html">
                                <h6 class="title"><?= $gll['title']; ?></h6>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3 style="padding:10px;text-align:center"><b><?= $this->e($front_media); ?></b></h3>
                <div class="card">
                    <div class="card-header">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-pills justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#twitter" data-toggle="tab">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#facebook" data-toggle="tab">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#instagram" data-toggle="tab">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#youtube" data-toggle="tab">
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="twitter" role="tabpanel" aria-labelledby="home-tab">
                            <a class="twitter-timeline" data-lang="id" data-height="350" data-link-color="#691cff" href="https://twitter.com/pemkotserang?ref_src=twsrc%5Etfw"></a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        <div class="tab-pane fade" id="facebook" role="tabpanel" aria-labelledby="home-tab">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FPPID-Kota-Serang-115705953147781%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="350" style="border:none;overflow:hidden top: 0;left: 0;right: 0;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                        <div class="tab-pane fade p-3" id="youtube" role="tabpanel" aria-labelledby="home-tab">
                        <iframe src="https://www.youtube.com/embed/videoseries?list=PLPEYVgLK4K0R7qSepPjJBjqdTl7Ckldpw" width="100%" height="350" style="border:none;overflow:hidden top: 0;left: 0;right: 0;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="tab-pane fade p-3" id="instagram" role="tabpanel" aria-labelledby="profile-tab">
                            <?php
                            function get_curl($url)
                            {
                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_URL, $url);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                $result = curl_exec($curl);
                                curl_close($curl);

                                return json_decode($result, true);
                            }

                            $result = get_curl('https://api.instagram.com/v1/users/self?access_token=5535715262.f2238e3.e48397693a58469aadd4c9e31dfcc90f');
                            $result1 = get_curl('https://api.instagram.com/v1/users/self/media/recent/?access_token=5535715262.f2238e3.e48397693a58469aadd4c9e31dfcc90f&count=10');
                            $usernameIG = $result['data']['username'];
                            $profilpict = $result['data']['profile_picture'];
                            $posting = $result['data']['counts']['media'];
                            $follower = $result['data']['counts']['followed_by'];
                            $photos = [];
                            foreach ($result1['data'] as $photo) {
                                $photos[] = $photo['images']['thumbnail']['url'];
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                                    <img src="<?= $profilpict; ?>" class="img-fluid rounded-circle" alt="instagram" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16),0 3px 6px rgba(0,0,0,0.23);">
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 text-center">
                                    <h3><?= $usernameIG; ?></h3>
                                    <p style="margin-top:0px;margin-bottom:10px"><?= $posting ?> posting <?= $follower ?> pengikut</p>
                                    <a class="btn btn-primary btn-sm" href="https://www.instagram.com/riyanzoom/"><i class="fa 
                                fa-instagram" aria-hidden="true"></i> Follow Me</a>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="height:200px;overflow-y: auto;">
                                <?php foreach ($photos as $photo) : ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);margin-top:10px;">
                                            <img class="card-img-top" src="<?= $photo; ?>" alt="">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End download section -->