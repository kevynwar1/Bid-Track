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
                                    <li class="">
                                        <a data-toggle="tab" href="#messages" aria-expanded="false">
                                            <i class="material-icons">mail_outline</i> Encaminhar
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                        		<form action="<?= base_url().'romaneio/editar' ?>" method="post">
                    			<input type="hidden" name="codigo" value="<?= $romaneio[0]->codigo; ?>">
                            	<div class="row">
									<div class="col-md-3 lm15">
										<div class="form-group label-floating">
											<label class="control-label">Romaneio</label>
											<input type="text" class="form-control" value="<?= $romaneio[0]->codigo; ?>" autocomplete="off" disabled>
										</div>
									</div>
									<div class="col-md-9 lm15">
										<div class="form-group label-floating">
											<label class="control-label">Estabelecimento</label>
											<select class="form-control estabelecimento" name="estabelecimento">
												<?php foreach($estabelecimento as $row): ?>
													<option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>" <?= ($row->codigo == $romaneio[0]->estabelecimento->codigo) ? 'selected' : '' ?>>
														<?= $row->razao_social." — ".$row->bairro; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 lm15">
										<div class="form-group">
											<label>Transportadora</label>
											<select class="form-control" name="transportadora">
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
											<label>Tipo do Veículo</label>
											<select class="form-control" name="tipoveiculo">
												<?php foreach($tipoveiculo as $row): ?>
													<option class="option" value="<?= $row->codigo ?>" <?= ($row->codigo == $romaneio[0]->tipo_veiculo->codigo) ? 'selected' : '' ?>>
														<?= $row->descricao; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-4 lm15">
										<div class="form-group">
											<label>Motorista</label>
											<select class="form-control motorista" name="motorista">
												<option class="option-undefined" value="0" <?= ($romaneio[0]->motorista->codigo == NULL) ? 'selected' : '' ?>>Indefinido</option>
												<?php
													foreach($motorista as $row):
														$nome = explode(" ", $row->nome);
												?>
													<option class="option" value="<?= $row->codigo ?>" <?= ($row->codigo == $romaneio[0]->motorista->codigo) ? 'selected' : '' ?>>
														<?= $nome[0]." ".end($nome); ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" name="editar" class="btn btn-danger btn-fill pull-right f12 upper">Editar</button>
									</div>
								</div>
                            	</form>
                            </div>
                            <div class="tab-pane" id="entregas">
								<?php
									$i = 0;
									foreach($entrega as $row):
										$i++;
								?>
								<div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
									<div class="panel panel-default">
										<div class="panel-heading" id="headingOne" role="tab">
											<a aria-controls="collapseOne" aria-expanded="true" data-parent="#accordion" data-toggle="collapse" href="#collapse<?= $i; ?>" role="button" class="">
												<h2 class="panel-title">
													<?= $row->destinatario->logradouro; ?>, <?= $row->destinatario->numero; ?> — <?= $row->destinatario->bairro; ?>, <?= $row->destinatario->cidade ?>
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
															<input type="text" name="pesocarga" value="<?= $row->nota_fiscal; ?>" class="form-control" autocomplete="off" disabled>
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
								<?php endforeach; ?>
							</div>
							<div class="tab-pane" id="messages">
								<form action="#" method="post">
									<input type="hidden" name="romaneio" value="<?= $this->uri->segment(3); ?>">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group label-floating">
												<label class="control-label">E-mail</label>
												<input type="email" name="email" class="form-control" autocomplete="off" ng-model="email">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="submit" ng-disabled="!email" name="editar" class="btn btn-danger btn-fill pull-right f12 upper">Enviar</button>
										</div>
									</div>
								</form>
							</div>
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
<div id="map" style="width: 45%;"></div>

<script type="text/javascript">
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
				window.alert('Directions request failed due to ' + status);
			}
		});
	}
</script>

<!-- https://developers.google.com/maps/documentation/javascript/examples/directions-waypoints?hl=pt-br -->