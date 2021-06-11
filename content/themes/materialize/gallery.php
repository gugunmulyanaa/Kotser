<?=$this->layout('index');?>

<!-- Start gallery section -->
<section class="portfolio-section section-gap-full">
    <div class="container">
        <div class="section-title">
            <h1 class="text-center" style="border-bottom:6px solid #691cff;">Foto <?=$this->e($page_title);?></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                <?php
                    $gallerys = $this->gallery()->getGallery('12', 'id_gallery DESC', $album, $this->e($page));
                    foreach($gallerys as $gal){
                ?>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="single-portfolio">
                            <img class="img-fluid" src="<?=BASE_URL.'/'.DIR_CON.'/uploads/medium/medium_'.$gal['picture'];?>" alt="<?=$gal['title'];?>">
                            <div class="box-content" style="padding:0px">
                                <a href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$gal['picture'];?>">
                                    <h5 class="title"><?=$gal['title'];?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End gallery section -->

