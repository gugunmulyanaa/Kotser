<?= $this->layout('index'); ?>

<!-- Start page-top-banner section -->
<section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5" style="background:url('<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $post['picture']; ?>');background-size: cover;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row section-gap-half">
            <div class="col-lg-12 text-center">
                <h1 style="color:#fff;"><?= $this->e($page_title); ?></h1>
            </div>
        </div>
    </div>
</section>
<!-- End about-top-banner section -->

<!-- Start post detail section -->
<section class="blog-lists-section section-gap-full">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details">
                    <div class="post-thumb relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $post['picture']; ?>" alt="<?= $post['title']; ?>">
                    </div>
                    <div class="post-details">
                        <ul class="tags">
                            <li><a href=""><i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->pocore()->call->podatetime->tgl_indo($post['date']); ?></a></li>
                            <li><a href=""><i class="fa fa-eye" aria-hidden="true"></i> <?= $post['hits']; ?> <?= $this->e($front_hits); ?></a></li>
                            <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> <?= $this->post()->getAuthorName($post['editor']); ?></a></li>
                        </ul>
                        <ul class="tags">
                            <li><i class="fa fa-tags" aria-hidden="true"></i> <?= $this->post()->getPostTag($post['tag']); ?></li>
                        </ul>
                        <a href="<?= $this->e($social_url); ?>">
                            <h1><?= $post['title']; ?></h1>
                        </a>
                        <?= htmlspecialchars_decode(html_entity_decode($post['content'])); ?>
                    </div>
                </div>
            </div>
            <!-- Insert Sidebar -->
            <?= $this->insert('sidebar'); ?>
        </div>
    </div>
</section>
<!-- End post detail section -->