<!-- Start header section -->
<header class="header-area" id="header-area">
    <div class="dope-nav-container breakpoint-off">
        <div class="container">
            <div class="row">
                <!-- dope Menu -->
                <nav class="dope-navbar justify-content-between" id="dopeNav">
                    <!-- Logo -->
                    <a class="nav-brand" href="<?= BASE_URL; ?>">
                        <img src="<?= BASE_URL . '/' . DIR_INC; ?>/images/logo.png" alt="" style="width:100%">
                    </a>
                    <!-- Navbar Toggler -->
                    <div class="dope-navbar-toggler">
                        <span class="navbarToggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <!-- Menu -->
                    <div class="dope-menu">
                        <!-- close btn -->
                        <div class="dopecloseIcon">
                            <div class="cross-wrap">
                                <span class="top"></span>
                                <span class="bottom"></span>
                            </div>
                        </div>
                        <!-- Nav Start -->
                        <div class="dopenav">
                            <?php
                            echo $this->menu()->getFrontMenu(
                                WEB_LANG,
                                "class='' id='nav'",
                                "class='cn-dropdown-item has-down'",
                                "class='dropdown'"
                            );
                            ?>
                            <ul id="nav">
                                <li>
                                    <a href="javascript:void(0)"><?= $this->e($front_select_lang); ?></a>
                                    <ul class="dropdown">
                                        <li>
                                            <form method="post" action="<?= BASE_URL; ?>/./" role="form" style="margin:10px;">
                                                <input type="hidden" name="refer" value="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']), array('off', 'no'))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                                <div class="form-group">
                                                    <select class="form-control" name="lang" required="">
                                                        <?php
                                                        $languages = $this->language()->getLanguage('ASC');
                                                        foreach ($languages as $language) {
                                                            echo "<option value='" . $language['code'] . "' " . ($language['code'] == WEB_LANG ? 'selected' : '') . ">" . $language['title'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button class="btn btn-danger btn-block" type="submit"><?= $this->e($front_change_lang); ?></button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>