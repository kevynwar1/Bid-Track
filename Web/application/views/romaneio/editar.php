<?php
	if(!empty($entrega)) {
		$peso_ent = 0;
		foreach($entrega as $row) {
			$peso_ent += $row->peso_carga;
		}
	}
?>
<style type="text/css">
	.seq { color: #999; }
	.seq-icon { color: #FFF; transition: 0.3s; }
	.panel-group .panel .panel-heading { cursor: grab; }
	.panel-group .panel .panel-heading h2 { cursor: grab; }
	.panel-group .panel .panel-heading:hover .seq-icon { color: #999; }
	#ocorrencias img {
		width: 147px !important;
		transition: 0.3s;
		border: 4px solid #FFF;
		box-shadow: 0 10px 10px rgba(0,0,0, 0.2);
		margin: 3px;
		/*-webkit-transform:rotate(90deg);
		-moz-transform:rotate(90deg);
		-o-transform: rotate(90deg);*/
	}

	#ocorrencias img:hover {
		-o-transform: scale(1.07, 1.07);
		-ms-transform: scale(1.07, 1.07);
		-moz-transform: scale(1.07, 1.07);
		-webkit-transform: scale(1.07, 1.07);
		transform: scale(1.07, 1.07);
		box-shadow: 0 5px 10px rgba(0,0,0, 0.5);
	}
</style>
<link href="<?= base_url(); ?>assets/css/pop-up.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
	$("#sortable").sortable({
		create: function(event, ui){ $("#order").val($(this).sortable('serialize')); },
		stop: function(event, ui){ $("#order").val($(this).sortable('serialize')); }
	});
	$("#sortable").disableSelection();
});

function exclusao(entrega, romaneio) {
	$('.cd-popup').addClass('is-visible');
	$('.btn-confirm-yes').on('click', function(event){
		event.preventDefault();
		window.location.replace("<?= base_url() ?>entrega/excluir/"+entrega+"/"+romaneio);
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

function ofertar(romaneio) {
	$('.ofertar').addClass('is-visible');
	$('.btn-confirm-yes').on('click', function(event){
		event.preventDefault();
		window.location.replace("<?= base_url() ?>romaneio/ofertar/"+romaneio);
		return true;
	});
	$('.btn-confirm-no').on('click', function(event){
		event.preventDefault();
		$('.ofertar').removeClass('is-visible');
		return false;
	});
	$('.ofertar').on('click', function(event){
		if($(event.target).is('.cd-popup-close') || $(event.target).is('.ofertar')) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	return false;
}
</script>

<div class="cd-popup excluir" role="alert">
	<div class="cd-popup-container">
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> excluir esta Entrega ?</p>
		<ul class="cd-buttons">
			<li><a href="#" class="btn-confirm-yes">Sim</a></li>
			<li><a href="#" class="btn-confirm-no">Não</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>

<div class="cd-popup ofertar" role="alert">
	<div class="cd-popup-container">
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> ofertar este Romaneio ?</p>
		<ul class="cd-buttons">
			<li><a href="#" class="btn-confirm-yes">Sim</a></li>
			<li><a href="#" class="btn-confirm-no">Não</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>

<div class="content" style="width: 55%; float: left">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
                    <div class="card-header card-header-tabs" data-background-color="blue-center">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs" style="background: none">
                                    <li class="<?= (!is_null($this->session->flashdata('entrega')))? '' : 'active' ?>">
                                        <a data-toggle="tab" href="#profile" aria-expanded="true">
                                            <i class="material-icons">local_shipping</i> Romaneio
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="<?= (!is_null($this->session->flashdata('entrega')))? 'active' : '' ?>">
                                        <a data-toggle="tab" href="#entregas" aria-expanded="true">
                                            <i class="material-icons">content_paste</i> Entregas
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
									<?php if($ocorrencia != FALSE): ?>
									<li>
										<a data-toggle="tab" href="#ocorrencias" aria-expanded="true">
											<i class="material-icons">info_outline</i> Ocorrências
											<div class="ripple-container"></div>
										</a>
									</li>
									<?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-content card-content-ocorrencia">
                        <div class="tab-content">
                            <div class="tab-pane <?= (!is_null($this->session->flashdata('entrega')))? '' : 'active' ?>" id="profile">
                        		<form action="<?= base_url().'romaneio/editar' ?>" method="post">
                    			<input type="hidden" name="codigo" value="<?= $romaneio[0]->codigo; ?>">
                    			<input type="hidden" name="codigo_motorista" value="<?= $romaneio[0]->motorista->codigo; ?>">
                    			<input type="hidden" name="status_romaneio" value="<?= $romaneio[0]->status_romaneio->codigo ?>">
                            	<div class="row">
									<div class="col-md-2 lm15">
										<div class="form-group label-floating">
											<label class="control-label">Romaneio</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->codigo; ?>" autocomplete="off" style="text-align: center;" disabled>
										</div>
									</div>
									<div class="col-md-7 lm15">
										<div class="form-group label-floating">
											<label class="control-label">Estabelecimento</label>
											<select class="form-control estabelecimento" name="estabelecimento" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
												<?php foreach($estabelecimento as $row): ?>
													<option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>" <?= ($row->codigo == $romaneio[0]->estabelecimento->codigo) ? 'selected' : '' ?>>
														<?= $row->razao_social." — ".$row->bairro; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-3 lm15">
										<div class="form-group label-floating">
											<label class="control-label">Preço</label>
											<input type="text" id="valor" class="form-control" name="valor" autocomplete="off" value="<?= $romaneio[0]->valor ?>" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 lm15">
										<div class="form-group">
											<label>Transportadora</label>
											<select class="form-control transportadora" name="transportadora" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
												<option class="option-undefined" value="0" <?= ($romaneio[0]->estabelecimento->codigo == NULL) ? 'selected' : '' ?>>Estabelecimento</option>
												<?php foreach($transportadora as $row): ?>
													<option class="option" value="<?= $row->codigo ?>" <?= ($row->codigo == $romaneio[0]->transportadora->codigo) ? 'selected' : '' ?>>
														<?= $row->nome_fantasia; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-4 lm15">
										<div class="form-group">
											<label>Motorista</label>
											<select class="form-control motorista" name="motorista" <?= ($romaneio[0]->status_romaneio->codigo == 6)? 'disabled' : ''; ?> <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
												<option class="option-undefined undefined" value="0" <?= ($romaneio[0]->motorista->codigo == NULL) ? 'selected' : '' ?>>Indefinido</option>
												<?php if(!is_null($romaneio[0]->motorista->codigo)): ?>
													<optgroup label="Atual">
													<?php
														foreach($motorista as $row):
															$nome = explode(" ", $row->nome);
													?>
														<option class="option" value="<?= $row->codigo ?>" <?= ($row->codigo == $romaneio[0]->motorista->codigo) ? 'selected' : '' ?>>
															<?= $nome[0]." ".end($nome); ?>
														</option>
													<?php endforeach; ?>
													</optgroup>
												<?php endif; ?>
												<optgroup label="Disponíveis">
												<?php
													foreach($motorista_disponivel as $row):
														$nome = explode(" ", $row->nome);
												?>
													<option class="option" value="<?= $row->codigo ?>">
														<?= $nome[0]." ".end($nome); ?>
													</option>
												<?php endforeach; ?>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="col-md-4 lm15">
										<div class="form-group">
											<label>Tipo do Veículo</label>
											<select class="form-control" name="tipoveiculo" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
												<?php foreach($tipoveiculo as $row): ?>
													<option class="option" value="<?= $row->codigo ?>" <?= ($row->codigo == $romaneio[0]->tipo_veiculo->codigo) ? 'selected' : '' ?>>
														<?= $row->descricao; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<a href="<?= base_url().'romaneio/imprimir/'.$romaneio[0]->codigo ?>">
											<span type="submit" class="btn <?= ($romaneio[0]->status_romaneio->codigo == 5)? '':'btn-simple' ?> btn-danger btn-fill pull-left f12 upper">
												Imprimir
											</span>
										</a>
										<?php if($romaneio[0]->status_romaneio->codigo != 5) { ?>
											<button type="submit" name="editar" class="btn btn-danger btn-fill pull-right f12 upper">Salvar</button>
										<?php } else if($romaneio[0]->status_romaneio->codigo == 5) { ?>
											<span class="btn btn-danger btn-simple upper pull-right" style="cursor: default;">
												Só é possível editar a Nota Fiscal da(s) entrega(s).
											</span>
										<?php } ?>
									</div>
								</div>
                            	</form>
                            </div>
                            <div class="tab-pane <?= (!is_null($this->session->flashdata('entrega')))? 'active' : '' ?>" id="entregas">
                            	<form action="<?= base_url().'entrega/editar'; ?>" method="post">
                            	<input type="hidden" name="order" id="order">
                            	<input type="hidden" name="romaneio" value="<?= $this->uri->segment(3); ?>">
                            	<div id="sortable">
									<?php
										$i = 0;
										foreach($entrega as $row):
											$ult_entrega = $row->seq_entrega;
											$i++;
									?>
									<input type="hidden" name="i-<?= $i ?>" value="<?= $i; ?>">
									<input type="hidden" name="seq-entrega-<?= $i; ?>" value="<?= $row->seq_entrega; ?>">

						<?php if($romaneio[0]->status_romaneio->codigo == 5): ?>
							<input type="hidden" name="destinatario-<?= $i; ?>" value="<?= $row->destinatario->codigo ?>">
							<input type="hidden" name="peso_carga-<?= $i; ?>" value="<?= $row->peso_carga; ?>">
						<?php endif; ?>

									<div aria-multiselectable="true" class="panel-group" id="set_<?= $i; ?>" role="tablist"><!-- id="accordion"   invés de   id="set_<?= $i; ?>" -->
										<div class="panel panel-default">
											<div class="panel-heading" id="headingOne" role="tab" >
												<a aria-controls="collapseOne" aria-expanded="true" data-parent="#accordion" data-toggle="collapse" href="#collapse<?= $i; ?>" role="button" class="">
													<h2 class="panel-title">
														<?= $row->destinatario->razao_social; ?> — <?= $row->destinatario->bairro; ?>, <?= $row->destinatario->cidade ?>
														<?php if(count($entrega) >= 2): ?>
														<span class="pull-right">
															<span class="seq">
																<?= $i; ?><!-- ?= $row->seq_entrega; ? -->
															</span>&nbsp;
															<span class="seq-icon">
																<i class="fa fa-arrows-v" aria-hidden="true"></i>
															</span>
														</span>
														<?php endif; ?>
													</h2>
												</a>
											</div>
											<div aria-labelledby="headingOne" class="panel-collapse collapse" id="collapse<?= $i; ?>" role="tabpanel" aria-expanded="true" style="">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-12 lm15">
															<div class="form-group">
																<label>Destinatário <?= $i; ?> <!-- ?= $row->seq_entrega; ? --></label>
																<select class="form-control" name="destinatario-<?= $i; ?>" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
																	<?php foreach($destinatario as $raw): ?>
																		<option class="option" value="<?= $row->destinatario->codigo ?>" <?= ($row->destinatario->codigo == $raw->codigo)? 'selected' : '' ?>><?= $raw->razao_social." — ".$raw->bairro.", ".$raw->cidade; ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="row">
														<?php $peso_carga = explode(" ", $row->peso_carga); ?>
														<div class="col-md-3 lm15">
															<div class="form-group">
																<label>Peso da Carga</label>
																<input type="number" min="1" pattern="[0-9]+$" name="peso_carga-<?= $i; ?>" value="<?= $peso_carga[0]; ?>" class="form-control" autocomplete="off" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
															</div>
														</div>
														<div class="col-md-3 lm15">
															<div class="form-group">
																<label>Medida</label>
																<select class="form-control" name="medida-<?= $i; ?>" <?= ($romaneio[0]->status_romaneio->codigo == 5)? 'disabled':''; ?>>
																	<option class="option" value="kg" selected>Quilograma</option>
																</select>
															</div>
														</div>
														<div class="col-md-3 lm15">
															<div class="form-group">
																<label>Nota Fiscal</label>
																<input type="text" pattern="[0-9]+$" name="nota_fiscal-<?= $i; ?>" value="<?= $row->nota_fiscal; ?>" maxlength="7" class="form-control" autocomplete="off">
															</div>
														</div>
														<div class="col-md-3 lm15">
															<div class="form-group">
																<label>Status</label>
																<input type="text" name="pesocarga" value="<?= $row->status_entrega->descricao; ?>" class="form-control" autocomplete="off" disabled>
															</div>
														</div>
													</div>
													<div class="row">
														<?php if(count($entrega) >= 2): ?>
														<div class="col-md-12">
															<a href="<?= base_url().'entrega/excluir/'.$row->seq_entrega.'/'.$row->romaneio->codigo ?>">
																<button class="btn btn-danger btn-fill btn-simple pull-left f12 upper" onclick="return exclusao('<?= $row->seq_entrega ?>', '<?= $row->romaneio->codigo ?>')">
																	<i class="material-icons">delete</i>
																	Excluir
																</button>
															</a>
														</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="row capacidade-disponivel">
									<div class="col-md-12">
										<span class="btn btn-danger btn-simple upper pull-right" style="cursor: default;">
											Capacidade de Carga Disponível <?= $romaneio[0]->tipo_veiculo->peso-$peso_ent ?> Kg.
										</span>
									</div>
								</div>
								<div class="row btn-footer">
									<div class="col-md-12">
										<?php if($romaneio[0]->status_romaneio->codigo != 5): ?>
											<span class="btn btn-danger btn-round btn-fab btn-simple btn-add pull-right f12 upper pull-left" rel="tooltip" title="Adicionar" data-placement="right">
												<i class="material-icons" style="font-size: 25px;">add</i>
											</span>
										<?php endif; ?>
										<button type="submit" name="editar" class="btn btn-danger btn-fill btn-salvar pull-right f12 upper">Salvar</button>
									</div>
								</div>
								</form>

								<div id="add" style="display: none;">
									<form action="<?= base_url().'entrega/cadastrar' ?>" method="post">
										<input type="hidden" name="romaneio" value="<?= $this->uri->segment(3); ?>">
										<input type="hidden" name="entrega" value="<?= ++$ult_entrega; ?>">
										<div class="row">
											<div class="col-md-2 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Romaneio</label>
													<input type="hidden" name="entrega1" value="entrega1">
													<input type="text" value="<?= $this->uri->segment(3); ?>" class="form-control" style="text-align: center;" disabled>
												</div>
											</div>
											<div class="col-md-10 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Destinatário</label>
													<select class="form-control" name="destinatario" ng-model="destinatario">
														<option value="" class="option_none" disabled selected></option>
														<?php foreach($destinatario as $row): ?>
															<option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>">
																<?= $row->razao_social." — ".$row->bairro.", ".$row->cidade; ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Peso da Carga</label>
													<input type="number" min="1" max="<?= $romaneio[0]->tipo_veiculo->peso-$peso_ent ?>" ng-model="peso_carga" pattern="[0-9]+$" class="form-control" name="peso_carga" required>
												</div>
											</div>
											<div class="col-md-3 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Medida</label>
													<select class="form-control" name="medida" required>
														<option value="kg" selected>Quilograma</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Nota Fiscal</label>
													<input type="text" pattern="[0-9]+$" class="form-control add-nota-fiscal" name="nota_fiscal" minlength="7" maxlength="7">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span class="btn btn-danger btn-round btn-fab btn-simple btn-close pull-left f12 upper pull-left" rel="tooltip" title="Fechar" data-placement="right">
													<i class="material-icons" style="font-size: 25px;">close</i>
												</span>
												<button type="submit" class="btn btn-danger btn-fill btn-salvar pull-right f12 upper" ng-disabled="!destinatario || !peso_carga">Adicionar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<?php if($ocorrencia != FALSE): ?>
							<div class="tab-pane" id="ocorrencias">
								<?php
									$item = 0;
									foreach($ocorrencia as $row):
										++$item;
										$foto = explode(",", str_replace("[", "", str_replace("]", "", $row->foto)));
								?>
									<div aria-multiselectable="true" class="panel-group" id="set_<?= $i; ?>" role="tablist">
										<div class="panel panel-default">
											<div class="panel-heading" id="headingOne" role="tab" >
												<a aria-controls="collapseOne" aria-expanded="true" data-parent="#accordion" data-toggle="collapse" href="#c_<?= $item; ?>" role="button" class="">
													<h2 class="panel-title">
														<?= $row->tipo_ocorrencia->descricao; ?>
														<span class="pull-right">
															<span class="seq">
																<?php
																	$data = explode(" ", $row->data);
																	$dia = explode("-", $data[0]);
																	$horario = explode(":", $data[1]);
																?>

																<?= $dia[2]."/".$dia[1]; ?>
																<?= (date("Y-m-d")==$data[0])? 'Hoje' : diasemana($data[0], 'curto'); ?> ás 
																<?= $horario[0].":".$horario[1]."h"; ?>
															</span>
														</span>
													</h2>
												</a>
											</div>
											<div aria-labelledby="headingOne" class="panel-collapse collapse" id="c_<?= $item; ?>" role="tabpanel" aria-expanded="true" style="">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-12">
															<h4 class="gray upper f12">Descrição</h4>
															<p>
																<?= ($row->descricao != '')? $row->descricao : 'Não há descrição.'; ?>
															</p>
															<h4 class="gray upper f12"><?= (count($foto) >= 2)? 'Fotos':'Foto'; ?></h4>
															<?php for($i = 0; $i < count($foto); $i++): ?>
																<img src="data:image/jpg;base64,<?= $foto[$i] ?>" rel="tooltip">
															<?php endfor; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
											<!-- img width="150" src="data:image/jpg;base64,<?= $foto[$i] ?>" rel="tooltip" style="border-radius: 10px; padding: 5px;" class="ocorrencia" -->
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Rota de Entregas</h4>
						<p class="category">Itinerário do Romaneio <?= $romaneio[0]->codigo ?></p>
					</div>
					<div class="card-content table-responsive" style="height: 350px; overflow-x: auto;" id="trajeto">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="map" style="width: 45%"></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=119082038778375";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	function initMap() {
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -8.085493, lng: -34.8877151},
			zoom: 17
		});
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById('trajeto'));

		calculateAndDisplayRoute(directionsService, directionsDisplay);
		marker.setPosition(location);
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		var waypts = [];
		<?php
			$fim = array_pop($entrega);
			if(count($entrega) >= 1):
				foreach($entrega as $row):
		?>
			waypts.push({
				location: '<?= $row->destinatario->logradouro.", ".$row->destinatario->numero." - ".$row->destinatario->bairro ?>',
				stopover: true
			});
		<?php
				endforeach;
			endif;
		?>

		directionsService.route({
			origin: '<?= $romaneio[0]->estabelecimento->logradouro.", ".$romaneio[0]->estabelecimento->numero." - ".$romaneio[0]->estabelecimento->bairro ?>',
			destination: '<?= $fim->destinatario->logradouro.", ".$fim->destinatario->numero." - ".$fim->destinatario->bairro ?>',
			waypoints: waypts,
			optimizeWaypoints: true,
			travelMode: 'DRIVING'
		}, function(response, status) {
			if (status === 'OK') {
				directionsDisplay.setDirections(response);
			} else {
				location.reload();
			}
		});
	}

	$('.add-nota-fiscal').blur(function(){
		var nota_fiscal = $('.add-nota-fiscal').val();
		if(nota_fiscal.length == 7) {
			$.ajax({
				url: '<?= base_url() ?>entrega/verificar',
				type: 'POST',
				data: 'nota_fiscal='+nota_fiscal,
				dataType: 'json',
				success: function(data) {
					if(data == false) {
						demo.showNotification('bottom', 'right', 'Nota Fiscal já cadastrado, tente outro NFS.');
						$('.add-nota-fiscal').val("");
						$('.add-nota-fiscal').focus();
					}
				}
			});

			return true;
		}
	});

	$(".transportadora").change(function() {
		var transportadora = $('.transportadora').val();
		if(transportadora == '0') {
			$(".undefined").css("display", "block");
		} else {
			$(".undefined").css("display", "none");
		}
	});

	$(".btn-add").click(function() {
		$("#sortable").hide();
		$(".capacidade-disponivel").hide();
		$(".btn-footer").hide();
		$("#add").fadeIn();
	});

	$(".btn-close").click(function() {
		$("#add").hide();
		$("#sortable").fadeIn();
		$(".capacidade-disponivel").fadeIn();
		$(".btn-footer").fadeIn();
	});

	$(document).ready(function(){
		var transportadora = $('.transportadora').val();
		if(transportadora == '0') {
			$(".undefined").css("display", "block");
		} else {
			$(".undefined").css("display", "none");
		}

		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>

<!-- https://developers.google.com/maps/documentation/javascript/examples/directions-waypoints?hl=pt-br -->