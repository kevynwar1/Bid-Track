<?php
	/*error_reporting(0);
	ini_set("display_errors", 0);*/

	$page = $this->uri->segment(1);
	$page_parameter = $this->uri->segment(2);

	if(is_null($this->session->userdata('codigo'))) {
		$this->session->set_flashdata('error', 'Sessão encerrada, entre novamente.');
		redirect(base_url());
	}

	$total_romaneio = $this->Romaneio_model->total_ofertavel();
?>
<!doctype html>
<html ng-app lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<script src="<?= base_url(); ?>assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>

	<title><?= SYSTEM_NAME; ?></title>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<meta name="viewport" content="width=device-width">

	<!-- Facebook -->
	<meta property="og:title" content="Bid & Track">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:site_name" content="Bid & Track">
	<meta property="og:description" content="Solução para ofertar e realizar a gestão de entregas das empresas.">
	<meta property="og:image" content="<?= base_url() ?>assets/img/fb.jpg">
	<meta property="og:image:type" content="image/jpeg">

	<!-- Apple -->
	<meta name="apple-mobile-web-app-status-bar-style" content="red">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Bid & Track">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Bid & Track">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>assets/img/129x129.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>assets/img/72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>assets/img/114x144.png">

    <!-- Canonical -->
    <link rel="canonical" href="<?= base_url() ?>romaneio">
    <link rel="canonical" href="<?= base_url() ?>transportadora">

    <link href="<?= base_url(); ?>assets/css/dash.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/material-dashboard-dash.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/demo.css" rel="stylesheet">
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
	<div class="sidebar" data-color="red" data-image="<?= base_url('assets/img/sidebar-bid.jpg'); ?>"> <!-- data-image="<?= base_url(); ?>assets/img/sidebar-1.jpg" -->
		<div class="logo">
			<a href="<?= base_url(); ?>" class="simple-text"><?= SYSTEM_NAME; ?></a>
		</div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<li align="center">
					<div class="author" align="center" style="padding-bottom: 5px">
						<?php if(!is_null($this->session->userdata('foto'))): ?>
							<img class="avatar border-gray" src="<?= base_url('assets/img/foto/'.$this->session->userdata('foto')); ?>" style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid rgba(0,0,0, 0.05)">
						<?php else: ?>
							<img class="avatar border-gray" src="<?= base_url('assets/img/header.png'); ?>" style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid rgba(0,0,0, 0.1);">
						<?php endif; ?>
					</div>
					<?= $this->session->userdata('n_empresa'); ?>
				</li>
				<br>
				<li class="<?= ($page == 'home' || $page == 'dashboard') ? 'active' : '' ?>">
					<a href="<?= base_url('dashboard'); ?>">
						<i class="material-icons">dashboard</i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="<?= ($page == 'destinatario') ? 'active' : '' ?>">
					<a href="<?= base_url('destinatario'); ?>">
						<i class="material-icons">place</i>
						<p>Destinatário</p>
					</a>
				</li>
				<li class="<?= ($page == 'estabelecimento') ? 'active' : '' ?>">
					<a href="<?= base_url('estabelecimento'); ?>" href="#estabelecimento">
						<i class="material-icons">business</i>
						<p>Estabelecimento</p>
					</a>
				</li>
				<li class="<?= ($page == 'motorista') ? 'active' : ''; ?>">
					<a href="<?= base_url('motorista'); ?>" href="#motorista">
						<i class="material-icons">person</i>
						<p>Motorista</p>
					</a>
				</li>
				<li class="<?= ($page == 'romaneio') ? 'active' : '' ?>" routerlinkactive="active">
					<a href="<?= base_url('romaneio'); ?>" href="#romaneio">
						<i class="material-icons">assignment</i>
						<p>Romaneio
							<?php if($page == 'romaneio'): ?>
								<span class="badge pull-right" rel="tooltip" title="Romaneio(s) em Oferta" data-placement="left" style="margin-top: 7px; background: #FFF; color: #D9161D;">
							<?php else: ?>
								<span class="badge pull-right" rel="tooltip" title="Romaneio(s) em Oferta" data-placement="left" style="margin-top: 7px; background: #999;">
							<?php endif; ?>
									<?= $total_romaneio ?>
								</span>
						</p>
					</a>
				</li>
				<li class="<?= ($page == 'transportadora') ? 'active' : '' ?>">
					<a href="<?= base_url('transportadora'); ?>" href="#transportadora">
						<i class="material-icons">local_shipping</i>
						<p>Transportadora</p>
					</a>
				</li>
				<li class="<?= ($page == 'veiculo' || $page == 'tipoveiculo') ? 'active' : ''; ?>">
					<a href="<?= base_url('veiculo'); ?>" href="#veiculo">
						<i class="material-icons">directions_car</i>
						<p>Veículo</p>
					</a>
				</li>
				<li class="<?= ($page == 'tipoocorrencia') ? 'active' : ''; ?>">
					<a href="<?= base_url('tipoocorrencia'); ?>">
						<i class="material-icons">info_outline</i>
						<p>Tipo Ocorrência</p>
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
                            if($page == 'home' || $page == 'dashboard' || !is_null($this->session->flashdata('usuario'))) {
                                echo 'Dashboard';
                            } else if($page == 'romaneio') { 
                                echo 'Romaneio';
                            } else if($page == 'destinatario') { 
                                echo 'Destinatário';
                            } else if($page == 'transportadora') { 
                                echo 'Transportadora';
                            } else if($page == 'estabelecimento') { 
                                echo 'Estabelecimento';
                            } else if($page == 'motorista') { 
                                echo 'Motorista';
                            } else if($page == 'usuario') {
                            	echo 'Configuração';
                            } else if($page == 'tipoveiculo') {
                            	echo 'Tipo de Veículo';
                            } else if($page == 'tipoocorrencia') {
                            	echo 'Tipo Ocorrência';
                            } else if($page == 'veiculo') {
                            	echo 'Veículo';
                            } else {
                                echo $page;
                            }
                        ?>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="<?= base_url('dashboard'); ?>" rel="tooltip" data-placement="bottom" title="Dashboard">
								<i class="material-icons">dashboard</i>
								<p class="hidden-lg hidden-md">Dashboard</p>
							</a>
						</li>
						<!-- li class="dropdown">
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
						</li -->
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
								<li><a href="<?= base_url().'usuario' ?>">Configuração</a></li>
								<li><a href="<?= base_url().'usuario/sair' ?>">Sair</a></li>
							</ul>
						</li>
					</ul>
					<?php
						if($page == 'romaneio' || $page == 'transportadora' || $page == 'estabelecimento' || $page == 'motorista' || $page == 'veiculo' || $page == 'destinatario' || $page == 'tipoveiculo'):
							if($page_parameter != 'add' && $page_parameter != 'integracao' && $page_parameter != 'visualizar' && $page_parameter != 'editar' && $page_parameter != 'imprimir'):
					?>
						<?php if($page == 'romaneio') { ?>
							<form action="<?= base_url().'romaneio/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'transportadora') { ?>
							<form action="<?= base_url().'transportadora/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'estabelecimento') { ?>
							<form action="<?= base_url().'estabelecimento/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'motorista') { ?>
							<form action="<?= base_url().'motorista/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'veiculo') { ?>
							<form action="<?= base_url().'veiculo/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'destinatario') { ?>
							<form action="<?= base_url().'destinatario/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } else if($page == 'tipoveiculo') { ?>
							<form action="<?= base_url().'tipoveiculo/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<?php } ?>
							<div class="form-group is-empty">
								<input type="text" class="form-control" name="procurar" placeholder="Procurar" style="padding-left: 10px" autocomplete="off" value="<?= $this->input->get('procurar') ?>" ng-model="procurar" ng-minlength="3" required>
								<span class="material-input"></span>
							</div>
							<div class="form-group is-empty">
								<select id="filtro" name="filtro" class="form-control" style="padding: 5px;" required>
									<option value="" disabled selected>Filtro</option>
									<?php if($page == 'romaneio') { ?>
										<!-- option class="option" value="cliente">Cliente</option -->
										<option class="option" value="motorista" <?= ($this->input->get('filtro') == 'motorista')? 'selected':'' ?>>Motorista</option>
										<option class="option" value="nota" <?= ($this->input->get('filtro') == 'nota')? 'selected':'' ?>>Nota Fiscal</option>
										<option class="option" value="romaneio" <?= ($this->input->get('filtro') == 'romaneio')? 'selected':'' ?>>
											Romaneio
										</option>
										<option class="option" value="transportadora" <?= ($this->input->get('filtro') == 'transportadora')? 'selected':'' ?>>
											Transportadora
										</option>
									<?php } else if($page == 'transportadora') { ?>
										<option class="option" value="razao_social" <?= ($this->input->get('filtro') == 'razao_social')? 'selected':'' ?>>Razão Social</option>
										<option class="option" value="cnpj" <?= ($this->input->get('filtro') == 'cnpj')? 'selected':'' ?>>CNPJ</option>
										<option class="option" value="bairro" <?= ($this->input->get('filtro') == 'bairro')? 'selected':'' ?>>Bairro</option>
										<option class="option" value="cidade" <?= ($this->input->get('filtro') == 'cidade')? 'selected':'' ?>>Cidade</option>
									<?php } else if($page == 'estabelecimento') { ?>
										<option class="option" value="razao_social" <?= ($this->input->get('filtro') == 'razao_social')? 'selected':'' ?>>Razão Social</option>
										<option class="option" value="cnpj" <?= ($this->input->get('filtro') == 'cnpj')? 'selected':'' ?>>CNPJ</option>
										<option class="option" value="bairro" <?= ($this->input->get('filtro') == 'bairro')? 'selected':'' ?>>Bairro</option>
										<option class="option" value="cidade" <?= ($this->input->get('filtro') == 'cidade')? 'selected':'' ?>>Cidade</option>
									<?php } else if($page == 'motorista') { ?>
										<option class="option" value="nome" <?= ($this->input->get('filtro') == 'nome')? 'selected':'' ?>>Nome</option>
										<option class="option" value="logradouro" <?= ($this->input->get('filtro') == 'logradouro')? 'selected':'' ?>>Logradouro</option>
										<option class="option" value="bairro" <?= ($this->input->get('filtro') == 'bairro')? 'selected':'' ?>>Bairro</option>
										<option class="option" value="cidade" <?= ($this->input->get('filtro') == 'cidade')? 'selected':'' ?>>Cidade</option>
									<?php } else if($page == 'veiculo') { ?>
										<option class="option" value="modelo" <?= ($this->input->get('filtro') == 'modelo')? 'selected':'' ?>>Modelo</option>
										<option class="option" value="motorista" <?= ($this->input->get('filtro') == 'motorista')? 'selected':'' ?>>Motorista</option>
										<option class="option" value="tipo_veiculo" <?= ($this->input->get('filtro') == 'tipo_veiculo')? 'selected':'' ?>>Tipo Veículo</option>
									<?php } else if($page == 'destinatario') { ?>
										<option class="option" value="razao_social" <?= ($this->input->get('filtro') == 'razao_social')? 'selected':'' ?>>Razão Social</option>
										<option class="option" value="cnpj" <?= ($this->input->get('filtro') == 'cnpj')? 'selected':'' ?>>CNPJ</option>
										<option class="option" value="bairro" <?= ($this->input->get('filtro') == 'bairro')? 'selected':'' ?>>Bairro</option>
										<option class="option" value="cidade" <?= ($this->input->get('filtro') == 'cidade')? 'selected':'' ?>>Cidade</option>
									<?php } else if($page == 'tipoveiculo') { ?>
										<option class="option" value="descricao" <?= ($this->input->get('filtro') == 'descricao')? 'selected':'' ?>>Descrição</option>
									<?php } ?>
								</select>
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