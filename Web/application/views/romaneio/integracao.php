<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/input-field.css" />

<div class="content">
	<div class="container-fluid">
	<?php if(!isset($romaneio)) { ?>
	<div class="row">
		<div class="col-md-12" align="center">
			<form action="<?= base_url().'romaneio/integrar' ?>" method="post" enctype="multipart/form-data" autocomplete="off">
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
				<button type="submit" class="btn btn-primary">
					Enviar
				</button>
			</form>
		</div>
	</div>
	<?php } else { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" data-background-color="red">
					<h4 class="card-title">Romaneio</h4>
				</div>
				<div class="card-content table-responsive">
					<table class="table table-hover">
						<thead class="text-primary">
							<th>Transportadora</th>
							<th>Motorista</th>
							<th>Ofertar</th>
							<th>Integrado</th>
							<th>Situação</th>
						</thead>
						<tbody>
							<tr>
								<td><?= $romaneio[0]; ?></td>
								<td><?= $romaneio[1]; ?></td>
								<td><?= ($romaneio[2] == 1) ? 'Sim' : 'Não' ; ?></td>
								<td><?= ($romaneio[3] == 1) ? 'Sim' : 'Não' ; ?></td>
								<td><?= ($romaneio[4] == 1) ? 'Ativo' : 'Não Ativo' ; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" data-background-color="red">
					<h4 class="card-title">Entregas</h4>
				</div>
				<div class="card-content table-responsive">
					<table class="table table-hover">
						<thead class="text-primary">
							<th>Destinatário</th>
							<th>Peso</th>
							<th>Nota Fiscal</th>
							<th>Situação</th>
						</thead>
						<tbody>
							<?php foreach ($entrega as $row): ?>
							<tr>
								<td>
									<a href="<?= base_url().'romaneio/mapa?endereco='.$row[0] ?>">
										<?= $row[0]; ?>
									</a>
								</td>
								<td><?= $row[1]; ?></td>
								<td><?= $row[2]; ?></td>
								<td><?= ($row[3] == 1) ? 'Ativo' : 'Não Ativo' ; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header" data-background-color="red">
					<h4 class="card-title">SQL</h4>
				</div>
				<div class="card-content">
					<pre>INSERT INTO `pessoa`(`nome`, `cpf`, `email`)<br><?php foreach($api as $row): ?>VALUES (`<?= $row[0] ?>`, `<?= trim($row[1]) ?>`, `<?= trim($row[2]) ?>`), <br><?php endforeach; ?>
					</pre>
				</div>
			</div>
		</div>
	</div -->
	<?php } ?>
	</div>
</div>