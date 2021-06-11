<?= $this->layout('index'); ?>
<?php
$sumber = 'http://jdih.serangkota.go.id/integrasi.php';
$konten = file_get_contents($sumber);
$data = json_decode($konten, true);
?>

<!-- Start page-top-banner section -->
<section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5" style="background:url('<?= BASE_URL . '/' . DIR_INC; ?>/images/hukum.jpg');background-size: cover;">>
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row section-gap-half">
            <div class="col-lg-12 text-center">
                <h1 style="color:#fff;"><?= $this->e($page_title); ?> Perda/Perwal</h1>
                <h4 style="color:#fff;">Pemerintah Kota Serang</h4>
            </div>
        </div>
    </div>
</section>
<!-- End about-top-banner section -->

<!-- Start gallery section -->
<section class="portfolio-section section-gap-full">
    <div class="container">
        <table id="example" class="table table-stripe display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Jenis</th>
                    <th>Tahun</th>
                    <th>Nomor Lembaran</th>
                    <th>Bidang</th>
                    <th>Tentang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($data as $row) : $no++; ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                            <a href="<?php echo $row["urlDownload"]; ?>" class="btn btn-success btn-xs">Download</a>
                        </td>
                        <td><?php echo $row["jenis"]; ?></td>
                        <td><?php echo $row["tanggalData"]; ?></td>
                        <td><?php echo $row["noPanggil"]; ?></td>
                        <td><?php echo $row["bidangHukum"]; ?></td>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<!-- End gallery section -->