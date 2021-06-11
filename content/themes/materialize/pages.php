<?= $this->layout('index'); ?>
<!-- Start page-top-banner section -->
<?php if ($this->e($pages['picture']) != '') { ?>
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5" style="background:url('<?= BASE_URL . '/' . DIR_CON . '/uploads/' . $this->e($pages['picture']); ?>');
        background-size: cover;">
    <?php } ?>
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row section-gap-half">
            <div class="col-lg-12 text-center">
                <h1 style="color:#fff;"><?= $this->e($pages['title']); ?></h1>
            </div>
        </div>
    </div>
</section>
<!-- End about-top-banner section -->

<!-- Start blog-lists section -->
<section class="blog-lists-section section-gap-full">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details">
                    <div class="post-details">
                        <?= htmlspecialchars_decode(html_entity_decode($this->e($pages['content']))); ?>
                    </div>
                </div>
            </div>
            <!-- Insert Sidebar -->
            <?= $this->insert('sidebar'); ?>
        </div>
    </div>
</section>
<!-- End blog-lists section -->