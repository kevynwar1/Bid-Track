<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div id="row-transportadora" class="col-md-8" style="transition: 0.5s;">
				<div class="card">
                    <?php if($romaneios != FALSE): ?>
                    <div class="card-header card-header-tabs" data-background-color="blue-left">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs" style="background: none">
                                    <li class="active">
                                        <a data-toggle="tab" id="tab_transportadora" href="#profile" aria-expanded="true">
                                            <i class="material-icons">local_shipping</i> Transportadora
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" id="tab_romaneios" href="#romaneios" aria-expanded="true">
                                            <i class="material-icons">assignment</i> Romaneio
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                	<?php else: ?>
                    <div class="card-header" data-background-color="blue-left">
						<h4 class="title">Transportadora</h4>
						<p class="category">Editar a <?= $transportadora->razao_social; ?></p>
					</div>
					<?php endif; ?>

                    <div class="card-content">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                        		<div class="row">
                        			<div class="col-md-12">
                        				<form action="<?= base_url() ?>transportadora/editar" method="post">
                        					<input type="hidden" name="codigo" value="<?= $transportadora->codigo; ?>">
											<div class="row">
												<div class="col-md-3 lm10">
													<div class="form-group label-floating">
														<label class="control-label">CNPJ</label>
														<input type="text" name="cnpj" id="cnpj" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" class="form-control" autocomplete="off" value="<?= $transportadora->cnpj; ?>" disabled required>
													</div>
												</div>
												<div class="col-md-6 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Razão Social</label>
														<input type="text" name="razao_social" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.,/\s]+$" id="empresa-input" class="form-control" autocomplete="off" value="<?= $transportadora->razao_social; ?>" required>
													</div>
												</div>
												<div class="col-md-2 lm10">
													<div class="form-group label-floating">
														<label class="control-label">CEP</label>
														<input type="text" name="cep" id="cep" autocomplete="off" class="form-control" autocomplete="off" value="<?= $transportadora->cep; ?>" required>
													</div>
												</div>
												<div class="col-md-1 lm10">
													<div class="form-group label-floating">
														<label class="control-label">UF</label>
														<input type="text" name="uf" pattern="[a-zA-Z\s]+$" maxlength="2" id="uf" class="form-control upper" value="<?= $transportadora->uf; ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Endereço</label>
														<input type="text" name="logradouro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.\s]+$" id="endereco" class="form-control" autocomplete="off" value="<?= $transportadora->logradouro; ?>" required>
													</div>
												</div>
												<div class="col-md-2 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Compl.</label>
														<input type="text" name="complemento" pattern="[a-zA-Z\s]+$" id="complemento" class="form-control" autocomplete="off" value="<?= $transportadora->complemento; ?>">
													</div>
												</div>
												<div class="col-md-1 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Número</label>
														<input type="text" name="numero" pattern="[0-9]+$" id="numero" autocomplete="off" class="form-control" value="<?= $transportadora->numero; ?>" required>
													</div>
												</div>
												<div class="col-md-3 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Bairro</label>
														<input type="text" name="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="bairro" autocomplete="off" class="form-control" value="<?= $transportadora->bairro; ?>" required>
													</div>
												</div>
												<div class="col-md-3 lm10">
													<div class="form-group label-floating">
														<label class="control-label">Cidade</label>
														<input type="text" name="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" id="cidade" class="form-control" autocomplete="off" value="<?= $transportadora->cidade ?>" required>
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
													<button name="editar" class="btn btn-danger pull-right" type="submit">
														Salvar
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<?php if($romaneios != FALSE): ?>
							<div class="tab-pane" id="romaneios">
								<div class="row">
									<div class="col-md-12">
										<table id="table-romaneio" class="table table-hover">
											<thead class="text-primary">
												<th>Romaneio</th>
												<th>Estabelecimento</th>
												<th>Transportadora</th>
												<th>Motorista</th>
												<th>Data Criação</th>
												<th colspan="2"></th>
											</thead>
											<tbody>
												<?php
													if($romaneios != false) {
														foreach($romaneios as $romaneio):
															$codigo 		 = $romaneio->codigo;
															$razao_social 	 = $romaneio->estabelecimento->razao_social;
															$logradouro 	 = $romaneio->estabelecimento->logradouro;
															$numero 		 = $romaneio->estabelecimento->numero;
															$bairro 		 = $romaneio->estabelecimento->bairro;
															$cidade 		 = $romaneio->estabelecimento->cidade;
															$trans  		 = $romaneio->transportadora->nome_fantasia;
															$trans_bairro  	 = $romaneio->transportadora->bairro;
															$cod_motorista   = $romaneio->motorista->codigo;
															$motorista  	 = $romaneio->motorista->nome;
															$data_criacao	 = $romaneio->data_criacao;
															$cod_status		 = $romaneio->status_romaneio->codigo;
															$status_romaneio = $romaneio->status_romaneio->descricao;
															$data_format	 = explode("-", $romaneio->data_criacao);
												?>
												<tr>
													<td align="center"><?= $romaneio->codigo; ?></td>
													<td>
														<a href="<?= base_url().'home/mapa?endereco='.str_replace(" ", "+", $logradouro).','.$numero.'-'.str_replace(" ", "+", $bairro); ?>" rel="tooltip" title="<?= $logradouro ?>, <?= $numero ?> — <?= $bairro ?>, <?= $cidade ?>" data-placement="right">
															<?= $razao_social; ?>, <?= $bairro; ?> — <?= $cidade; ?>
														</a>
													</td>
													<td><?= $trans; ?> — <?= $trans_bairro; ?></td>
													<td>
														<?= (is_null($motorista[0])) ? "<span class='gray'>Indefinido</span>" : $motorista; ?>
													</td>
													<td>
														<?= $data_format[2]."/".$data_format[1]; ?>
														<span class="f11 upper">
															<?= (date("Y-m-d") == $data_criacao)? 'Hoje' : diasemana($data_criacao, 'extenso') ?>
														</span>
													</td>
													<td>
														<?php
															$color = NULL;
															if($cod_status == 5) { // Aceito
																$color = "success";
															} else if($cod_status == 2) { // Pendente
																$color = "danger";
															} else if($cod_status == 3 || $cod_status == 6) { // Em Processo ou Ofertado
																$color = "warning";
															} else if($cod_status == 1) { // Liberado
																$color = "primary";
															}
														?>
														<span class="btn-<?= $color ?> btn-xs status">
															<?= $status_romaneio; ?>
														</span>
													</td>
													<td align="left">
														<a href="<?= base_url().'romaneio/visualizar/'.$codigo ?>">
															<button type="button" rel="tooltip" data-placement="left" title="Visualizar" class="btn-pattern">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</button>
														</a>
													</td>
												</tr>
												<?php 
														endforeach;
													} else {
												?>
													<tr align="center">
														<td colspan="6" class="desc f10 upper" style="font-size: 12px">Não há nenhum Romaneio, para <?= $transportadora->razao_social; ?>.</td>
													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2">
														<span class="desc f12">
															<?php
																if($romaneios != FALSE) {
																	echo count($romaneios).' Romaneio(s) totais';
																}
															?>
														</span>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			</div>
			<div id="row-transportadora-info" class="col-md-4">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Informações</h4>
						<p class="category">Detalhamento da <?= str_replace("Trans.", "", str_replace("Transportadora", "", $transportadora->razao_social)); ?></p>
					</div>
					<div class="card-content">
						<div class="row" id="transportadora-info">
							<div class="col-md-12" align="center">
								<div class="image"></div>
								<div class="content">
									<h4><?= $transportadora->razao_social; ?></h4>
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

<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			url: '<?= base_url() ?>empresa/cnpj',
			type: 'POST',
			data: 'cnpj='+$('#cnpj').val(),
			dataType: 'json',
			success: function(data) {
				$('.image').html("<a href='<?= base_url() ?>home/mapa?endereco="+data.mapa+"' target='_blank'><img src='https://maps.googleapis.com/maps/api/staticmap?center="+data.mapa+"&zoom=18&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDQjgSKcQEHV6GY-_TL3vxbEwZ6rYG7LVA&format=png&visual_refresh=true&markers=icon:http://i.imgur.com/jRfjvrz.png%7Cshadow:true%7C"+data.mapa+"' style='border-radius:3.5px' alt='"+data.endereco+"' title='"+data.endereco+"'></a>");
				$('#empresa-title').text(data.nome);
				$('#tipo').text(data.tipo);
				$('#situacao').text(data.situacao);
				$('#atividade').text(data.atividade);
				$('#abertura').text(data.abertura);
			}
		});
	});

	$("#tab_transportadora").click(function() {
		$('#row-transportadora').removeClass('col-md-12').addClass('col-md-8');
		window.setTimeout(function(){
			$('#row-transportadora-info').fadeIn('low');
		}, 500);
	});

	$("#tab_romaneios").click(function() {
		$('#row-transportadora-info').fadeOut('low');
		window.setTimeout(function(){
			$('#row-transportadora').removeClass('col-md-8').addClass('col-md-12');
		}, 500);
	});
</script>