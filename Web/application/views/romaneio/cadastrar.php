<style type="text/css">
	.option_none { display: none; }
	footer { display: none; }
</style>

<div class="content" style="width: 55%; float: left">
	<div class="container-fluid">
	<form action="<?= base_url().'romaneio/cadastrar' ?>" method="post">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Romaneio</h4>
						<p class="category">Cadastre o Romaneio {{codigo}}</p>
					</div>
					<div class="card-content">
						<div class="row">
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Romaneio</label>
									<input type="text" pattern="[0-9]+$" class="form-control" name="codigo" ng-model="codigo" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-9 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Estabelecimento</label>
									<select class="form-control estabelecimento" name="estabelecimento" ng-model="estabelecimento">
										<option value="" selected disabled></option>
										<?php foreach($estabelecimento as $row): ?>
											<option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>">
												<?= $row->razao_social." — ".$row->bairro; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Motorista</label>
									<select class="form-control" name="motorista" ng-model="motorista">
										<option value="" class="option_none" disabled selected></option>
										<?php
											foreach($motorista as $row):
												$nome = explode(" ", $row->nome);
										?>
											<option class="option" value="<?= $row->codigo ?>">
												<?= $nome[0]." ".end($nome); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Veículo</label>
									<select class="form-control" name="veiculo" ng-model="veiculo">
										<option value="" class="option_none" disabled selected></option>
										<?php foreach($veiculo as $row): ?>
											<option class="option" value="<?= $row->codigo ?>">
												<?= $row->placa; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Transportadora</label>
									<select class="form-control" name="transportadora" ng-model="transportadora">
										<option value="" class="option_none" disabled selected></option>
										<?php foreach($transportadora as $row): ?>
											<option class="option" value="<?= $row->codigo ?>">
												<?= $row->nome_fantasia; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="card-entrega">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Entrega</h4>
						<p class="category">Cadastre as Entrega do Romaneio {{codigo}}</p>
					</div>
					<div class="card-content">
						<div class="row">
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Romaneio</label>
									<input type="text" value="{{codigo}}" class="form-control" disabled>
								</div>
							</div>
							<div class="col-md-9 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Destinatário</label>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Peso da Carga</label>
									<input type="text" pattern="[0-9]+$" class="form-control" name="peso_carga">
								</div>
							</div>
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Medida</label>
									<select class="form-control" name="medida">
										<option value="" class="option_none" disabled selected></option>
										<option value="kg">Quilograma</option>
										<option value="t">Tonelada</option>
										<option value="hg">Hectograma</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Nota Fiscal</label>
									<input type="text" pattern="[0-9]+$" class="form-control" name="nota_fiscal" minlength="7" maxlength="7">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12">
				<span class="btn btn-danger btn-simple btn-round btn-fab btn-entrega btn-fab-mini" rel="tooltip" title="Adicionar Entrega" data-placement="right">
					<i class="material-icons" style="font-size: 25px;">add</i>
					<div class="ripple-container"></div>
				</span>
				<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" ng-disabled="!codigo || !estabelecimento">Cadastrar</button>
			</div>
		</div>
	</form>
	</div>
</div>
<div id="map" style="width: 45%;"></div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-entrega').click(function(e){
			var f = $("#card-entrega"),
				c = f.clone(true,true);
			c.insertAfter(f);
		});
	});

	function initMap() {
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -8.0631614, lng: -34.87122372},
			zoom: 17
		});
		directionsDisplay.setMap(map);

		marker.setPosition(location);
	}

	$('.estabelecimento').change(function() {
		var endereco = $('.estabelecimento').val().split("|");
		$.ajax({
			url: '<?= base_url() ?>home/maps',
			type: 'POST',
			data: 'address='+endereco[1],
			dataType: 'json',
			success: function(data) {
				if(data.status == "OK") {
					var map = new google.maps.Map(document.getElementById('map'), {
						center: {lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng},
						zoom: 17
					});

					var mapa = document.getElementById('map'); 
					var latidude = data.results[0].geometry.location.lat;
					var longitude = data.results[0].geometry.location.lng;
					var location = new google.maps.LatLng(latidude, longitude);

					var marker = new google.maps.Marker({
						map: map,
						draggable: true,
					});
					marker.setPosition(location);

					map.setCenter(location);
					map.setZoom(17);
				}
			}
		});
		return true;
	});
</script>