<?=$this->layout('index');?>

<!-- Start album section -->
<section class="portfolio-section section-gap-full" style="padding-bottom:0px">
    <div class="container">
    <div class="section-title">
            <h1 class="text-center" style="border-bottom:6px solid #691cff;"><?=$this->e($page_title);?> Foto</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                <?php
                    $albums = $this->gallery()->getAlbum('8', 'id_album ASC', $this->e($page));
                    foreach($albums as $alb){
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="single-portfolio">
                            <img class="img-fluid" src="<?=BASE_URL.'/'.DIR_CON.'/uploads/medium/medium_'.$alb['picture'];?>" alt="<?=$alb['title'];?>">
                            <div class="box-content" style="padding:0px">
                                <a href="<?=BASE_URL.'/gallery/'.$this->e($alb['seotitle']);?>">
                                    <h5 class="title"><?=$alb['title'];?></h5>
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
<!-- End album section -->

<!-- Start pagination section -->
<section class="blog-lists-section" style="padding:30px 0px;background-color:#fff">
    <div class="container">
        <div class="blog-lists">
            <nav>
                <ul class="pagination">
                <?=$this->gallery()->getAlbumPaging('8', $this->e($page), '1', $this->e($front_paging_prev), $this->e($front_paging_next));?>
                </ul>
            </nav>
        </div> 
    </div>
</section>
<!-- End pagination section -->

