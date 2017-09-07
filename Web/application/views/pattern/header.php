<?php
	/*error_reporting(0);
	ini_set("display_errors", 0);*/

	$page = $this->uri->segment(1);
	$page_parameter = $this->uri->segment(2);
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

	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/material-dashboard-dash.css" rel="stylesheet"/>
	<link href="<?= base_url(); ?>assets/css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons|Work+Sans' rel='stylesheet' type='text/css'>

	<style type="text/css">
		select {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			width: 100%;
		}

		.btn-pattern {
			font-size: 12px;
			text-transform: uppercase;
			background: none;
			border: none;
			color: #999;
		}
		.btn-pattern:hover { color: #555; }

		.option { padding: 3px; }
		.lm15 { margin-top: -15px; }
		.desc { color: rgb(154, 154, 154); text-transform: uppercase; }
		.th-desc { cursor: pointer; transition: 0.3s; }
		.f10 { font-size: 10px; }
		.f12 { font-size: 12px; }
		.upper { text-transform: uppercase; }
		.collapse-menu {
			background: none !important;
			box-shadow: none !important;
			color: #777 !important;
			transition: 0.3s !important;
		}

		.collapse-menu:hover { color: #000 !important; }
		th { padding-bottom: 15px !important; }
	</style>
</head>
<body>
<div class="wrapper">
	<div class="sidebar" data-color="red"> <!-- data-image="<?= base_url(); ?>assets/img/sidebar-1.jpg" -->
		<div class="logo">
			<a href="#" class="simple-text"><?= SYSTEM_NAME; ?></a>
		</div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<li class="<?= ($page == 'home' || $page == 'dashboard') ? 'active' : '' ?>">
					<a href="<?= base_url().'dashboard' ?>">
						<i class="material-icons">dashboard</i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="<?= ($page == 'romaneio') ? 'active' : '' ?>" routerlinkactive="active">
					<a href="<?= base_url().'romaneio' ?>" href="#romaneio">
						<i class="material-icons">local_shipping</i>
						<p>Romaneio</p>
					</a>
					<div class="collapse <?= ($page == 'romaneio') ? 'in' : '' ?>" id="romaneio" aria-expanded="true">
						<ul>
							<li>
								<a href="<?= base_url().'romaneio' ?>" class="collapse-menu">Listagem</a>
							</li>
							<li>
								<a href="<?= base_url().'romaneio/add' ?>" class="collapse-menu">Cadastrar</a>
							</li>
							<li>
								<a href="<?= base_url().'romaneio/integracao' ?>" class="collapse-menu">Integração</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="active-pro">
					<a href="<?= base_url().'ws/empresa/' ?>" target="_blank">
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
								<li><a href="#">IkaroSales</a></li>
								<li><a href="#">IkaroSales</a></li>
								<li><a href="#">IkaroSales</a></li>
							</ul>
						</li>
						<li>
							<a href="#ikaro" class="dropdown-toggle" data-toggle="dropdown">
 							   <i class="material-icons">person</i>
 							   <p class="hidden-lg hidden-md">Profile</p>
 							   Ikaro Sales
	 						</a>
						</li>
					</ul>
					<?php
						if($page == 'romaneio'):
							if($page_parameter != 'add' && $page_parameter != 'integracao'):
					?>
					<form class="navbar-form navbar-right" role="search">
						<select id="opcao" style="display: none" class="form-control">
							<option value="romaneio">Romaneio</option>
							<option value="estabelecimento">Estabelecimento</option>
							<option value="transportadora">Transportadora</option>
							<option value="motorista">Motorista</option>
							<option value="nota">Nota Fiscal</option>
						</select>
						<div class="form-group is-empty">
							<input type="text" class="form-control" id="procurar" placeholder="Procurar" style="width: 250px; padding-left: 10px">
							<span class="material-input"></span>
						</div>
						<button type="submit" class="btn btn-white btn-round btn-just-icon">
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