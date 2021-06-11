<?=$this->layout('index');?>

<!-- Start video section -->
<section class="service-section section-gap-full" style="padding-bottom:0px">
    <div class="container">
    <h1 class="text-center" style="border-bottom:6px solid #691cff;">Galeri <?=$this->e($page_title);?></h1>
        <div class="row">
        <?php
            $videos = $this->video()->getAllVideo('id_video DESC','6');
            foreach($videos as $vid){
        ?>
            <div class="col-lg-4  col-md-6 pb-30" style="padding-top:20px;">
                <div class="single-service" style="text-align:center;">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="<?=$vid['url'];?>"></iframe>
                </div>
                <h4><?=$vid['title'];?></h4>
                <a class="primary-btn" href="<?=$vid['url'];?>">Tonton Vidio</a>                    
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
<!-- End video section -->

<!-- Start pagination section -->
<section class="blog-lists-section" style="padding:30px 0px;background-color:#fff">
    <div class="container">
        <div class="blog-lists">
            <nav>
                <ul class="pagination">
                <?=$this->video()->getVideoPaging('6', $this->e($page), '1', $this->e($front_paging_prev), $this->e($front_paging_next));?>
                </ul>
            </nav>
        </div> 
    </div>
</section>
<!-- End pagination section -->