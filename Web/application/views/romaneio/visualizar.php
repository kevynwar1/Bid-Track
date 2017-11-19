<?php
	if(!empty($entrega)) {
		$peso_ent = 0;
		foreach($entrega as $row) {
			$peso_ent += $row->peso_carga;
		}
	}

	$origins = "Rua Estrela do Mar+553+-+Brasilia+Teimosa";
	$destinations = "Rua Nogueira de Souza+88+-+Pina";
	$distancia = simplexml_load_file("http://maps.googleapis.com/maps/api/distancematrix/xml?origins=".$origins."&destinations=".$destinations."&mode=CAR&language=PT&sensor=false");
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

<div class="content" style="width: 55%; float: left">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
                    <div class="card-header card-header-tabs" data-background-color="blue-center">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs" style="background: none">
                                    <li class="active">
                                        <a data-toggle="tab" href="#profile" aria-expanded="true">
                                            <i class="material-icons">local_shipping</i> Romaneio
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="">
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
                    <div class="card-content">
						<div class="tab-content">
							<div class="tab-pane active" id="profile">
								<div class="row">
									<div class="col-md-12" style="padding: 10px 10px 5px 10px">
										<div class="fb-save pull-right" data-uri="http://coopera.pe.hu/romaneio/visualizar/<?= $romaneio[0]->codigo ?>"></div>
										<iframe src="https://www.facebook.com/plugins/share_button.php?href=http://coopera.pe.hu/romaneio/visualizar/<?= $romaneio[0]->codigo ?>&layout=button&size=large&mobile_iframe=true&appId=119082038778375&width=119&height=28" width="119" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
									</div>
								</div>
                            	<div class="row">
									<div class="col-md-2 lm15">
										<div class="form-group label-floating">
											<label>Romaneio</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->codigo ?>" autocomplete="off" style="text-align: center;" disabled>
										</div>
									</div>
									<div class="col-md-10 lm15">
										<div class="form-group label-floating">
											<label>Estabelecimento</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->estabelecimento->logradouro; ?>, <?= $romaneio[0]->estabelecimento->numero; ?> — <?= $romaneio[0]->estabelecimento->bairro; ?>, <?= $romaneio[0]->estabelecimento->cidade; ?>" autocomplete="off" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 lm15">
										<div class="form-group">
											<label>Transportadora</label>
											<input type="text" class="form-control" value="<?= (is_null($romaneio[0]->transportadora->nome_fantasia)) ? $romaneio[0]->estabelecimento->razao_social : $romaneio[0]->transportadora->nome_fantasia; ?>" autocomplete="off" disabled>
										</div>
									</div>
									<div class="col-md-6 lm15">
										<div class="form-group">
											<label>Motorista</label>
											<input type="text" class="form-control" value="<?= (is_null($romaneio[0]->motorista->nome)) ? "Indefinido" : $romaneio[0]->motorista->nome; ?>" autocomplete="off" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 lm15">
										<div class="form-group">
											<label>Tipo do Veículo</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->tipo_veiculo->descricao ?>" disabled>
										</div>
									</div>
									<div class="col-md-3 lm15">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->status_romaneio->descricao ?>" disabled>
										</div>
									</div>
									<div class="col-md-3 lm15">
										<div class="form-group">
											<label>Preço</label>
											<input type="text" id="valor" class="form-control" value="<?= $romaneio[0]->valor ?>" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<?= $distancia->row->element->distance->text; ?>
									</div>
									<div class="col-md-6">
										<a href="<?= base_url().'romaneio/imprimir/'.$romaneio[0]->codigo ?>">
											<span type="submit" class="btn btn-danger btn-simple btn-fill pull-left f12 upper">
												Imprimir
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="entregas">
								<?php
									if(!empty($entrega)):
										$i = 0;
										foreach($entrega as $row):
											$i++;
								?>
								<div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
									<div class="panel panel-default">
										<div class="panel-heading" id="headingOne" role="tab">
											<a aria-controls="collapseOne" aria-expanded="true" data-parent="#accordion" data-toggle="collapse" href="#collapse<?= $i; ?>" role="button" class="">
												<h2 class="panel-title">
													<?= $row->destinatario->razao_social; ?> — <?= $row->destinatario->bairro; ?>, <?= $row->destinatario->cidade ?>
												</h2>
											</a>
										</div>
										<div aria-labelledby="headingOne" class="panel-collapse collapse" id="collapse<?= $i; ?>" role="tabpanel" aria-expanded="true" style="">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12 lm15">
														<div class="form-group">
															<label>Entrega <?= $i; ?></label>
															<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç\s]+$" class="form-control" placeholder="Entrega 2" value="<?= $row->destinatario->logradouro; ?>, <?= $row->destinatario->numero; ?> — <?= $row->destinatario->bairro; ?>, <?= $row->destinatario->cidade; ?>" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4 lm15">
														<div class="form-group">
															<label>Peso da Carga</label>
															<input type="text" name="pesocarga" value="<?= $row->peso_carga; ?>" class="form-control" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-md-4 lm15">
														<div class="form-group">
															<label>Nota Fiscal</label>
															<input type="text" name="pesocarga" value="<?= ($row->nota_fiscal == '0')? 'Indefinido' : $row->nota_fiscal; ?>" class="form-control" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-md-4 lm15">
														<div class="form-group">
															<label>Status</label>
															<input type="text" name="pesocarga" value="<?= $row->status_entrega->descricao; ?>" class="form-control" autocomplete="off" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
										endforeach;
									endif;
								?>
								<div class="row">
									<div class="col-md-12">
										<span class="btn btn-danger btn-simple upper pull-right" style="cursor: default;">
											Capacidade de Carga Disponível <?= $romaneio[0]->tipo_veiculo->peso-$peso_ent ?> Kg.
										</span>
									</div>
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
						<p class="category">Trajeto do Romaneio <?= $romaneio[0]->codigo ?></p>
					</div>
					<div class="card-content table-responsive" style="height: 350px; overflow-x: auto;" id="trajeto">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="map" style="width: 45%;"></div>

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
			if(!empty($entrega)):
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

	$(document).ready(function(){
		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>

<!-- https://developers.google.com/maps/documentation/javascript/examples/directions-waypoints?hl=pt-br -->
