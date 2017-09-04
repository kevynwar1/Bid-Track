<html lang="pt-br" ng-app>
<head>
	<title><?= SYSTEM_NAME; ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<meta name="viewport" content="width=device-width" />

	<!-- Facebook -->
	<meta property="og:title" content="Coopera"/>
	<meta property="og:image" content="<?= base_url() ?>assets/img/129x129.png"/>
	<meta property="og:url" content="<?= base_url() ?>"/>

	<!-- Twitter -->
	<meta name="twitter:title" content="Coopera" />
	<meta name="twitter:url" content="<?= base_url() ?>" />
	<meta name="twitter:card" content="summary" />

	<!-- Apple -->
	<meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="<?= SYSTEM_NAME; ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style-700.css" type="text/css" media="screen and (max-width: 780px)">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/modal.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/material-dashboard.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/demo.css" />

	<!-- Phone -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/component.css" />

	<link href="https://fonts.googleapis.com/css?family=Roboto|Work+Sans" rel="stylesheet">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet">

	<style type="text/css">
		*, html, body, iframe { overflow: hidden !important; }
		@font-face {
			font-family: 'museo300';
			src: url('<?= base_url(); ?>assets/fonts/museo300-regular-webfont.woff2') format('woff2'),
				 url('<?= base_url(); ?>assets/fonts/museo300-regular-webfont.woff') format('woff');
			font-weight: normal;
			font-style: normal;
		}

		.ct-home, .ct-video {
			height: 100% !important;
			-webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%) !important;
			clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%) !important;
		}

		.ct-title {
			z-index: 999;
			position: absolute;
			width: 100% !important;
			top: 40% !important;
			text-align: center !important;
			font-size: 80px !important;
			color: #FFF !important;
			font-family: 'museo300' !important;
		}

		.opacity {
			opacity: 0.5;
			filter: alpha(opacity=50);
		}

		.ct-title-big {
			transition: 0.5s;
		}
		.ct-title-big:hover {
			cursor: pointer;
		}

		.ct-title-small {
			z-index: 999;
			width: 100%;
			text-align: center;
			padding-top: 2.5% !important;
			font-size: 50px !important;
			color: #FFF !important;
			font-family: 'museo300' !important;
			display: none;
			cursor: pointer;
		}

		.ct-back {
			position: absolute;
			top: 20%;
			left: 10%;
			width: 80%;
			height: 80%;
			background: none;
			border-radius: 4px 4px 0 0;
			z-index: 9999;
			display: none;
		}

		.hover {
			font-family: 'Work Sans';
			font-size: 17px;
			text-transform: capitalize;
			transition: 0.5s;
		}
		.hover:hover { font-size: 40px; }

		::-moz-scrollbar, .bl-content ::-moz-scrollbar  {
			width: 12px;
			background: #09F;
		}
	</style>
</head>
<body>
	<div class="ct-video" data-vide-bg="<?= base_url() ?>assets/video/bid_track" data-vide-options="position: 70%"></div>
	<header class="ct-home"></header>

	<div class="ct-title animated fadeInUp" id="bid">
		<span class="ct-title-big">
			Bid & Track
			<span class="opacity" style="font-family: 'Work Sans'; font-size: 20px;">Pitch</span>

			<div id="membros" class="animated fadeIn" style="display: none;">
				<span class="hover">Antonio Correa</span><br>
				<span class="hover">Bruno Mulatinho</span><br>
				<span class="hover">Carlos Eduardo</span><br>
				<span class="hover">Erick Bezerra</span><br>
				<span class="hover">Ikaro Sales</span><br>
				<span class="hover">Kevyn Herbet</span><br>
				<span class="hover">Luis Calabria</span><br>
				<span class="hover">Rafael Roberto</span><br>
				<span class="hover">Willi Guilherme</span><br>
			</div>
		</span>
	</div>
	<div class="ct-title-small animated fadeInDown" id="bid-app">
		Bid & Track
		<span class="opacity" style="font-family: 'Work Sans'; font-size: 15px;">Pitch</span>
	</div>

	<div class="ct-back animated fadeInUp" id="back-app">
		<iframe src="<?= base_url().'home/apresentacao/index' ?>" width="100%" height="100%" frameborder="0"></iframe>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.vide.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var bid = document.getElementById("bid");
			var bid_app = document.getElementById("bid-app");
			var back_app = document.getElementById("back-app");
			var membros = document.getElementById("membros");

			bid.onclick = function() {
				bid.style.display = "none";
				bid_app.style.display = "block";
				back_app.style.display = "block";
			}

			bid_app.onclick = function() {
				bid_app.style.display = "none";
				back_app.style.display = "none";
				bid.style.display = "block";
			}

			function keyPressed(evt){
				evt = evt || window.event;
				var key = evt.keyCode || evt.which;
				return String.fromCharCode(key); 
			}

			document.onkeypress = function(evt) {
				var str = keyPressed(evt);

				if(str == 'b') {
					membros.style.display = "block";
				} else if(str = 't') {
					membros.style.display = "none";
				}
			};
		});
	</script>
</body>
</html>