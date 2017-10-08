<?php
	/*error_reporting(0);
	ini_set("display_errors", 0);*/

	$page = $this->uri->segment(1);
	$page_parameter = $this->uri->segment(2);

	if(is_null($this->session->userdata('codigo'))) {
		$this->session->set_flashdata('error', 'Sessão encerrada, realiza o Login novamente.');
		redirect(base_url());
	}
?>
<!doctype html>
<html ng-app lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<script src="<?= base_url(); ?>assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>

	<title><?= SYSTEM_NAME; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Facebook -->
	<meta property="og:title" content="Bid & Track"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:site_name" content="Bid & Track">
	<meta property="og:description" content="Solução para ofertar e realizar a gestão de entregas das empresas.">
	<meta property="og:image" content="<?= base_url() ?>assets/img/fb.jpg">
	<meta property="og:image:type" content="image/jpeg">

	<!-- Apple -->
	<meta name="apple-mobile-web-app-status-bar-style" content="red">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Bid & Track">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Bid & Track">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>assets/img/129x129.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>assets/img/72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>assets/img/114x144.png">

    <!-- Canonical -->
    <link rel="canonical" href="<?= base_url() ?>romaneio">
    <link rel="canonical" href="<?= base_url() ?>transportadora">

    <link href="<?= base_url(); ?>assets/css/dash.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/material-dashboard-dash.css" rel="stylesheet"/>
	<link href="<?= base_url(); ?>assets/css/demo.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/img/favicon.ico" rel="shortcut icon">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons|Work+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!is_null($this->session->flashdata('success'))) { ?>
			demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('success'); ?>');
		<?php } else if(!is_null($this->session->flashdata('error'))) { ?>
			demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('error'); ?>');
		<?php } ?>
	});
	</script>
</head>
<body>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '119082038778375',
			xfbml      : true,
			version    : 'v2.10'
		});
		FB.AppEvents.logPageView();
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="wrapper">
	<div class="sidebar" data-color="red"> <!-- data-image="<?= base_url(); ?>assets/img/sidebar-1.jpg" -->
		<div class="logo">
			<a href="#" class="simple-text"><?= SYSTEM_NAME; ?></a>
		</div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<li class="<?= ($page == 'home' || $page == 'dashboard' || $page == 'usuario') ? 'active' : '' ?>">
					<a href="<?= base_url().'dashboard' ?>">
						<i class="material-icons">dashboard</i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="<?= ($page == 'romaneio') ? 'active' : '' ?>" routerlinkactive="active">
					<a href="<?= base_url().'romaneio' ?>" href="#romaneio">
						<i class="material-icons">assignment</i>
						<p>Romaneio</p>
					</a>
					<?php if($this->session->userdata('perfil') == 'A'): ?>
						<div class="collapse <?= ($page == 'romaneio') ? 'in' : '' ?>" id="romaneio" aria-expanded="true">
							<ul>
								<li>
									<a href="<?= base_url().'romaneio/add' ?>" class="collapse-menu">Cadastrar</a>
								</li>
								<li>
									<a href="<?= base_url().'romaneio/integracao' ?>" class="collapse-menu">Integração</a>
								</li>
							</ul>
						</div>
					<?php endif; ?>
				</li>
				<li class="<?= ($page == 'transportadora') ? 'active' : '' ?>">
					<a href="<?= base_url().'transportadora' ?>" href="#transportadora">
						<i class="material-icons">local_shipping</i>
						<p>Transportadora</p>
					</a>
				</li>
				<li class="active-pro">
					<a href="#" target="_blank">
						<i class="material-icons">message</i>
						<p>Mensagem</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="main-panel">
		<nav class="navbar navbar-transparent navbar-absolute">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<?php
                            if($page == 'home' || $page == 'dashboard') {
                                echo 'Dashboard';
                            } else if($page == 'romaneio') { 
                                echo 'Romaneio';
                            } else if($page == 'transportadora') { 
                                echo 'Transportadora';
                            } else {
                                echo $page;
                            }
                        ?>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<!-- li>
							<a href="<?= base_url().'dashboard' ?>">
								<i class="material-icons">settings</i>
								<p class="hidden-lg hidden-md">Configuração</p>
							</a>
						</li -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="material-icons">notifications</i>
								<span class="notification">3</span>
								<p class="hidden-lg hidden-md">Notifications</p>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Ikaro Sales</a></li>
								<li><a href="#">Neymar Jr.</a></li>
								<li><a href="#">Kylian Mbappe</a></li>
							</ul>
						</li>
						<li>
							<a href="#ikaro" class="dropdown-toggle" data-toggle="dropdown">
 							   <i class="material-icons">person</i>
 							   <p class="hidden-lg hidden-md">Profile</p>
								<?php
									$nome = explode(" ", $this->session->userdata('nome'));
									echo (count($nome) >= 2)? $nome[0]." ".end($nome) : $nome[0];
								?>
	 						</a>
	 						<ul class="dropdown-menu">
	 							<li><a href="#">Configuração</a></li>
								<li><a href="<?= base_url().'usuario/sair' ?>">Sair</a></li>
							</ul>
						</li>
					</ul>
					<?php
						if($page == 'romaneio' || $page == 'transportadora'):
							if($page_parameter != 'add' && $page_parameter != 'integracao' && $page_parameter != 'visualizar' && $page_parameter != 'editar' && $page_parameter != 'imprimir'):
					?>
						<form action="<?= base_url().'romaneio/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
							<div class="form-group is-empty">
								<input type="text" class="form-control" name="procurar" placeholder="Procurar" style="padding-left: 10px" autocomplete="off" value="<?= $this->input->get('procurar') ?>" ng-model="procurar" ng-minlength="3" required>
								<span class="material-input"></span>
							</div>
							<div class="form-group is-empty">
								<?php if($page == 'romaneio'): ?>
								<select id="filtro" name="filtro" class="form-control" required>
									<option value="" disabled selected>Filtro</option>
									<option class="option" value="cliente">Cliente</option>
									<option class="option" value="motorista" <?= ($this->input->get('filtro') == 'motorista')? 'selected':'' ?>>Motorista</option>
									<option class="option" value="nota" <?= ($this->input->get('filtro') == 'nota')? 'selected':'' ?>>Nota Fiscal</option>
									<option class="option" value="romaneio" <?= ($this->input->get('filtro') == 'romaneio')? 'selected':'' ?>>
										Romaneio
									</option>
									<option class="option" value="transportadora" <?= ($this->input->get('filtro') == 'transportadora')? 'selected':'' ?>>
										Transportadora
									</option>
								</select>
							<?php endif; ?>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon" ng-disabled="!procurar">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>
					<?php
							endif;
						endif;
					?>
				</div>
			</div>
		</nav>