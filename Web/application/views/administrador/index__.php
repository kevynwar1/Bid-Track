<!DOCTYPE html>
<html>
<head>
	<title><?= SYSTEM_NAME; ?></title>

	<meta name="robots" content="noindex"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

	<link href="<?= base_url(); ?>assets/img/favicon.ico" rel="shortcut icon">
	<link href="<?= base_url(); ?>assets/css/dash.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="<?= base_url(); ?>assets/css/material-dashboard-dash.css" rel="stylesheet"/>
	<link href="<?= base_url(); ?>assets/css/demo.css" rel="stylesheet"/>

	<script src="<?= base_url(); ?>assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>

	<style type="text/css">
		.avatar { width: 120px !important; height: 120px !important; }
		.btn-file {
			overflow: hidden;
			vertical-align: middle;
			border-radius: 4px !important;
			text-transform: uppercase;
			font-size: 12px;
			cursor: pointer;
		}

		.btn-file > input {
			position: absolute;
			top: 0;
			right: 0;
			width: 100%;
			height: 100%;
			margin: 0;
			font-size: 23px;
			cursor: pointer;
			filter: alpha(opacity=0);
			opacity: 0;
			direction: ltr;
		}
	</style>
</head>
<body style="padding: 50px 0 50px 0">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-md-offset-1">
					<div class="card">
						<div class="card-header" data-background-color="blue-left">
							<h4 class="title">Empresa</h4>
							<p class="category">Cadastre a <span id="empresa-title">Empresa</span></p>
						</div>
						<div class="card-content">
							<form action="<?= base_url() ?>transportadora/cadastrar" method="post">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>CNPJ</label>
											<input type="text" name="cnpj" id="cnpj" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" class="form-control lm10" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Razão Social</label>
											<input type="text" name="razao_social" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.,/\s]+$" id="empresa-input" class="form-control lm10" autocomplete="off" disabled required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>CEP</label>
											<input type="text" name="cep" id="cep" autocomplete="off" class="form-control lm10" autocomplete="off" disabled required>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label>UF</label>
											<input type="text" name="uf" pattern="[a-zA-Z\s]+$" maxlength="2" id="uf" class="form-control upper lm10" required disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 lm15">
										<div class="form-group">
											<label>Endereço</label>
											<input type="text" name="logradouro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="endereco" class="form-control lm10" autocomplete="off" disabled required>
										</div>
									</div>
									<div class="col-md-1 lm15">
										<div class="form-group">
											<label>Núm.</label>
											<input type="text" name="numero" pattern="[0-9]+$" id="numero" autocomplete="off" class="form-control lm10" disabled required>
										</div>
									</div>
									<div class="col-md-2 lm15">
										<div class="form-group">
											<label>Compl.</label>
											<input type="text" name="complemento" pattern="[a-zA-Z\s]+$" id="complemento" class="form-control lm10" autocomplete="off" disabled>
										</div>
									</div>
									<div class="col-md-3 lm15">
										<div class="form-group">
											<label>Bairro</label>
											<input type="text" name="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="bairro" autocomplete="off" class="form-control lm10" disabled required>
										</div>
									</div>
									<div class="col-md-3 lm15">
										<div class="form-group">
											<label>Cidade</label>
											<input type="text" name="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="cidade" class="form-control lm10" autocomplete="off" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<span class="btn btn-round btn-danger btn-file pull-right">
											<span class="fileinput-new" style="cursor: pointer;">Foto</span>
											<input name="photo" id="fileUpload" type="file">
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Usuário</h4>
						<p class="category">Cadastre a Usuário de acesso da Empresa</p>
					</div>
					<div class="card-content">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Nome</label>
									<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" name="nome" id="nome"  class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 lm15">
								<div class="form-group">
									<label>E-mail</label>
									<input type="email" name="email" class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#cnpj').mask('00.000.000/0000-00');
		$('#cep').mask('00000-000');
		$('#telefone').mask('00 0000-0000');
		$('#cnpj').focus();
	});

	$('#cnpj').blur(function() {
		$.ajax({
			url: '<?= base_url() ?>empresa/cnpj',
			type: 'POST',
			data: 'cnpj='+$('#cnpj').val(),
			dataType: 'json',
			success: function(data) {
				$('#row-transportadora').removeClass('col-md-12').addClass('col-md-8');
				window.setTimeout(function(){
					$('#row-transportadora-info').fadeIn('low');
				}, 500);

				$('.image').html("<a href='<?= base_url() ?>home/mapa?endereco="+data.mapa+"' target='_blank'><img src='https://maps.googleapis.com/maps/api/staticmap?center="+data.mapa+"&zoom=18&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDQjgSKcQEHV6GY-_TL3vxbEwZ6rYG7LVA&format=png&visual_refresh=true&markers=icon:http://i.imgur.com/jRfjvrz.png%7Cshadow:true%7C"+data.mapa+"' style='border-radius:3.5px' alt='"+data.endereco+"' title='"+data.endereco+"'></a>");
				$('#empresa').text(data.nome);
				$('#empresa-title').text(data.nome);
				$('#tipo').text(data.tipo);
				$('#situacao').text(data.situacao);
				$('#atividade').text(data.atividade);
				$('#abertura').text(data.abertura);
				
				$('#empresa-input').val(data.nome).prop('disabled', false);
				$('#endereco').val(data.endereco).prop('disabled', false);
				$('#numero').val(data.numero).prop('disabled', false);
				$('#complemento').val(data.complemento).prop('disabled', false);
				$('#bairro').val(data.bairro).prop('disabled', false);
				$('#cidade').val(data.cidade).prop('disabled', false);
				$('#cep').val(data.cep).prop('disabled', false);
				$('#uf').val(data.uf).prop('disabled', false);
				$('#email').val(data.email).prop('disabled', false);
			},
			error: function(result) {
				if($("#cnpj").val() != '') {
					demo.showNotification('bottom', 'right', 'Desculpe, CNPJ não encontrado na Receita Federal.');
				}

				$('#empresa-input').val("").prop('disabled', true);
				$('#endereco').val("").prop('disabled', true);
				$('#numero').val("").prop('disabled', true);
				$('#complemento').val("").prop('disabled', true);
				$('#bairro').val("").prop('disabled', true);
				$('#cidade').val("").prop('disabled', true);
				$('#cep').val("").prop('disabled', true);
				$('#uf').val("").prop('disabled', true);
				$('#email').val("").prop('disabled', true);

				$('#empresa-title').text("Empresa");
				$('#row-transportadora-info').fadeOut('fast');
				window.setTimeout(function(){
					$('#row-transportadora').removeClass('col-md-8').addClass('col-md-12');
				}, 500);
			}
		});
		return false;
	});
</script>
</html>