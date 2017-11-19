<style type="text/css">
	.lm10 { margin-top: -10px; }
</style>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div id="row-destinatario" class="col-md-12" style="transition: 0.5s;">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Destinatário</h4>
						<p class="category">Cadastre o <span id="empresa-title">Destinatário</span></p>
					</div>
					<div class="card-content">
						<form action="<?= base_url('destinatario/cadastrar'); ?>" method="post">
							<div class="row">
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>CPF</label>
										<input type="hidden" name="tipo_pessoa" value="f">
										<input type="text" name="cnpj_cpf" id="cnpj_cpf" ng-model="cnpj_cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" class="form-control lm10" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6 lm15">
									<div class="form-group label-floating">
										<label>Nome</label>
										<input type="text" name="razao_social" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç./\s]+$" class="form-control lm10" autocomplete="off" ng-model="nome" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>CEP</label>
										<input type="text" name="cep" id="cep" autocomplete="off" class="form-control lm10" autocomplete="off" ng-model="cep" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Endereço</label>
										<input type="text" name="logradouro" id="logradouro" id="endereco" class="form-control lm10" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-1 lm15">
									<div class="form-group label-floating">
										<label>Compl.</label>
										<input type="text" name="complemento" id="complemento" class="form-control lm10" autocomplete="off">
									</div>
								</div>
								<div class="col-md-1 lm15">
									<div class="form-group label-floating">
										<label>Número</label>
										<input type="text" name="numero" pattern="[0-9]+$" id="numero" autocomplete="off" class="form-control lm10" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Bairro</label>
										<input type="text" name="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="bairro" autocomplete="off" class="form-control lm10" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Cidade</label>
										<input type="text" name="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="cidade" class="form-control lm10" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-1 lm15">
								<div class="form-group label-floating">
									<label>UF</label>
									<select class="form-control lm10" name="uf" id="uf">
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
									<a href="<?= base_url('destinatario'); ?>" class="btn btn-danger btn-simple">
										Voltar
									</a>
								</div>
								<div class="col-md-6">
									<button class="btn btn-danger pull-right" ng-disabled="!cnpj_cpf || !nome || !cep" type="submit">
										Cadastrar
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="row-destinatario-info" class="col-md-4" style="display: none;">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Informações</h4>
						<p class="category">Detalhamento do Estabelecimento</p>
					</div>
					<div class="card-content">
						<div class="row" id="transportadora-info">
							<div class="col-md-12" align="center">
								<div class="image"></div>
								<div class="content">
									<h4 id="empresa"></h4>
									<p id="atividade" class="description text-center"></p>
									<table class="table table-hover">
										<tr>
											<td>Abertura</td>
											<td id="abertura"></td>
										</tr>
										<tr>
											<td>Tipo da Empresa</td>
											<td id="tipo"></td>
										</tr>
										<tr>
											<td>Situação</td>
											<td id="situacao"></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#cnpj_cpf').mask('000.000.000-00');
		$('#cep').mask('00000-000');
		$('#telefone').mask('00 0000-0000');
		$('#cnpj_cpf').focus();
	});

	function escapeRegExp(str) {
		var cpf = str.replace(/[.*+?^${}()|[\]\\]/g, "");
		return cpf.replace("-", "");
	}

	$('#cnpj_cpf').blur(function() {
		$.ajax({
			url: '<?= base_url('home/cpf'); ?>',
			type: 'POST',
			data: 'cpf='+$('#cnpj_cpf').val(),
			dataType: 'json',
			success: function(data) {
				if(data.sucesso == 0) {
					demo.showNotification('bottom', 'right', 'CPF inválido, tente novamente.');
					$('#cnpj_cpf').val("");
					$('#cnpj_cpf').focus();
				}
			}
		});

		return false;
	});

	$('#cep').blur(function() {
		$.ajax({
			url: '<?= base_url('home/cep'); ?>',
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
			}
		});

		return false;
	});
</script>