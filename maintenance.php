<?php
session_start();

include_once 'includes/core/config.php';

if (VQMOD == TRUE) {
	require_once 'vqmod/vqmod.php';
	VQMod::bootup();
	include_once VQMod::modCheck('includes/core/core.php');
	$core = new PoCore();
} else {
	include_once 'includes/core/core.php';
	$core = new PoCore();
}

if ($core->posetting[16]['value'] == 'N') {
	header('location:./');
} else {
	?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<!-- Your Basic Site Informations -->
		<title>404 - Page Not Found</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="robots" content="index, follow" />
		<meta name="description" content="Website Resmi Pemerintah Kota Serang" />
		<meta name="keywords" content="pemkot serang, pemerintah kota serang, kota serang, serang kota" />
		<meta http-equiv="Copyright" content="Diskominfo Kota Serang" />
		<meta name="author" content="TIM IT Diskominfo Kota Serang" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="language" content="Indonesia" />
		<meta name="revisit-after" content="3" />
		<meta name="webcrawlers" content="all" />
		<meta name="rating" content="general" />
		<meta name="spiders" content="all" />

		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<style>
			html,
			body {
				height: 100vh;
			}

			html:before,
			html:after,
			body:before,
			body:after {
				content: '';
				background: linear-gradient(#203075, #233581);
				border-radius: 50%;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}

			html:before,
			body:before {
				background: linear-gradient(#233581, #203075);
			}

			html {
				background: linear-gradient(#203075, #233581);
				overflow: hidden;
			}

			html:before {
				height: 105vmax;
				width: 105vmax;
				z-index: -4;
			}

			html:after {
				height: 80vmax;
				width: 80vmax;
				z-index: -3;
			}

			body {
				display: flex;
				justify-content: center;
				align-items: center;
				color: #FFF;
				font-family: 'Varela Round', Sans-serif;
				text-shadow: 0 30px 10px rgba(0, 0, 0, 0.15);
			}

			body:before {
				height: 60vmax;
				width: 60vmax;
				z-index: -2;
			}

			body:after {
				height: 40vmax;
				width: 40vmax;
				z-index: -1;
			}

			.main {
				text-align: center;
				z-index: 5;
			}

			p {
				font-size: 18px;
				margin-top: 0;
			}

			h1 {
				font-size: 95px;
				margin: 0;
			}

			button {
				background: linear-gradient(#EC5DC1, #D61A6F);
				padding: 0 12px;
				border: none;
				border-radius: 20px;
				box-shadow: 0 30px 15px rgba(0, 0, 0, 0.15);
				outline: none;
				color: #FFF;
				font: 400 16px/2.5 Nunito, 'Varela Round', Sans-serif;
				text-transform: uppercase;
				cursor: pointer;
			}

			.bubble {
				background: linear-gradient(#EC5DC1, #D61A6F);
				border-radius: 50%;
				box-shadow: 0 30px 15px rgba(0, 0, 0, 0.15);
				position: absolute;
			}

			.bubble:before,
			.bubble:after {
				content: '';
				background: linear-gradient(#EC5DC1, #D61A6F);
				border-radius: 50%;
				box-shadow: 0 30px 15px rgba(0, 0, 0, 0.15);
				position: absolute;
			}

			.bubble:nth-child(1) {
				top: 15vh;
				left: 15vw;
				height: 22vmin;
				width: 22vmin;
			}

			.bubble:nth-child(1):before {
				width: 13vmin;
				height: 13vmin;
				bottom: -25vh;
				right: -10vmin;
			}

			.bubble:nth-child(2) {
				top: 20vh;
				left: 38vw;
				height: 10vmin;
				width: 10vmin;
			}

			.bubble:nth-child(2):before {
				width: 5vmin;
				height: 5vmin;
				bottom: -10vh;
				left: -8vmin;
			}

			.bubble:nth-child(3) {
				top: 12vh;
				right: 30vw;
				height: 13vmin;
				width: 13vmin;
			}

			.bubble:nth-child(3):before {
				width: 3vmin;
				height: 3vmin;
				bottom: -15vh;
				left: -18vmin;
				z-index: 6;
			}

			.bubble:nth-child(4) {
				top: 25vh;
				right: 18vw;
				height: 18vmin;
				width: 18vmin;
			}

			.bubble:nth-child(4):before {
				width: 7vmin;
				height: 7vmin;
				bottom: -10vmin;
				left: -15vmin;
			}

			.bubble:nth-child(5) {
				top: 60vh;
				right: 18vw;
				height: 28vmin;
				width: 28vmin;
			}

			.bubble:nth-child(5):before {
				width: 10vmin;
				height: 10vmin;
				bottom: 5vmin;
				left: -25vmin;
			}
		</style>
	</head>

	<body>
		<div class="bubble"></div>
		<div class="bubble"></div>
		<div class="bubble"></div>
		<div class="bubble"></div>
		<div class="bubble"></div>
		<div class="main">
			<h1>Sorry.. We Are Under Maintenance</h1>
			<p>We Will Back Soon</p>
			<a href="<?= BASE_URL; ?>"><button type="button">Go back</button></a>
		</div>
	</body>

	</html>
<?php } ?>