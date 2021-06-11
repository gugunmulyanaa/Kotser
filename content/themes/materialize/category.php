<?= $this->layout('index'); ?>

<!-- Start page-top-banner section -->
<section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5" style="background:url('<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/alun-alun.jpg');background-size: cover;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row section-gap-half">
            <div class="col-lg-12 text-center">
                <h1 style="color:#fff;"><?= $this->e($front_category); ?></h1>
                <h4 style="color:#fff;"><?= $this->e($page_title); ?></h4>
            </div>
        </div>
    </div>
</section>
<!-- End about-top-banner section -->

<!-- Start category section -->
<section class="blog-lists-section section-gap-full">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-lists">
                    <?php
                    $categorys = $this->post()->getPostFromCategory('5', 'id_post_category DESC', 'post.id_post DESC', $category, $this->e($page), WEB_LANG_ID);
                    foreach ($categorys as $post) {
                        ?>
                        <div class="single-blog-post">
                            <div class="post-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $post['picture']; ?>" alt="<?= $post['title']; ?>">
                            </div>
                            <div class="post-details">
                                <a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $post); ?>">
                                    <h1><?= $post['title']; ?></h1>
                                </a>
                                <p>
                                    <?= $this->pocore()->call->postring->cuthighlight('post', $post['content'], '200'); ?>...
                                </p>
                                <ul class="tags" style="margin-bottom:15px;margin-top:-15px;">
                                    <li><a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $post); ?>"><?= $this->e($front_readmore); ?></a></li>
                                </ul>
                                <div class="user-details d-flex align-items-center">
                                    <div class="user-img">
                                        <img src="<?= $this->asset('/img/avatar.png') ?>" alt="">
                                    </div>
                                    <div class="details">
                                        <a href="#">
                                            <h4><?= $this->post()->getAuthorName($post['editor']); ?></h4>
                                        </a>
                                        <p><?= $this->pocore()->call->podatetime->tgl_indo($post['date']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <nav>
                        <ul class="pagination">
                            <?= $this->post()->getCategoryPaging('5', $category, $this->e($page), '1', $this->e($front_paging_prev), $this->e($front_paging_next)); ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Insert Sidebar -->
            <?= $this->insert('sidebar'); ?>
        </div>
    </div>
</section>
<!-- End category section -->