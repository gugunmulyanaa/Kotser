<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<!-- Your Basic Site Informations -->
	<title><?= $this->e($page_desc); ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="index, follow" />
	<meta name="description" content="<?= $this->e($page_desc); ?>" />
	<meta name="keywords" content="<?= $this->e($page_key); ?>" />
	<meta http-equiv="Copyright" content="Diskominfo Kota Serang" />
	<meta name="author" content="TIM IT Diskominfo Kota Serang" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="language" content="Indonesia" />
	<meta name="revisit-after" content="3" />
	<meta name="webcrawlers" content="all" />
	<meta name="rating" content="general" />
	<meta name="spiders" content="all" />

	<!-- Social Media Meta -->
	<?php include_once DIR_CON . "/component/setting/meta_social.txt"; ?>

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/owl.carousel.min.css" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/rotating.css" type="text/css" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/css/responsive.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" />

	<!-- Favicons -->
	<link rel="shortcut icon" href="<?= BASE_URL . '/' . DIR_INC; ?>/images/favicon.png" />

	<!-- Javascript -->
	<script src="https://www.google.com/recaptcha/api.js"></script>

</head>

<body>
	<!-- Preloader -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>

	<!-- Insert Header -->
	<?= $this->insert('header'); ?>

	<!-- Insert Content -->
	<?= $this->section('content'); ?>

	<!-- Insert Footer -->
	<?= $this->insert('footer'); ?>

	<!-- Javascript -->
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/vendor/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/vendor/popper.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/jquery.easing.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/jquery.parallax-scroll.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/dopeNav.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/waypoints.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/jquery.stellar.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/jquery.counterup.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/themes/materialize/js/main.js"></script>
	<script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>