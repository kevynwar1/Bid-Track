<style type="text/css">
	.book { margin-top: 100px; }
	.page {
		width: 210mm;
		min-height: 297mm;
		padding: 20mm;
		margin: 10mm auto;
		background: #FFF;
		box-shadow: 0 0 15px rgba(0,0,0, 0.1);
	}
	.subpage {
		border: 1px #FFF solid;
		height: 257mm;
		outline: 2cm #FFF solid;
	}

	@page {
		size: A4;
		margin: 0;
	}
	@media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

	table td { padding: 5px; }
</style>

<div class="book">
	<div class="page">
		<div class="subpage">
			<h3>Romaneio</h3>
			<table width="100%" bordercolor="#CCC" border="1">
				<tr>
					<td width="30%" valign="top">Cód. do Romaneio</td>
					<td width="70%"><?= $romaneio[0]->codigo; ?></td>
				</tr>
				<tr>
					<td width="30%" valign="top">Estabelecimento</td>
					<td width="70%">
						<?= $romaneio[0]->estabelecimento->razao_social; ?><br>
						<?= "CNPJ — ".$romaneio[0]->estabelecimento->cnpj; ?><br>
						<?= $romaneio[0]->estabelecimento->logradouro; ?>, 
						<?= $romaneio[0]->estabelecimento->complemento; ?>  
						<?= $romaneio[0]->estabelecimento->numero; ?> — 
						<?= $romaneio[0]->estabelecimento->bairro; ?>, 
						<?= $romaneio[0]->estabelecimento->cidade; ?> - 
						<?= $romaneio[0]->estabelecimento->uf; ?>.
					</td>
				</tr>
				<tr>
					<td width="30%" valign="top">Transportadora</td>
					<td width="70%">
						<?php
							if(is_null($romaneio[0]->transportadora->nome_fantasia)) {
								echo $romaneio[0]->estabelecimento->razao_social;
							} else {
								echo $romaneio[0]->transportadora->razao_social."<br>";
								echo "CNPJ — ".$romaneio[0]->transportadora->cnpj."<br>";
								echo $romaneio[0]->transportadora->logradouro.", ";
								echo $romaneio[0]->transportadora->complemento." ";
								echo $romaneio[0]->transportadora->numero." — ";
								echo $romaneio[0]->transportadora->bairro,", ";
								echo $romaneio[0]->transportadora->cidade." - ";
								echo $romaneio[0]->transportadora->uf.".";
							}
						?>
					</td>
				</tr>
				<tr>
					<td width="30%" valign="top">Motorista</td>
					<td width="70%">
						<?php
							if(is_null($romaneio[0]->motorista->nome)) {
								echo "Indefinido";
							} else {
								echo $romaneio[0]->motorista->nome."<br>";
								echo "CPF — ".$romaneio[0]->motorista->cpf."<br>";
								echo $romaneio[0]->motorista->logradouro.", ";
								echo $romaneio[0]->motorista->complemento." ";
								echo $romaneio[0]->motorista->numero." — ";
								echo $romaneio[0]->motorista->bairro,", ";
								echo $romaneio[0]->motorista->cidade." - ";
								echo $romaneio[0]->motorista->uf.".";
							}
						?>
					</td>
				</tr>
				<tr>
					<td width="30%" valign="top">Tipo do Veículo</td>
					<td width="70%"><?= $romaneio[0]->tipo_veiculo->descricao; ?></td>
				</tr>
				<tr>
					<td width="30%" valign="top">Status</td>
					<td width="70%"><?= $romaneio[0]->status_romaneio->descricao; ?></td>
				</tr>
			</table>

			<h3>Entrega(s)</h3>
			<?php
				$i = 0;
				foreach($entrega as $row):
					++$i;
			?>
			Entrega <?= $i; ?>
			<table width="100%" bordercolor="#CCC" border="1">
				<tr>
					<td width="30%" valign="top">Destinatário</td>
					<td width="70%">
						<?= $row->destinatario->razao_social; ?><br>
						<?php
							echo "CNPJ — ".$row->destinatario->cnpj_cpf."<br>";
							echo "Contato: ".$row->destinatario->telefone." / ".$row->destinatario->email."<br>";
							echo $row->destinatario->logradouro.", ";
							echo $row->destinatario->complemento." ";
							echo $row->destinatario->numero." — ";
							echo $row->destinatario->bairro,", ";
							echo $row->destinatario->cidade." - ";
							echo $row->destinatario->uf.".";
						?>
					</td>
				</tr>
				<tr>
					<td width="30%" valign="top">Peso da Carga</td>
					<td width="70%"><?= $row->peso_carga; ?></td>
				</tr>
				<tr>
					<td width="30%" valign="top">Nota Fiscal</td>
					<td width="70%"><?= ($row->nota_fiscal == '0')? 'Indefinido' : $row->nota_fiscal; ?></td>
				</tr>
				<tr>
					<td width="30%" valign="top">Status</td>
					<td width="70%"><?= $row->status_entrega->descricao; ?></td>
				</tr>
			</table><br>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="page">
		<div class="subpage">
			<h3>Itinerário</h3>
			<div id="trajeto" align="center"></div>
		</div>
	</div>
</div>

<!-- script type="text/javascript">
	function initMap() {
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
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
				window.alert('Directions request failed due to ' + status);
			}
		});
	}
</script -->