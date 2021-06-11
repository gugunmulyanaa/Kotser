<!-- Start footer section -->
<footer class="footer-section section-gap-half" style="padding:30px;border-top:6px solid #691cff">
    <div class="container">
        <div class="col-lg-12" style="text-align:center;">
            <ul id="social">
                <li>
                    <a target="_blank" href="#">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="#">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="#">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="#">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <img class="img-responsive" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/srg.png" style="width:20%" alt="">
            <p class="copyright-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                <?= $this->pocore()->call->posetting[8]['value']; ?>
            </p>
            <p class="copyright-text"><i class="fa fa-copyright" aria-hidden="true"></i>
                2019 <?= $this->pocore()->call->posetting[4]['value']; ?>
            </p>
            <p class="copyright-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                <?= $this->pocore()->call->posetting[5]['value']; ?>
            </p>
            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/ragem.png" style="max-width:120px" alt="">
            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/kominfo.png" style="max-width:160px" alt="">
            <img class="img-fluid" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/smartcity.png" style="max-width:120px" alt="">
        </div>
</footer>

<div class="scroll-top">
    <i class="fa fa-arrow-up"></i>
</div>
<div class="container">
    <a href="<?= BASE_URL; ?>/layanansiaga" class="pulse-button"></a>
    <a data-target="#loginRabeg" data-toggle="modal" href="#loginRabeg" class="pulse-button2"></a>
</div>

<!-- Modal public apps-->
<div class="modal fade" id="ApppublicModal" tabindex="-1" role="dialog" aria-labelledby="ApppublicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:4px solid #691cff">
                <h5 class="modal-title" id="ApppublicModalLabel">APLIKASI LAYANAN PUBLIK KOTA SERANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Aplikasi <br>SIKONDANG</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="https://sikondang.serangkota.go.id" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p>Aplikasi ini adalah Layanan Sistem Informasi Kota Serang dalam bentuk angka STATISTIK</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Aplikasi <br>PerijinanMadani</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="https://perijinanmadani.serangkota.go.id" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p>Aplikasi ini adalah Layanan Sistem Daftar Pelayanan Perijinan dan nonperijinan DPMTSP Kota Serang</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Aplikasi <br>SIRUP</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="https://sirup.lkpp.go.id/sirup/ro/rekap/klpd/D46" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p>Aplikasi ini adalah Layanan Sistem Informasi Rencana Umum Pengadaan Barang dan Jasa</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Aplikasi <br>RABEG</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="https://rabeg.serangkota.go.id" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p>RABEG adalah sarana warga untuk pengaduan, aspirasi, keluhan dll. Kepada pemerintah kota Serang</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Layanan <br>SIAGA 112</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="http://localhost/madaniCMS/layanansiaga" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p>Layanan Call Center bantuan kegawat daruratan untuk warga kota serang.</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                    <!-- start item apps -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card-container manual-flip" style="padding:10px">
                            <div class="card">
                                <img class="img-fluid" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logowlp.jpg" />
                                <div class="card-body text-center" style="padding-top:0px;min-height:0px;-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-title">Aplikasi <br>GELATI</h4>
                                    <button class="btn btn-primary btn-sm" onclick="rotateCard(this)">
                                        <i class="fa fa-book"></i> Deskripsi
                                    </button>
                                    <a href="https://gelati.serangkota.go.id" target="blank"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-external-link"></i> Link
                                        </button></a>
                                </div>
                                <div class="back" style="min-height:0px;" style="-webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-backface-visibility: hidden;">
                                    <h4 class="card-header text-center">DESKRIPSI</h4>
                                    <div class="card-body text-center">
                                        <p> Aplikasi untuk warga kota serang mencari tempat-tempat yang dibutuhkan</p>
                                        <button class="btn btn-primary btn-round" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item apps -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginRabeg" tabindex="-1" role="dialog" aria-labelledby="loginRabegLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginRabegLabel">Form Integrasi Aplikasi Rabeg</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <div class="brand">
                            <img src="rabeg/rabeg.png" alt="page" style="margin-left: auto;margin-right: auto;display: block;">
                        </div>
                        <h4 class="card-title" style="text-align:center;">Sampaikan Aduan, Aspirasi, Keluhan, dan Opini Kepada Pemerintah Kota Serang</h4>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Masukkan Username Rabeg" required>
                            <span id="user_verifed"></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password
                            </label>
                            <input id="pass" type="password" class="form-control" name="pass" placeholder="Masukkan Password Rabeg" required>
                            <span id="pass_verifed"></span>
                        </div>

                        <div class="form-group m-0">
                            <button class="btn btn-primary btn-block">
                                Verifikasi User <i class="fa fa-check" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Postingan</label>
                            <input id="judul" type="text" class="form-control" name="judul" placeholder="Masukkan Judul Postingan" autocomplete="off" disabled>
                            <span id="judul_verifed"></span>
                        </div>

                        <div class="form-group">
                            <label for="Textarea">Isi Postingan</label>
                            <textarea class="form-control" id="isi" rows="3" placeholder="Masukkan Isi Postingan" disabled></textarea>
                            <span id="isi_verifed"></span>
                        </div>

                        <div class="form-group">
                            <label for="select">Kategori Postingan</label>
                            <select class="form-control" id="kategori" disabled>
                                <option value="">Pilih Kategori</option>
                                <option value="KTG001">Pengaduan</option>
                                <option value="KTG002">Keluhan</option>
                                <option value="KTG003">Informasi</option>
                                <option value="KTG004">Aspirasi</option>
                            </select>
                            <span id="kategori_verifed"></span>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat/Lokasi</label>
                            <input id="alamat" type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat/Lokasi Postingan" autocomplete="off" disabled>
                            <span id="alamat_verifed"></span>
                        </div>

                        <div class="form-group m-0">
                            <button id="posting" type="submit" class="btn btn-primary btn-block" disabled>
                                Posting Aduan <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="https://rabeg.serangkota.go.id/_rbgportal/forgotpwd">Lupa Password?</a><br>
                            Belum memiliki akun Rabeg? <a href="https://rabeg.serangkota.go.id/_rbgportal/login">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End footer section -->