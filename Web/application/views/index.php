<html>
<head>
	<title>Redo</title>
	<meta charset="utf-8">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/modal.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" type="text/css">

	<!-- Phone -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/component.css" />

	<link href="https://fonts.googleapis.com/css?family=Roboto|Work+Sans" rel="stylesheet"> 
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
	<div id="myModal" class="modal animated fadeIn">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2>Entrar</h2><br>
			<div class="row">
				<div class="col-md-6">
					<a href="https://www.facebook.com/dialog/oauth?client_id=579530422215248&redirect_uri=http://coopera.pe.hu/redos&scope=email,user_website,user_location" target="_blank">
						<div class="fb btn-entrar" align="center" data-toggle="tooltip" title="Entrar com Facebook">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</div>
					</a>
				</div>
				<div class="col-md-6">
					<a href="index.php?request=twitter">
						<div class="tw btn-entrar" align="center" data-toggle="tooltip" title="Entrar com Twitter">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</div>
					</a>
				</div>
			</div>
			<hr>
			<form action="#" method="post" autocomplete="off">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>E-mail</label>
						<input type="email" placeholder="E-mail" class="form-control" value="ikarosales7@gmail.com" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Senha</label>
						<input type="password" placeholder="Senha" class="form-control" maxlength="12" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="submit" value="Entrar" class="form-control btn-primary">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

	<header class="ct-home"></header>
	<div class="ct-scroll animated fadeInUp" align="center">
		<img src="<?= base_url(); ?>assets/img/mouse.png" width="35">
	</div>
	<nav class="ct-nav col-xs-10 col-xs-offset-1 animated fadeInDown">
		<div class="row">
			<div class="col-md-3" align="center"></div>
			<div class="col-md-6 animated fadeInUp" align="center">
				<!-- ul class="menu" align="center">
					<li class="menu-item menu-active"><a href="#">Inicio</a></li>
					<li class="menu-item"><a href="#">Funcionamento</a></li>
					<li class="menu-item"><a href="#">Contato</a></li>
				</ul -->

				<span class="menu-item menu-active"><a href="#">Inicio</a></span>
				<span class="menu-item"><a href="#funcionamento">Funcionamento</a></span>
				<span class="menu-item"><a href="#">Contato</a></span>
			</div>
			<div class="col-md-3 animated fadeInUp" align="center">
				<ul class="menu">
					<li class="menu-entrar"><a href="#" id="myBtn">Entrar</a></li>
					<li class="menu-cadastrar"><a href="#">Cadastrar</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="ct-message animated fadeInUp">
		<div class="row">
			<div class="col-md-10 col-md-offset-1" align="center">
				<p>Non, je ne regrette rien<br>
				​Prefiro morrer sozinho do que<br>
				ficar sem ninguém.</p>
			</div>
		</div>
		<div class="row" style="padding-top: 50px;">
			<div class="col-md-12" align="center">
				<span class="button-more">Saiba +</span>
			</div>
		</div>
	</div>

	<div class="ct-content animated fadeInUp" name="funcionamento">
		<div class="col-md-10 col-md-offset-1 content-bg" data-midnight="menu-blue">
			<div class="row">
				<div class="col-md-10 col-md-offset-1" align="center">
					<h1>Oceano</h1>
					<p>Non, rien de rien<br>
					Você deságua em mim, e eu, oceano<br>
					Non, je ne regrette rien</p>
				</div>
			</div>
			<div class="row" style="padding-top: 50px;">
				<div class="col-md-10 col-md-offset-1 content-img" align="center">
					<div class="row">
						<div class="col-md-3" align="center">
							<img alt="ico_caminhao" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_dostawa.svg" width="250">
							<div style="width: 250px;"><p>Transporte<br>Transportado Trampo</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img alt="ico_mapa" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_outsourcing.svg" width="250">
							<div style="width: 250px;"><p>Transporte para todos<br>os planetas</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img class="color" alt="ico_oferta_warunki" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_warunki.svg" width="250">
							<div style="width: 250px;"><p>Leilão de Transporte<br>Caminhoneiro caminha</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img class="color" alt="ico_oferta_integracja" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_integracja.svg" width="250">
							<div style="width: 250px;"><p>Integração com ERP<br>utilizando JSON</p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ct-phone">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="ac-wrapper" class="ac-wrapper">
					<h2>
						<img src="<?= base_url(); ?>assets/img/icon_app.png" width="75">
						<br>
						Bid & Track <span>Mobile</span>
					</h2>
					<div class="ac-device">
						<a href="#"><img src="<?= base_url(); ?>assets/img/screen/screen1.jpg"/></a>
						<h3 class="ac-title">Controle sobre Ocorrências</h3>
					</div>
					<div class="ac-grid">
						<a href="#">
							<img src="<?= base_url(); ?>assets/img/screen/screen1.jpg"/>
							<span>Redução dos custos de devolução.</span>
						</a>
						<a href="#">
							<img src="<?= base_url(); ?>assets/img/screen/screen2.jpg"/>
							<span>Controle sobre as entregas.</span>
						</a>
						<a href="#">
							<img src="<?= base_url(); ?>assets/img/screen/screen3.jpg"/>
							<span>Confiabilidade das informações.</span>
						</a>
						<a href="#">
							<img src="<?= base_url(); ?>assets/img/screen/screen4.jpg"/>
							<span>Redução do trabalho manual.</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-footer"></div>
	<!-- footer class="ct-footer">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 animated fadeInUp" align="center">
			</div>		
		</div>
	</footer -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.parallax-1.1.3.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.localscroll-1.2.7-min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.scrollTo-1.4.2-min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/modernizr.custom.js"></script>
	<script src="<?= base_url(); ?>assets/js/appshowcase.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			AppShowcase.init();

			$('.ct-home').parallax("20%", 0.5);
			$('[data-toggle="tooltip"]').tooltip();
		});

		$(window).scroll(function() {
			nScrollPosition = $(window).scrollTop();
			if(nScrollPosition >= 200) {
				$(".ct-scroll").css("display", "none");
			} else {
				$(".ct-scroll").css("display", "block");
			}

			if(nScrollPosition >= 400) { $(".ct-content").css("display", "block"); }
			if(nScrollPosition >= 1350) { $(".ct-footer").css("display", "block"); }
		});

		var modal = document.getElementById("myModal");
		var btn = document.getElementById("myBtn");
		var span = document.getElementsByClassName("close")[0];

		btn.onclick = function() {
			modal.style.display = "block";
		}

		span.onclick = function() {
			modal.style.display = "none";
		}

		window.onclick = function(event) {
			if(event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
</body>
</html>