<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div id="row-destinatario" class="col-md-12" style="transition: 0.5s;">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Destinatário</h4>
						<p class="category">Editar — <?= $destinatario[0]->razao_social; ?></p>
					</div>
					<div class="card-content">
						<form action="<?= base_url() ?>destinatario/editar" method="post">
							<div class="row">
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>CPF</label>
										<input type="hidden" name="tipo_pessoa" value="f">
										<input type="hidden" name="codigo" value="<?= $destinatario[0]->codigo; ?>">
										<input type="hidden" name="cnpj_cpf" value="<?= $destinatario[0]->cnpj_cpf; ?>">
										<input type="text" id="cnpj_cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->cnpj_cpf; ?>" disabled>
									</div>
								</div>
								<div class="col-md-6 lm15">
									<div class="form-group label-floating">
										<label>Nome</label>
										<input type="text" name="razao_social" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç./\s]+$" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->razao_social; ?>" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>CEP</label>
										<input type="text" name="cep" id="cep" autocomplete="off" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->cep; ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Endereço</label>
										<input type="text" name="logradouro" id="logradouro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="endereco" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->logradouro; ?>" required>
									</div>
								</div>
								<div class="col-md-1 lm15">
									<div class="form-group label-floating">
										<label>Compl.</label>
										<input type="text" name="complemento" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" id="complemento" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->complemento; ?>">
									</div>
								</div>
								<div class="col-md-1 lm15">
									<div class="form-group label-floating">
										<label>Número</label>
										<input type="text" name="numero" pattern="[0-9]+$" id="numero" autocomplete="off" class="form-control lm10" value="<?= $destinatario[0]->numero; ?>" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Bairro</label>
										<input type="text" name="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="bairro" autocomplete="off" class="form-control lm10" value="<?= $destinatario[0]->bairro; ?>" required>
									</div>
								</div>
								<div class="col-md-3 lm15">
									<div class="form-group label-floating">
										<label>Cidade</label>
										<input type="text" name="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="cidade" class="form-control lm10" autocomplete="off" value="<?= $destinatario[0]->cidade; ?>" required>
									</div>
								</div>
								<div class="col-md-1 lm15">
								<div class="form-group label-floating">
									<label>UF</label>
									<select class="form-control lm10" name="uf" id="uf">
										<option value="" class="option_none" disabled selected></option>
										<option value="AC" <?= ($destinatario[0]->uf == 'AC')? 'selected':''; ?>>AC</option>
										<option value="AL" <?= ($destinatario[0]->uf == 'AL')? 'selected':''; ?>>AL</option>
										<option value="AP" <?= ($destinatario[0]->uf == 'AP')? 'selected':''; ?>>AP</option>
										<option value="AM" <?= ($destinatario[0]->uf == 'AM')? 'selected':''; ?>>AM</option>
										<option value="BA" <?= ($destinatario[0]->uf == 'BA')? 'selected':''; ?>>BA</option>
										<option value="CE" <?= ($destinatario[0]->uf == 'CE')? 'selected':''; ?>>CE</option>
										<option value="DF" <?= ($destinatario[0]->uf == 'DF')? 'selected':''; ?>>DF</option>
										<option value="ES" <?= ($destinatario[0]->uf == 'ES')? 'selected':''; ?>>ES</option>
										<option value="GO" <?= ($destinatario[0]->uf == 'GO')? 'selected':''; ?>>GO</option>
										<option value="MA" <?= ($destinatario[0]->uf == 'MA')? 'selected':''; ?>>MA</option>
										<option value="MT" <?= ($destinatario[0]->uf == 'MT')? 'selected':''; ?>>MT</option>
										<option value="MS" <?= ($destinatario[0]->uf == 'MS')? 'selected':''; ?>>MS</option>
										<option value="MG" <?= ($destinatario[0]->uf == 'MG')? 'selected':''; ?>>MG</option>
										<option value="PA" <?= ($destinatario[0]->uf == 'PA')? 'selected':''; ?>>PA</option>
										<option value="PB" <?= ($destinatario[0]->uf == 'PB')? 'selected':''; ?>>PB</option>
										<option value="PR" <?= ($destinatario[0]->uf == 'PR')? 'selected':''; ?>>PR</option>
										<option value="PE" <?= ($destinatario[0]->uf == 'PE')? 'selected':''; ?>>PE</option>
										<option value="PI" <?= ($destinatario[0]->uf == 'PI')? 'selected':''; ?>>PI</option>
										<option value="RJ" <?= ($destinatario[0]->uf == 'RJ')? 'selected':''; ?>>RJ</option>
										<option value="RN" <?= ($destinatario[0]->uf == 'RN')? 'selected':''; ?>>RN</option>
										<option value="RS" <?= ($destinatario[0]->uf == 'RS')? 'selected':''; ?>>RS</option>
										<option value="RO" <?= ($destinatario[0]->uf == 'RO')? 'selected':''; ?>>RO</option>
										<option value="RR" <?= ($destinatario[0]->uf == 'RR')? 'selected':''; ?>>RR</option>
										<option value="SC" <?= ($destinatario[0]->uf == 'SC')? 'selected':''; ?>>SC</option>
										<option value="SP" <?= ($destinatario[0]->uf == 'SP')? 'selected':''; ?>>SP</option>
										<option value="SE" <?= ($destinatario[0]->uf == 'SE')? 'selected':''; ?>>SE</option>
										<option value="TO" <?= ($destinatario[0]->uf == 'TO')? 'selected':''; ?>>TO</option>
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
									<button class="btn btn-danger pull-right" name="editar" type="submit">
										Salvar
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
			}
		});

		return false;
	});
</script>