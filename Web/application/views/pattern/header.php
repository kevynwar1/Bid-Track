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
	<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!is_null($this->session->flashdata('success'))) { ?>
			demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('success') ?>');
		<?php } else if(!is_null($this->session->flashdata('error'))) { ?>
			demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('error') ?>');
		<?php } ?>
	});
	</script>

	<style type="text/css">
		select {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			width: 100%;
		}

		.status {
			text-transform: uppercase;
			padding: 5px 10px 5px 10px;
			border-radius: 2px;
			font-size: 10.5px;
			box-shadow: 0 5px 5px rgba(0,0,0, 0.1);
			cursor: default;
			transition: 0.3s;
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
		.option-undefined { padding: 3px; color: #999 !important; }
		.lm15 { margin-top: -15px; }
		.desc { color: rgb(154, 154, 154); text-transform: uppercase; }
		.th-desc { cursor: pointer; transition: 0.3s; }
		.f10 { font-size: 10px; }
		.f11 { font-size: 11px; }
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
		.gray { color: #999; }
		.panel-heading { background: none !important; }
		.panel-title { font-size: 14px !important; }

		.option_none { display: none; }
		.adp-placemark tr { border-radius: 5px !important; }
		.adp-legal { display: none !important; }
		.adp-text { padding: 10px !important;}
		footer { display: none !important; }
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
					<a href="#' ?>" target="_blank">
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
							if($page_parameter != 'add' && $page_parameter != 'integracao' && $page_parameter != 'visualizar' && $page_parameter != 'editar'):
					?>
					<form action="<?= base_url().'romaneio/s/' ?>" method="get" class="navbar-form navbar-right" role="search">
						<div class="form-group is-empty">
							<input type="text" class="form-control" name="procurar" placeholder="Procurar" style="padding-left: 10px" autocomplete="off" value="<?= $this->input->get('procurar') ?>" ng-model="procurar" ng-minlength="3" required>
							<span class="material-input"></span>
						</div>
	<select id="filtro" name="filtro" class="form-control" ng-disabled="!procurar" required>
		<option value="" disabled selected>Filtro</option>
		<option value="destinatario">Destinatário</option>
		<option value="motorista" <?= ($this->input->get('filtro') == 'motorista')? 'selected':'' ?>>Motorista</option>
		<option value="nota">Nota Fiscal</option>
		<option value="romaneio" <?= ($this->input->get('filtro') == 'romaneio')? 'selected':'' ?>>
			Romaneio
		</option>
		<option value="transportadora" <?= ($this->input->get('filtro') == 'transportadora')? 'selected':'' ?>>
			Transportadora
		</option>
	</select>
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