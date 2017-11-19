<?php
	if(is_null($this->session->userdata('administrador'))) {
		$this->session->set_flashdata('error', 'Sessão encerrada.');
		redirect(base_url());
	}
?>

<!DOCTYPE html>
<html lang="pt_br" class="no-js">
	<head>
		<title><?= SYSTEM_NAME; ?></title>

		<meta name="robots" content="noindex"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

		<link href="<?= base_url(); ?>assets/img/favicon.ico" rel="shortcut icon">
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/adm/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/adm/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/adm/css/component.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/adm/css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/adm/css/cs-skin-boxes.css" />
		<script src="<?= base_url(); ?>assets/adm/js/modernizr.custom.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
		<style type="text/css">
			label {
				color: #777 !important;
				font-weight: 300 !important;
			}

			.min { font-size: 14px !important; width: auto !important; }
			#result { font-size: 17px; }
			#return { font-size: 13px; text-transform: uppercase; font-weight: 700; padding-left: 15px; }
			nav { display: none !important; }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<table border="0">
						<tr>
							<td><img src="<?= base_url(); ?>assets/img/bid-track-solid-ico.png"></td>
							<td id="return">
								<?= (!is_null($this->session->flashdata('ok')))? $this->session->flashdata('ok') : $this->session->flashdata('mistake'); ?>
							</td>
						</tr>
					</table>
				</div>
				<form id="myform" action="<?= base_url().'empresa/cadastrar' ?>" class="fs-form fs-form-full" method="post" autocomplete="off">
					<ol class="fs-fields">
						<li>
							<label class="fs-field-label fs-anim-upper" id="empresa" for="q1">CNPJ</label>
							<input class="fs-anim-lower" id="q1" name="cnpj" type="text" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" placeholder="CNPJ da Empresa" minlength="18" maxlength="18" required/>
							<span id="result"></span>
							
							<!-- Dados CNPJ -->
							<input type="hidden" class="min" id="razao_social" name="razao_social">
							<input type="hidden" class="min" id="cep" name="cep">
							<input type="hidden" class="min" id="endereco" name="endereco">
							<input type="hidden" class="min" id="numero" name="numero">
							<input type="hidden" class="min" id="complemento" name="complemento">
							<input type="hidden" class="min" id="bairro" name="bairro">
							<input type="hidden" class="min" id="cidade" name="cidade">
							<input type="hidden" class="min" id="uf" name="uf">
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q2" data-info="Nome do Usuário que terá acesso ao sistema">Nome</label>
							<input class="fs-anim-lower" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="q2" name="nome" type="text" placeholder="Nome do Usuário de acesso" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q3" data-info="Iremos enviar o seu acesso para este e-mail.">E-mail</label>
							<input class="fs-anim-lower" id="q3" name="email" type="email" placeholder="ikaro@bidtrack.com" required/>
						</li>
					</ol>
					<button class="fs-submit" type="submit">Cadastrar</button>
				</form>
			</div>
		</div>
		<script src="<?= base_url(); ?>assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
		<script src="<?= base_url(); ?>assets/adm/js/classie.js"></script>
		<script src="<?= base_url(); ?>assets/adm/js/selectFx.js"></script>
		<script src="<?= base_url(); ?>assets/adm/js/fullscreenForm.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
		<script>
			$(document).ready(function() {
				setInterval(function(){ $('#return').fadeOut(); }, 5000);

				$('.fs-continue').fadeOut();
				$('#q1').mask('00.000.000/0000-00');
			});

			$('#q1').blur(function() {
				$.ajax({
					url: '<?= base_url() ?>empresa/cnpj',
					type: 'POST',
					data: 'cnpj='+$('#q1').val(),
					dataType: 'json',
					beforeSend: function () {
						$('#result').html('<img src="<?= base_url() ?>assets/img/Ellipsis.svg">');
					},
					success: function(data) {
						$('#result').text('');
						$('.fs-continue').fadeIn();

						$('#empresa').text(data.nome);
						$('#razao_social').val(data.nome);
						$('#endereco').val(data.endereco);
						$('#numero').val(data.numero);
						$('#complemento').val(data.complemento);
						$('#bairro').val(data.bairro);
						$('#cidade').val(data.cidade);
						$('#cep').val(data.cep);
						$('#uf').val(data.uf);
						$('#email').val(data.email);
					},
					error: function(data) {
						$('.fs-continue').fadeOut();
						$('#empresa').text('CNPJ');
						$('#result').text('CNPJ Inválido, verifique e tente novamente.');
						setInterval(function(){ $('#result').fadeOut(); }, 5000);
					}
				});
			});

			(function() {
				var formWrap = document.getElementById('fs-form-wrap');

				[].slice.call( document.querySelectorAll('select.cs-select')).forEach(function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder').style.backgroundColor = val;
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add(document.body, 'overview');
					}
				} );
			})();
		</script>
	</body>
</html>