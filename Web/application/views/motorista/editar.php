<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Motorista</h4>
						<p class="category">Editar — <?= $motorista[0]->nome; ?></p>
					</div>
					<div class="card-content">
						<form action="<?= base_url()."motorista/editar" ?>" method="post">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label">CPF</label>
									<input type="hidden" value="<?= $motorista[0]->cpf; ?>" name="cpf">
									<input type="text" class="form-control" style="text-align: center;" value="<?= $motorista[0]->cpf; ?>" disabled>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group label-floating">
									<label class="control-label">Nome</label>
									<input type="hidden" name="codigo" value="<?= $motorista[0]->codigo; ?>">
									<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.,/\s]+$" class="form-control codigo" name="nome" value="<?= $motorista[0]->nome; ?>" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label">E-mail</label>
									<input type="email" name="email" id="email" value="<?= $motorista[0]->email; ?>" class="form-control" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Tipo Carteira</label>
									<select class="form-control" name="tipo_carteira" id="tipo_carteira">
										<option value="" class="option_none" disabled selected></option>
										<option value="B" <?= ($motorista[0]->tipo_carteira == 'B')? 'selected' : ''; ?>>B</option>
										<option value="C" <?= ($motorista[0]->tipo_carteira == 'C')? 'selected' : ''; ?>>C</option>
										<option value="D" <?= ($motorista[0]->tipo_carteira == 'D')? 'selected' : ''; ?>>D</option>
										<option value="E" <?= ($motorista[0]->tipo_carteira == 'E')? 'selected' : ''; ?>>E</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Validade Carteira</label>
									<?php
										$val = explode('-', $motorista[0]->validade_carteira);
										$val = $val[2].'/'.$val[1].'/'.$val[0];
									?>
									<input type="text" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" maxlength="10" name="validade_carteira" id="validade_carteira" autocomplete="off" value="<?= $val; ?>" required>
								</div>
							</div>
							<div class="col-md-2 lm10">
								<div class="form-group label-floating">
									<label class="control-label">CEP</label>
									<input type="text" name="cep" id="cep" autocomplete="off" class="form-control" autocomplete="off" pattern="\d{5}-\d{3}" value="<?= $motorista[0]->cep; ?>" required>
								</div>
							</div>
							<div class="col-md-5 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Endereço</label>
									<input type="text" name="logradouro" id="logradouro" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç,.-/\s]+$" value="<?= $motorista[0]->logradouro; ?>" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row" id="endereco_usuario">
							<div class="col-md-2 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Número</label>
									<input type="text" name="numero" id="numero" class="form-control" pattern="[0-9]+$" autocomplete="off" value="<?= $motorista[0]->numero; ?>">
								</div>
							</div>
							<div class="col-md-3 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Compl.</label>
									<input type="text" name="complemento" id="complemento" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç0-9./\s]+$" autocomplete="off" value="<?= $motorista[0]->complemento; ?>">
								</div>
							</div>
							<div class="col-md-3 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Bairro</label>
									<input type="text" name="bairro" id="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" class="form-control" autocomplete="off" value="<?= $motorista[0]->bairro; ?>">
								</div>
							</div>
							<div class="col-md-3 lm10">
								<div class="form-group label-floating">
									<label class="control-label">Cidade</label>
									<input type="text" name="cidade" id="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" class="form-control" autocomplete="off" value="<?= $motorista[0]->cidade; ?>">
								</div>
							</div>
							<div class="col-md-1 lm10">
								<div class="form-group label-floating">
									<label class="control-label">UF</label>
									<select class="form-control" name="uf" id="uf">
										<option value="" class="option_none" disabled selected></option>
										<option value="AC" <?= ($motorista[0]->uf == 'AC')? 'selected':''; ?>>AC</option>
										<option value="AL" <?= ($motorista[0]->uf == 'AL')? 'selected':''; ?>>AL</option>
										<option value="AP" <?= ($motorista[0]->uf == 'AP')? 'selected':''; ?>>AP</option>
										<option value="AM" <?= ($motorista[0]->uf == 'AM')? 'selected':''; ?>>AM</option>
										<option value="BA" <?= ($motorista[0]->uf == 'BA')? 'selected':''; ?>>BA</option>
										<option value="CE" <?= ($motorista[0]->uf == 'CE')? 'selected':''; ?>>CE</option>
										<option value="DF" <?= ($motorista[0]->uf == 'DF')? 'selected':''; ?>>DF</option>
										<option value="ES" <?= ($motorista[0]->uf == 'ES')? 'selected':''; ?>>ES</option>
										<option value="GO" <?= ($motorista[0]->uf == 'GO')? 'selected':''; ?>>GO</option>
										<option value="MA" <?= ($motorista[0]->uf == 'MA')? 'selected':''; ?>>MA</option>
										<option value="MT" <?= ($motorista[0]->uf == 'MT')? 'selected':''; ?>>MT</option>
										<option value="MS" <?= ($motorista[0]->uf == 'MS')? 'selected':''; ?>>MS</option>
										<option value="MG" <?= ($motorista[0]->uf == 'MG')? 'selected':''; ?>>MG</option>
										<option value="PA" <?= ($motorista[0]->uf == 'PA')? 'selected':''; ?>>PA</option>
										<option value="PB" <?= ($motorista[0]->uf == 'PB')? 'selected':''; ?>>PB</option>
										<option value="PR" <?= ($motorista[0]->uf == 'PR')? 'selected':''; ?>>PR</option>
										<option value="PE" <?= ($motorista[0]->uf == 'PE')? 'selected':''; ?>>PE</option>
										<option value="PI" <?= ($motorista[0]->uf == 'PI')? 'selected':''; ?>>PI</option>
										<option value="RJ" <?= ($motorista[0]->uf == 'RJ')? 'selected':''; ?>>RJ</option>
										<option value="RN" <?= ($motorista[0]->uf == 'RN')? 'selected':''; ?>>RN</option>
										<option value="RS" <?= ($motorista[0]->uf == 'RS')? 'selected':''; ?>>RS</option>
										<option value="RO" <?= ($motorista[0]->uf == 'RO')? 'selected':''; ?>>RO</option>
										<option value="RR" <?= ($motorista[0]->uf == 'RR')? 'selected':''; ?>>RR</option>
										<option value="SC" <?= ($motorista[0]->uf == 'SC')? 'selected':''; ?>>SC</option>
										<option value="SP" <?= ($motorista[0]->uf == 'SP')? 'selected':''; ?>>SP</option>
										<option value="SE" <?= ($motorista[0]->uf == 'SE')? 'selected':''; ?>>SE</option>
										<option value="TO" <?= ($motorista[0]->uf == 'TO')? 'selected':''; ?>>TO</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="javascript:window.history.go(-1)" class="btn btn-danger btn-simple">
									Voltar
								</a>
							</div>
							<div class="col-md-6">
								<button type="submit" name="editar" class="btn btn-danger btn-fill pull-right f12 upper">
									Salvar
								</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="image">
						<a href="<?= base_url().'home/mapa?endereco='.str_replace(" ", "+", acentuacao($motorista[0]->logradouro)).','.$motorista[0]->numero.'-'.str_replace(" ", "+", acentuacao($motorista[0]->bairro)); ?>">
							<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=<?= str_replace(" ", "+", acentuacao($motorista[0]->logradouro).' '.$motorista[0]->bairro); ?>&zoom=19&scale=1&size=600x300&maptype=roadmap&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU&format=png&visual_refresh=true&markers=color:0xff0000%7Clabel:A%7C<?= str_replace(" ", "+", acentuacao($motorista[0]->logradouro).' '.$motorista[0]->bairro); ?>" style="height: 150px; border-radius: 4px 4px 0 0;">
						</a>
					</div>
					<div class="card-content" style="padding: 25px 0 25px 0;">
						<div class="author" align="center">
							<?php $nome = explode(" ", $motorista[0]->nome); ?>
							<h4 class="title">
								<span style="font-size: 22px;"><?= $nome[0]." ".end($nome); ?></span><br>
								<small><?= $motorista[0]->email; ?></small>
							</h4>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<table class="table table-hover table-striped">
									<thead>
										<th>Romaneio</th>
										<th></th>
										<th></th>
									</thead>
									<tbody>
										<?php
											if($romaneio != FALSE):
												foreach($romaneio as $row):
										?>
										<tr>
											<td><?= $row->codigo; ?></td>
											<td>
												<?php
												$color = NULL;
												if($row->status_romaneio->codigo == 5) { // Aceito
													$color = "success";
												} else if($row->status_romaneio->codigo == 2 || $row->status_romaneio->codigo == 4) { // Pendente e Finalizado
													$color = "danger";
												} else if($row->status_romaneio->codigo == 3 || $row->status_romaneio->codigo == 6) { // Em Processo ou Ofertado
													$color = "warning";
												} else if($row->status_romaneio->codigo == 1) { // Liberado
													$color = "primary";
												}
												?>
												<span class="btn-<?= $color ?> btn-xs status">
													<?= $row->status_romaneio->descricao; ?>
												</span>
											</td>
											<td>
												<?php if($row->status_romaneio->codigo != 4): ?>
												<a href="<?= base_url().'romaneio/visualizar/'.$row->codigo ?>">
													<button type="button" rel="tooltip" data-placement="left" title="Visualizar" class="btn-pattern">
														<i class="fa fa-eye" aria-hidden="true"></i>
													</button>
												</a>
												<a href="<?= base_url().'romaneio/editar/'.$row->codigo ?>">
													<button type="button" rel="tooltip" data-placement="left" title="Editar" class="btn-pattern">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												<?php endif; ?>
											</td>
										</tr>
										<?php
												endforeach;
											else:
										?>
											<tr>
												<td colspan="3" class="desc f10 upper" align="center" style="font-size: 12px">
													<?= $nome[0] ?> não tem romaneio
												</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
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
			}
		});

		return false;
	});
</script>