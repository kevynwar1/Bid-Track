<!-- link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="<?= base_url(); ?>assets/js/select2.min.js"></script -->

<style type="text/css">
	.select2-container--default .select2-selection--single {
		border-top: none !important;
		border-left: none !important;
		border-right: none !important;
		border-bottom: 1px solid #D2D2D2 !important;
		border-radius: 0 !important;
		margin-top: 7px !important;
		cursor: text !important;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #555 !important;
		font-weight: 400 !important;
		line-height: 22px !important;
	}
	.select2-container .select2-selection--single .select2-selection__rendered {
		padding-left: 0 !important;
		padding-bottom: 15px !important;
	}
	.select2-container--default.select2-container--disabled .select2-selection--single {
		border-top: none !important;
		border-left: none !important;
		border-right: none !important;
		background-color: #FFF !important;
		border-bottom: 1px dotted #CCC !important;
	}

	b { display: none !important; }
</style>

<?php if($destinatario != FALSE && $estabelecimento != FALSE && $transportadora != FALSE && $motorista != FALSE && $tipoveiculo != FALSE): ?>
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
							<div class="col-md-2 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Cód.</label>
									<input type="text" minlength="4" maxlength="4" pattern="[0-9]+$" class="form-control codigo" name="codigo" ng-model="codigo" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-7 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Estabelecimento</label>
									<select class="form-control estabelecimento js-data-example-ajax" name="estabelecimento" ng-model="estabelecimento">
										<option value="" class="option_none" disabled selected></option>
										<?php foreach($estabelecimento as $row): ?>
											<option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>" <?= (!is_null($this->session->flashdata('estabelecimento')) && $row->codigo == $this->session->flashdata('estabelecimento'))? 'selected' : ''; ?>>
												<?= $row->razao_social." — ".$row->bairro; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Preço</label>
									<input type="text" id="valor" class="form-control" name="valor" autocomplete="off" ng-model="valor">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Transportadora</label>
									<select class="form-control transportadora" name="transportadora" ng-model="transportadora">
										<option value="" class="option_none" disabled selected></option>
										<option class="option-undefined" value="0">Estabelecimento</option>
										<?php foreach($transportadora as $row): ?>
											<option class="option" value="<?= $row->codigo ?>" <?= (!is_null($this->session->flashdata('transportadora')) && $row->codigo == $this->session->flashdata('transportadora'))? 'selected' : ''; ?>>
												<?= $row->nome_fantasia; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Motorista</label>
									<select class="form-control motorista" name="motorista" ng-model="motorista">
										<option value="" class="option_none" disabled selected></option>
										<option class="option-undefined undefined" style="display: none !important" value="0">Indefinido</option>
										<?php
											foreach($motorista as $row):
												$nome = explode(" ", $row->nome);
										?>
											<option class="option" value="<?= $row->codigo ?>" <?= (!is_null($this->session->flashdata('motorista')) && $row->codigo == $this->session->flashdata('motorista'))? 'selected' : ''; ?>>
												<?= (count($nome) > 1)? $nome[0]." ".end($nome) : $nome[0]; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-4 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Tipo do Veículo</label>
									<select class="form-control tipoveiculo" name="tipoveiculo" ng-model="tipoveiculo">
										<option value="" class="option_none" disabled selected></option>
										<?php foreach($tipoveiculo as $row): ?>
											<option class="option" value="<?= $row->codigo ?>" <?= (!is_null($this->session->flashdata('tipoveiculo')) && $row->codigo == $this->session->flashdata('tipoveiculo'))? 'selected' : ''; ?>>
												<?= $row->descricao; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>

						<!-- div class="row" ng-if="tipoveiculo">
							<div class="col-md-12">
								<span class="btn btn-danger btn-simple upper pull-right" style="cursor: default;">
									Capacidade de Carga {{tipoveiculo}} Kg.
								</span>
							</div>
						</div -->
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Entrega</h4>
						<p class="category">Cadastre a(s) Entrega(s) do Romaneio {{codigo}}</p>
					</div>
					<div class="card-content">
						<div class="row">
							<div class="col-md-2 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Romaneio</label>
									<input type="hidden" name="entrega1" value="entrega1">
									<input type="text" value="{{codigo}}" class="form-control" style="text-align: center;" disabled>
								</div>
							</div>
							<div class="col-md-10 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Destinatário</label>
									<select class="form-control destinatario1" name="destinatario1" ng-disabled="!codigo || !estabelecimento || !transportadora || !tipoveiculo || !motorista" ng-model="destinatario" required>
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
									<label class="control-label">Peso Carga</label>
									<input type="number" min="1" pattern="[0-9]+$" class="form-control peso_carga1" name="peso_carga1" ng-model="peso_carga1" required> <!-- max="{{tipoveiculo}}" -->
								</div>
							</div>
							<div class="col-md-3 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Medida</label>
									<select class="form-control medida1" name="medida1" required>
										<option value="kg" selected>Quilograma</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Nota Fiscal</label>
									<input type="text" pattern="[0-9]+$" class="form-control" name="nota_fiscal1" minlength="7" maxlength="7">
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12" id="card-entrega"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span class="btn btn-danger btn-round btn-fab btn-entrega btn-fab-mini pull-left" rel="tooltip" title="Adicionar Entrega" data-placement="right" onclick="add()" ng-hide="!codigo || !estabelecimento || !transportadora || !tipoveiculo || !motorista"> <!--  -->
					<i class="material-icons" style="font-size: 25px;">add</i>
					<div class="ripple-container"></div>
				</span>
				<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" ng-disabled="!codigo || !estabelecimento || !transportadora || !tipoveiculo || !motorista">Cadastrar</button>
			</div>
		</div>
	</form>
	</div>
</div>
<div id="map" style="width: 45%;"></div>
<?php else: ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12" align="center">
					<span style="font-size: 48px; font-family: arial;">
						:(
						<br><br>
						<span style="font-size: 30px">Cadastre as Dependências</span>
					</span>
					<br><br>

					Para realizar o Cadastro do Romaneio é necessário que<br> a sua Empresa tenha cadastrada as seguintes dependências: <br><br>
						<table style="color: #999; text-transform: uppercase;" border="0">
							<tr><td><?= ($destinatario == FALSE)? '• Destinatário<br>':''; ?></td></tr>
							<tr><td><?= ($estabelecimento == FALSE)? '• Estabelecimento<br>':''; ?></td></tr>
							<tr><td><?= ($motorista == FALSE)? '• Motorista<br>':''; ?></td></tr>
							<tr><td><?= ($tipoveiculo == FALSE)? '• Tipo de Veículo<br>':''; ?></td></tr>
							<tr><td><?= ($transportadora == FALSE)? '• Transportadora<br>':''; ?></td></tr>
						</table>
					</span>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	var count = 1;
	var total = <?= count($destinatario); ?>;

	function add() {
		var destinatario = $(".destinatario"+count).val();
		var peso_carga = $(".peso_carga"+count).val();
		var medida = $(".medida"+count).val();

		if(destinatario != undefined) {
			if(peso_carga != "" && peso_carga != undefined) {
				if(medida != undefined) {
					/*if(count < total) {*/
						++count;
						$(".btn-remove").hide();
						var wrapper = document.querySelector('#card-entrega');
						var html = '<div class="row" id="card-entrega'+count+'"><div class="col-md-12"><div class="card"><div class="card-header card-header-text" data-background-color="blue-center"><h4 class="card-title">Entrega '+count+'<span class="pull-right btn-remove btn-remove-'+count+'" onclick="remove('+count+')" rel="tooltip" title="Excluir"><i class="material-icons">delete</i></span></h4></div><div class="card-content"><div class="row"><div class="col-md-12 lm15"><input type="hidden" name="entrega'+count+'" value="entrega'+count+'"><div class="form-group label-floating"><label class="control-label">Destinatário</label><select class="form-control destinatario'+count+'" name="destinatario'+count+'" ng-disabled="!codigo || !estabelecimento || !transportadora || !tipoveiculo || !motorista" required><option value="" class="option_none" disabled selected></option><?php foreach($destinatario as $row): ?><option class="option" value="<?= $row->codigo ?>|<?= $row->logradouro.", ".$row->numero." - ".$row->bairro ?>"><?= $row->razao_social." — ".$row->bairro.", ".$row->cidade; ?></option><?php endforeach; ?></select></div></div></div><div class="row"><div class="col-md-3 lm15"><div class="form-group label-floating"><label class="control-label">Peso da Carga</label><input type="number" pattern="[0-9]+$" class="form-control peso_carga'+count+'" ng-model="peso_carga'+count+'" name="peso_carga'+count+'" required></div></div><div class="col-md-3 lm15"><div class="form-group label-floating"><label class="control-label">Medida</label><select class="form-control medida'+count+'" name="medida'+count+'" required><option value="kg" selected>Quilograma</option></select></div></div><div class="col-md-6 lm15"><div class="form-group label-floating"><label class="control-label">Nota Fiscal</label><input type="text" pattern="[0-9]+$" class="form-control nota_fiscal" name="nota_fiscal'+count+'" minlength="7" maxlength="7"></div></div></div></div></div></div></div>';

						wrapper.insertAdjacentHTML('beforeend', html);
						/*if(count == total) {
							demo.showNotification('bottom', 'right', 'Limite de Destinatário(s) para entrega atingido.');
							$('.btn-entrega').fadeOut("fast");	
						}
					}*/
				} else {
					$(".medida"+count).focus();
					demo.showNotification('bottom', 'right', 'Por favor, selecione a Medida de Peso da Carga.');
				}
			} else {
				$(".peso_carga"+count).focus();
				demo.showNotification('bottom', 'right', 'Por favor, preencha o Peso da Carga.');
			}
		} else {
			$(".destinatario"+count).focus();
			demo.showNotification('bottom', 'right', 'Por favor, selecione o Destinatário da entrega.');
		}
	}

	function remove(entrega) {
		--count;
		$(".btn-remove-"+count).show();
		$("#card-entrega"+entrega).remove();
		if(count < total) {
			$('.btn-entrega').fadeIn("slow");
		}
	}

	function initMap() {
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -8.0631614, lng: -34.87122372},
			zoom: 17
		});
		directionsDisplay.setMap(map);

		marker.setPosition(location);
	}

	$('.codigo').blur(function(){
		var codigo = $('.codigo').val();
		if(codigo.length == 4) {
			$.ajax({
				url: '<?= base_url() ?>romaneio/verificar',
				type: 'POST',
				data: 'codigo='+codigo,
				dataType: 'json',
				success: function(data) {
					if(data == false) {
						demo.showNotification('bottom', 'right', 'Romaneio já cadastrado, tente outro Código.');
						$('.codigo').val("");
						$('.codigo').focus();
					}
				}
			});

			return true;
		}
	});

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

	$('.destinatario1').change(function() {
		var origem = $('.estabelecimento').val().split("|");
		var destinatario = $('.destinatario1').val().split("|");

		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -8.0631614, lng: -34.87122372},
			zoom: 17
		});
		directionsDisplay.setMap(map);

		directionsService.route({
			origin: origem[1],
			destination: destinatario[1],
			/*waypoints: waypts,*/
			optimizeWaypoints: true,
			travelMode: 'DRIVING'
		}, function(response, status) {
			if (status === 'OK') {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('A solicitação de instruções falhou devido a ' + status);
			}
		});

		marker.setPosition(location);
	});

	$('.transportadora').change(function() {
		var transportadora = $('.transportadora').val();
		if(transportadora == '0') {
			$(".undefined").css("display", "block");
		} else {
			$(".undefined").css("display", "none");
		}
	});
	
	$(document).ready(function(){
		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
		$('.estabelecimento').select2({ placeholder: "Estabelecimento" });
		$('.transportadora').select2({ placeholder: "Transportadora" });
		$('.motorista').select2({ placeholder: "Motorista" });
		$('.tipoveiculo').select2({ placeholder: "Tipo Veículo" });
	});
</script>