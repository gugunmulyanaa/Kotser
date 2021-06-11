<?php
session_start();
include_once '../includes/core/config.php';
if (VQMOD == TRUE) {
    require_once '../vqmod/vqmod.php';
    VQMod::bootup();
    include_once VQMod::modCheck('../includes/core/core.php');
} else {
    include_once '../includes/core/core.php';
}
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser']) and empty($_SESSION['login'])) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="Copyright" content="<?= CONF_STRUCTURE; ?>" />
        <meta name="robots" content="index, follow" />
        <meta name="description" content="Log In Page MADANI CMS <?= CONF_STRUCTURE; ?>" />
        <meta name="generator" content="<?= CONF_STRUCTURE; ?> <?= CONF_VER; ?>.<?= CONF_BUILD; ?>" />
        <meta name="author" content="TIM IT Diskominfo Kota Serang" />
        <meta name="language" content="Indonesia" />
        <meta name="revisit-after" content="7" />
        <meta name="webcrawlers" content="all" />
        <meta name="rating" content="general" />
        <meta name="spiders" content="all" />
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
        <!--[if gt IE 8]>
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <![endif]-->
        <title>Log In Page MADANI CMS</title>
        <link rel="shortcut icon" href="../<?= DIR_INC; ?>/images/logo.png" />
        <link type="text/css" rel="stylesheet" href="../<?= DIR_INC; ?>/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="../<?= DIR_INC; ?>/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="../<?= DIR_INC; ?>/css/login.css" />
        <link type="text/css" rel="stylesheet" href="../<?= DIR_INC; ?>/css/patternlock.css" />
        <script type="text/javascript">
            var WEB_URL = "<?= WEB_URL; ?>";
            var DIR_INC = "<?= DIR_INC; ?>";
            var DIR_CON = "<?= DIR_CON; ?>";
            var DIR_ADM = "<?= DIR_ADM; ?>";
        </script>
        <script type="text/javascript" src="../<?= DIR_INC; ?>/js/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../<?= DIR_INC; ?>/js/bootstrap/bootstrap.min.js"></script>
        <style>
            .bg {
                /* The image used */
                background-image: url("../<?= DIR_INC; ?>/images/bg7.jpg");
                /* Full height */
                height: 100%;
                width: 100%;
                /* Center and scale the image nicely */
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>

    <body class="bg">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-wrap">
                            <div class="col-md-12 text-center">
                                <img src="../<?= DIR_INC; ?>/images/logo.png" class="logo" width="100" />
                            </div>
                            <?php
                            if (VQMOD == TRUE) {
                                include_once VQMod::modCheck("route.php");
                            } else {
                                include_once "route.php";
                            }
                            ?>
                            <div class="col-md-12 text-center" id="footer">
                                <p><b><?= CONF_STRUCTURE; ?> &copy; 2019. <br>TIM IT DISKOMINFO KOTA SERANG</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript" src="../<?= DIR_INC; ?>/js/patternlock/patternLock.js"></script>
        <script type="text/javascript" src="../<?= DIR_INC; ?>/js/login-core.js"></script>
    </body>

    </html>
<?php
} else {
    header('location:admin.php?mod=home');
}
?>