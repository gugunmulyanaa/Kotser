<div class="col-lg-4">
    <div class="sidebar-wrap">
        <div class="single-widget search-widget">
            <h4 class="widget-title">Pencarian Berita</h4>
            <div class="sidebar-form">
                <form action="<?= BASE_URL; ?>/search" class="relative" method="post">
                    <input type="text" name="search" placeholder="<?= $this->e($front_search); ?>..." value="">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="single-widget recent-post-widget">
            <h4 class="widget-title">Berita Terbaru</h4>
            <ul>
                <?php
                $recents_side = $this->post()->getRecent('5', 'DESC', WEB_LANG_ID);
                foreach ($recents_side as $recent_side) {
                    ?>
                    <li class="d-flex flex-row align-items-center">
                        <div class="thumbs">
                            <img class="img-fluid" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $recent_side['picture']; ?>" alt="" style="width: 200px;">
                        </div>
                        <div class="details">
                            <a href="<?= $this->pocore()->call->postring->permalink(rtrim(BASE_URL, '/'), $recent_side); ?>">
                                <h5><?= $recent_side['title']; ?></h5>
                            </a>
                            <p class="text-uppercase">
                                <?= $this->pocore()->call->podatetime->tgl_indo($recent_side['date']); ?>
                            </p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="single-widget archive-widget">
            <h4 class="widget-title"><?= $this->e($front_categories); ?></h4>
            <?php
            $categorys_side = $this->category()->getAllCategory(WEB_LANG_ID);
            foreach ($categorys_side as $category_side) { ?>
                <ul>
                    <li class="d-flex justify-content-between">
                        <a href="<?= BASE_URL; ?>/category/<?= $category_side['seotitle']; ?>"><?= $category_side['title']; ?></a>
                        <span>(<?= count($this->post()->getPostByCategory($category_side['id_category'], '0', 'DESC', WEB_LANG_ID)); ?>)</span>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <div class="single-widget tags-widget">
            <h4 class="widget-title"><?= $this->e($front_tag); ?></h4>
            <ul>
                <?= $this->post()->getAllTag('RAND()', '10', '', 'true', '<li>', '</li>'); ?>
            </ul>
        </div>
        <div class="single-widget social-widget" style="padding:0px">
            <div class="card">
                <div class="card-header">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-pills justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#twitter" data-toggle="tab">
                                        <i class="fa fa-twitter" aria-hidden="true"></i> Twitter
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#instagram" data-toggle="tab">
                                        <i class="fa fa-instagram" aria-hidden="true"></i> Instagram
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
                            <div class="col-lg-8 col-md-4 col-sm-12 text-center">
                                <h3><?= $usernameIG; ?></h3>
                                <p style="margin-top:0px;margin-bottom:10px"><?= $posting ?> posting <?= $follower ?> pengikut</p>
                                <a class="btn btn-primary btn-sm" href="https://www.instagram.com/riyanzoom/"><i class="fa 
                                fa-instagram" aria-hidden="true"></i> Follow Me</a>
                            </div>
                        </div>
                        </br>
                        <div class="row" style="height:30vh;overflow-y: auto;">
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