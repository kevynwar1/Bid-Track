<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/materialize.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/input-field.css">

<div class="content">
	<div class="container-fluid">
	<?php if(!isset($romaneio)) { ?>
	<div class="row">
		<div class="col-md-12" align="center">
			<form action="<?= base_url().'romaneio/integrar' ?>" method="post" enctype="multipart/form-data">
				<div class="box">
					<input type="file" name="arquivo" id="file-6" class="inputfile inputfile-5" style="display: none;" required />
					<label for="file-6">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg>
						</figure>
						<span></span>
					</label>
				</div>
				<button type="submit" class="btn btn-danger btn-simple">
					Enviar
				</button>
			</form>
		</div>
	</div>
	<?php } else { ?>
	<?= p($entrega[0]); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" data-background-color="blue-left">
					<h4 class="card-title">Romaneio</h4>
				</div>
				<div class="card-content table-responsive">
					<table class="table">
						<thead class="text-primary">
							<th>Código</th>
							<th>Estabelecimento</th>
							<th>Preço</th>
							<th>Transportadora</th>
							<th>Motorista</th>
							<th>Tipo de Veículo</th>
						</thead>
						<tbody>
							<tr>	
								<td><?= $romaneio[0]; ?></td>
								<td><?= $romaneio[1]->razao_social; ?></td>
								<td><span id="valor"><?= $romaneio[2] ?></span> R$</td>
								<td><?= $romaneio[3]->nome_fantasia; ?></td>
								<td><?= $romaneio[4]->nome; ?></td>
								<td><?= $romaneio[5]->descricao; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
		$i = 0;
		foreach ($entrega as $row):
			++$i;
			if($i == 3):
	?>
	<div class="row">
	<?php endif; ?>
		<div class="col-md-4">
			<div class="card">
			<div class="waves-effect waves-block waves-light"> <!-- card-image  -->
				<a href="#">
					<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=<?= str_replace(" ", "+", $row[0]); ?>&zoom=18&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDQjgSKcQEHV6GY-_TL3vxbEwZ6rYG7LVA&format=png&visual_refresh=true&markers=icon:http://i.imgur.com/jRfjvrz.png%7Cshadow:true%7C<?= str_replace(" ", "+", $row[0]); ?>">
				</a>
			</div>
			<div class="card-content">
				<span class="card-title activator grey-text text-darken-4">
					<?= $row[0] ?> <i class="material-icons pull-right">more_vert</i>
				</span>
				<p>Entrega <?= $i; ?></p>
			</div>
			<div class="card-reveal">
				<span class="card-title grey-text text-darken-4">
					Cor e Boca<i class="material-icons pull-right">close</i>
				</span>
				<br>
				<p>CNPJ</p>
			</div>
			</div>
		</div>
	<?php if($i == 3): ?>
	</div>
	<?php
			endif;
		endforeach;
	?>
	<div class="row">
		<div class="col-md-12">
			<span class="btn btn-danger">
				Cadastrar
			</span>
		</div>
	</div>
	<?php } ?>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>