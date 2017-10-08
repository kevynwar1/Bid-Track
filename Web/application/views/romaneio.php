<link href="<?= base_url(); ?>assets/css/pop-up.css" rel="stylesheet" />
<script src="<?= base_url(); ?>assets/js/konami.min.js"></script>
<script>
$(document).on('keyup', Konami.code(function() {
	$('#konami').css('display', 'block');
}));

function exclusao(romaneio, motorista) {
	$('.cd-popup').addClass('is-visible');
	$('.btn-confirm-yes').on('click', function(event){
		event.preventDefault();
		window.location.replace("<?= base_url() ?>romaneio/excluir/"+romaneio+"/"+motorista);
		return true;
	});
	$('.btn-confirm-no').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').removeClass('is-visible');
		return false;
	});
	$('.cd-popup').on('click', function(event){
		if($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup')) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	return false;
}
</script>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> excluir este Romaneio ?</p>
		<ul class="cd-buttons">
			<li><a href="#" class="btn-confirm-yes">Sim</a></li>
			<li><a href="#" class="btn-confirm-no">Não</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div id="konami" align="center" style="display: none;"><img src="<?= base_url(); ?>assets/img/others/unnamed.jpg"></div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-text" data-background-color="blue-left">
						<h4 class="card-title" style="font-size: 18px">Listagem</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover" id="tables">
							<thead class="text-primary">
								<th class="th-desc">
									Romaneio
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Estabelecimento
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Transportador
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Motorista
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Data Criação
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th></th>
								<th></th>
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
											$transportadora  = $romaneio->transportadora->nome_fantasia;
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
										<a href="<?= base_url().'home/mapa?endereco='.str_replace(" ", "+", $logradouro).','.$numero ?>" rel="tooltip" title="<?= $logradouro ?>, <?= $numero ?> — <?= $bairro ?>, <?= $cidade ?>" data-placement="right">
											<?= $razao_social; ?> — <?= $bairro; ?>
										</a>
									</td>
									<td><?= (is_null($transportadora)) ? $romaneio->estabelecimento->razao_social : $transportadora; ?></td>
									<td>
										<?= (is_null($motorista[0])) ? "<span class='gray'>Indefinido</span>" : $motorista; ?>
									</td>
									<td>
										<?= $data_format[2]."/".$data_format[1]; ?>
										<span class="f11 upper">
											<?= (date("Y-m-d") == $data_criacao)? 'Hoje' : diasemana($data_criacao, 'curto') ?>
										</span>
									</td>
									<td>
										<?php
											$color = NULL;
											if($cod_status == 1) { // Liberado
												$color = "success";
											} else if($cod_status == 2) { // Pendente
												$color = "danger";
											} else if($cod_status == 3) { // Em Processo
												$color = "warning";
											} else if($cod_status == 5) { // Aceito
												$color = "primary";
											}
										?>
										<span class="btn-<?= $color ?> btn-xs status">
											<?= $status_romaneio; ?>
										</span>
									</td>
									<td>
										<a href="<?= base_url().'romaneio/visualizar/'.$codigo ?>">
											<button type="button" rel="tooltip" data-placement="left" title="Visualizar" class="btn-pattern">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</a>
										<?php if($cod_status != 3): ?>
											<?php if($this->session->userdata('perfil') == 'A'): ?>
												<a href="<?= base_url().'romaneio/editar/'.$codigo ?>">
													<button type="button" rel="tooltip" data-placement="left" title="Editar" class="btn-pattern">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												<a href="<?= base_url().'romaneio/excluir/'.$codigo.'/'.$cod_motorista ?>">
													<button type="button" rel="tooltip" data-placement="left" title="Excluir" class="btn-pattern" onclick="return exclusao('<?= $codigo ?>', '<?= $cod_motorista ?>')">
														<i class="fa fa-times"></i>
													</button>
												</a>
											<?php endif; ?>
										<?php endif; ?>
									</td>
								</tr>
								<?php 
										endforeach;
									} else {
	                            ?>
	                                <tr align="center">
	                                    <td colspan="7" class="desc f10 upper" style="font-size: 12px">Nenhum Romaneio encontrado :(</td>
	                                </tr>
	                            <?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2">
										<span class="desc f12">
											<?php
												if($this->uri->segment(2) == 's') {
													echo count($romaneios).' Romaneio(s) — '.$this->input->get('filtro').': '.$this->input->get('procurar');
												} else {
													echo $total.' Romaneio(s) totais';
												}
											?>
										</span>
									</td>
									<td colspan="3" align="left">
										<?= ($this->uri->segment(2) == 's') ? "<small class='desc'><a href='".base_url()."romaneio'>voltar</a></small> " : $pagination; ?>
									</td>
									<td colspan="2" align="right">
										<?php if($this->session->userdata('perfil') == 'A'): ?>
											<a href="<?= base_url().'romaneio/add' ?>">
												<button type="submit" class="btn btn-danger btn-simple btn-fill pull-right f12 upper">Adicionar</button>
											</a>
										<?php endif; ?>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>