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
</head>
<body>
	<div id="modal-cadastrar" class="modal animated fadeIn">
		<div class="modal-content">
			<span class="close close-cadastrar" data-toggle="tooltip" title="Fechar">&times;</span>
			<div class="card">
				<div class="card-header" data-background-color="red">
					<h2 class="title">Cadastrar</h2>
					<p class="category" id="subtitle">Cadastre sua Empresa</p>
				</div>
				<div class="card-content">
					<br>
					<form action="<?= base_url().'empresa/cadastrar' ?>" method="post" autocomplete="off">
						<div id="step-1" class="animated fadeIn">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>CNPJ</label>
										<input type="text" name="cnpj" id="cnpj" ng-model="cnpj" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" placeholder="CNPJ" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Empresa</label>
										<input type="text" name="empresa" id="empresa" ng-model="empresa" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.,\s]+$" placeholder="Empresa" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Endereço</label>
										<input type="text" name="endereco" id="endereco" ng-model="endereco" placeholder="Endereço" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Bairro</label>
										<input type="text" name="bairro" id="bairro" ng-model="bairro" placeholder="Bairro" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Cidade</label>
										<input type="text" name="cidade" id="cidade" ng-model="cidade" placeholder="Cidade" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Estado</label>
										<select name="estado" ng-model="estado" class="form-control" required>
											<option value="" selected disabled>Estado</option>
											<option value="AC">Acre</option>
											<option value="AL">Alagoas</option>
											<option value="AP">Amapá</option>
											<option value="AM">Amazonas</option>
											<option value="BA">Bahia</option>
											<option value="CE">Ceará</option>
											<option value="DF">Distrito Federal</option>
											<option value="ES">Espírito Santo</option>
											<option value="GO">Goiás</option>
											<option value="MA">Maranhão</option>
											<option value="MT">Mata Grosso</option>
											<option value="MS">Mata Grosso do Sul</option>
											<option value="MG">Minas Gerais</option>
											<option value="PA">Pará</option>
											<option value="PB">Paraíba</option>
											<option value="PR">Paraná</option>
											<option value="PE">Pernambuco</option>
											<option value="PI">Piauí</option>
											<option value="RJ">Rio de Janeiro</option>
											<option value="RN">Rio Grande do Norte</option>
											<option value="RS">Rio Grande do Sul</option>
											<option value="RO">Rondônia</option>
											<option value="RR">Roraima</option>
											<option value="SC">Santa Catarina</option>
											<option value="SP">São Paulo</option>
											<option value="SE">Sergipe</option>
											<option value="TO">Tocantins</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Telefone</label>
										<input type="text" name="telefone" id="telefone" ng-model="telefone" placeholder="Telefone" class="form-control" required>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="button" ng-disabled="!cnpj || !empresa || !endereco || !bairro || !cidade || !estado || !telefone" id="avancar-cadastrar" value="Avançar" class="form-control btn-primary">
									</div>
								</div>
							</div>
						</div>
						<div id="step-2" class="animated fadeIn" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nome</label>
										<input type="text" name="nome" id="nome" ng-model="nome" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" placeholder="Nome" class="form-control" value="Ikaro Sales" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>E-mail</label>
										<input type="email" name="email" id="email" ng-model="email" placeholder="E-mail" class="form-control" value="ikarosales7@gmail.com" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Senha</label>
										<input type="password" name="senha" ng-model="senha" placeholder="Senha" class="form-control" maxlength="12" required>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="button" id="voltar-cadastrar" value="Voltar" class="form-control btn-primary">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="submit" id="cadastrar" value="Cadastrar" ng-disabled="!nome || !email || !senha" class="form-control btn-primary-active">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-entrar" class="modal animated fadeIn">
		<div class="modal-content">
			<span class="close close-entrar" data-toggle="tooltip" title="Fechar">&times;</span>
			<div class="card">
				<div class="card-header" data-background-color="red">
					<h2 class="title">Entrar</h2>
					<p class="category">Login para Empresas</p>
				</div>
				<div class="card-content table-responsive">
					<br>
					<form action="#" method="post" autocomplete="off">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>E-mail</label>
								<input type="email" ng-model="login_email" placeholder="E-mail" id="email" class="form-control" value="ikarosales7@gmail.com" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Senha</label>
								<input type="password" ng-model="login_senha" placeholder="Senha" class="form-control" maxlength="12" required>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="Entrar" ng-disabled="!login_email || !login_senha" class="form-control btn-primary">
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="ct-video" data-vide-bg="<?= base_url() ?>assets/video/bid_track" data-vide-options="position: 70%, muted: true"></div>
	<header class="ct-home"></header>
	<div class="ct-scroll animated fadeInDown" align="center">
		<img src="<?= base_url(); ?>assets/img/mouse.png" width="35">
	</div>
	<nav class="ct-nav col-md-10 col-md-offset-1 animated fadeInDown">
		<div class="row">
			<div class="col-md-3 animated fadeInUp" align="center"></div>
			<div class="col-md-6 animated fadeInUp" align="center">
				<span class="menu-item menu-active"><a href="#">Início</a></span>
				<span class="menu-item"><a href="#servicos">Serviços</a></span>
				<span class="menu-item"><a href="<?= base_url().'dashboard' ?>">Contato</a></span>
			</div>
			<div class="col-md-3 animated fadeInUp" align="center">
				<span class="menu-entrar"><a id="btEntrar">Entrar</a></span>
				<span class="menu-cadastrar"><a id="btCadastrar">Cadastrar</a></span>
			</div>
		</div>
	</nav>

	<div class="ct-message animated fadeInUp">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 animated fadeInUp" id="p-message" align="center">
				<p>Solução para ofertar<br>
				e realizar a gestão<br>
				de entregas das empresas.</p><br>
				<span class="button-more">Saiba +</span>
			</div>
		</div>
	</div>

	<div class="ct-content animated fadeInUp">
		<div class="col-md-10 col-md-offset-1 content-bg" data-midnight="menu-blue" name="servicos">
			<div class="row">
				<div class="col-md-10 col-md-offset-1" align="center">
					<h1>Serviços</h1>
					<p>Tecnologias de qualidade<br>
					superior, ajudam você<br>
					a alcançar seus objetivos.</p>
				</div>
			</div>
			<div class="row" style="padding-top: 50px;">
				<div class="col-md-10 col-md-offset-1 content-img" align="center">
					<div class="row">
						<div class="col-md-3" align="center">
							<img alt="ico_caminhao" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_dostawa.svg" width="240">
							<div style="width: 250px;"><p>Oferta de viagens para<br>motoristas da empresa</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img alt="ico_mapa" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_outsourcing.svg" width="240">
							<div style="width: 250px;"><p>Gerenciamento de rotas<br>para os motoristas</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img alt="ico_oferta_warunki" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_warunki.svg" width="240">
							<div style="width: 250px;"><p>Redução dos custos<br>sobre a devolução</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img alt="ico_oferta_integracja" src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_integracja.svg" width="240">
							<div style="width: 250px;"><p>Apoio à integração<br>com nosso sistema.</p></div>
						</div>
					</div>
					<div class="row" style="padding-top: 50px">
						<div class="col-md-3 col-md-offset-3" align="center">
							<img src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_promocje.svg" width="240">
							<div style="width: 250px;"><p>Classifique os<br>motoristas da empresa</p></div>
						</div>
						<div class="col-md-3" align="center">
							<img src="https://www.netfox.pl/wp-content/themes/netfox/images/svg_icon/color/ico_oferta_szeroka.svg" width="240">
							<div style="width: 250px;"><p>Portal Web de gestão<br>para empresas</p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ct-phone animated fadeInUp">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="ac-wrapper" class="ac-wrapper">
					<h2>
						<?= SYSTEM_NAME; ?><span>Mobile</span>
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
	<footer>
		<div class="row">
			<div class="ct-footer col-md-10 col-md-offset-1 animated fadeInUp" align="center">
				<div class="row" style="padding: 35px 0 25px 0">
					<div class="col-md-10 col-md-offset-1">
						<span class="menu-item menu-active"><a href="#">Início</a></span>
						<span class="menu-item"><a href="#servicos">Serviços</a></span>
						<span class="menu-item"><a href="#">Contato</a></span>
					</div>
				</div>
				<div class="row" style="padding: 0 0 35px 0;">
					<div class="col-md-5 col-md-offset-1" align="left">
						Copyright © <?= SYSTEM_NAME; ?><br>
						Todos os direitos reservados
					</div>
				</div>
			</div>		
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.parallax-1.1.3.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.localscroll-1.2.7-min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.scrollTo-1.4.2-min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/modernizr.custom.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/appshowcase.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.vide.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			AppShowcase.init();

			$('.ct-video').parallax("20%", 0.7);
			$('[data-toggle="tooltip"]').tooltip();

			$('#cnpj').mask('00.000.000/0000-00');
			$('#telefone').mask('00 0000-0000');

			$('#cnpj').blur(function() {
				$.ajax({
					url: '<?= base_url() ?>empresa/cnpj',
					type: 'POST',
					data: 'cnpj='+$('#cnpj').val(),
					dataType: 'json',
					success: function(data) {
						$('#empresa').val(data.nome);
						$('#endereco').val(data.endereco);
						$('#bairro').val(data.bairro);
						$('#cidade').val(data.cidade);
						$('#email').val(data.email);
					}
				});
				return false;
			});
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

		var entrar = document.getElementById("btEntrar");
		var close_entrar = document.getElementsByClassName("close-entrar")[0];
		var modal_entrar = document.getElementById("modal-entrar");
		
		var cadastrar = document.getElementById("btCadastrar");		
		var close_cadastrar = document.getElementsByClassName("close-cadastrar")[0];
		var modal_cadastrar = document.getElementById("modal-cadastrar");
		var step_1 = document.getElementById("step-1");
		var step_2 = document.getElementById("step-2");
		var btn_avancar = document.getElementById("avancar-cadastrar");
		var btn_voltar = document.getElementById("voltar-cadastrar");
		var btn_cadastrar = document.getElementById("cadastrar");

		cadastrar.onclick = function() { modal_cadastrar.style.display = "block"; cnpj.focus(); }
		entrar.onclick = function() { modal_entrar.style.display = "block"; email.focus(); }

		close_cadastrar.onclick = function() { modal_cadastrar.style.display = "none"; }
		close_entrar.onclick = function() { modal_entrar.style.display = "none"; }

		btn_avancar.onclick = function() {
			document.getElementById("subtitle").innerHTML = "Cadastre o representante da Empresa";
			step_1.style.display = "none";
			step_2.style.display = "block";
			nome.focus();
		}
		btn_voltar.onclick = function() {
			document.getElementById("subtitle").innerHTML = "Cadastre sua Empresa";
			step_2.style.display = "none";
			step_1.style.display = "block";
		}

		window.onclick = function(event) {
			if(event.target == modal_cadastrar) {
				modal_cadastrar.style.display = "none";
			} else if(event.target == modal_entrar) {
				modal_entrar.style.display = "none";
			}
		}
	</script>
</body>
</html>