<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Motorista</h4>
						<p class="category">Cadastre o Motorista {{nome}}</p>
					</div>
					<div class="card-content">
						<form action="<?= base_url()."motorista/cadastrar" ?>" method="post">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label">Nome</label>
									<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç./\s]+$" class="form-control codigo" name="nome" ng-model="nome" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label">E-mail</label>
									<input type="email" name="email" id="email" ng-model="email" class="form-control email" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">CPF</label>
									<input type="text" minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" class="form-control codigo" name="cpf" id="cpf" ng-model="cpf" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Tipo Carteira</label>
									<select class="form-control" name="tipo_carteira" ng-model="tipo_carteira" id="tipo_carteira">
										<option value="" class="option_none" disabled selected></option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Validade Carteira</label>
									<input type="text" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" maxlength="10" name="validade_carteira" id="validade_carteira" autocomplete="off" ng-model="validade_carteira" required>
								</div>
							</div>
						</div>
						<div class="row" id="endereco_usuario">
							<div class="col-md-2 lm10">
								<div class="form-group label-floating">
									<label class="control-label">CEP</label>
									<input type="text" name="cep" id="cep" autocomplete="off" class="form-control" autocomplete="off" pattern="\d{5}-\d{3}" ng-model="cep" required>
								</div>
							</div>
							<div class="col-md-3 lm10">
								<div id="label-endereco" class="form-group label-floating">
									<label class="control-label">Endereço</label>
									<input type="text" name="logradouro" id="logradouro" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç,.-/\s]+$" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1 lm10">
								<div id="label-numero" class="form-group label-floating">
									<label class="control-label">Número</label>
									<input type="text" name="numero" id="numero" class="form-control" pattern="[0-9]+$" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1 lm10">
								<div id="label-complemento" class="form-group label-floating">
									<label class="control-label">Compl.</label>
									<input type="text" name="complemento" id="complemento" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç0-9./\s]+$" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2 lm10">
								<div id="label-bairro" class="form-group label-floating">
									<label class="control-label">Bairro</label>
									<input type="text" name="bairro" id="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2 lm10">
								<div id="label-cidade" class="form-group label-floating">
									<label class="control-label">Cidade</label>
									<input type="text" name="cidade" id="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1 lm10">
								<div id="label-uf" class="form-group label-floating">
									<label class="control-label">UF</label>
									<select class="form-control" name="uf" id="uf">
										<option value="" class="option_none" disabled selected></option>
										<option value="AC">AC</option>
										<option value="AL">AL</option>
										<option value="AP">AP</option>
										<option value="AM">AM</option>
										<option value="BA">BA</option>
										<option value="CE">CE</option>
										<option value="DF">DF</option>
										<option value="ES">ES</option>
										<option value="GO">GO</option>
										<option value="MA">MA</option>
										<option value="MT">MT</option>
										<option value="MS">MS</option>
										<option value="MG">MG</option>
										<option value="PA">PA</option>
										<option value="PB">PB</option>
										<option value="PR">PR</option>
										<option value="PE">PE</option>
										<option value="PI">PI</option>
										<option value="RJ">RJ</option>
										<option value="RN">RN</option>
										<option value="RS">RS</option>
										<option value="RO">RO</option>
										<option value="RR">RR</option>
										<option value="SC">SC</option>
										<option value="SP">SP</option>
										<option value="SE">SE</option>
										<option value="TO">TO</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="<?= base_url('motorista'); ?>" class="btn btn-danger btn-simple">
									Voltar
								</a>
							</div>
							<div class="col-md-6">
								<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" ng-disabled="!nome || !email || !cpf || !tipo_carteira || !validade_carteira || !cep">
									Cadastrar
								</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#cpf').mask('000.000.000-00');
		$('#cep').mask('00000-000');
		$('#validade_carteira').mask('00/00/0000');
	});

	$('#cep').blur(function() {
		$.ajax({
			url: '<?= base_url() ?>home/cep',
			type: 'POST',
			data: 'cep='+$('#cep').val(),
			dataType: 'json',
			success: function(data) {
				if(data.sucesso == 1) {
					$('#logradouro').val(data.rua);
					$('#bairro').val(data.bairro);
					$('#cidade').val(data.cidade);
					$("#uf option:contains("+data.uf+")").attr('selected', true);
					$('#numero').focus();
				}

				$('#label-endereco').removeClass('is-empty');
				$('#label-bairro').removeClass('is-empty');
				$('#label-cidade').removeClass('is-empty');
				$('#label-uf').removeClass('is-empty');
			}
		});

		return false;
	});

	$('.email').blur(function(){
		var email = $('.email').val();
		$.ajax({
			url: '<?= base_url() ?>motorista/verificar_email',
			type: 'POST',
			data: 'email='+email,
			dataType: 'json',
			success: function(data) {
				if(data == false) {
					demo.showNotification('bottom', 'right', 'E-mail já cadastrado, por favor tente outro.');
					$('.email').val("");
					$('.email').focus();
				}
			}
		});

		return true;
	});
</script>