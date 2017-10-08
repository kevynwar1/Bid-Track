<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.css">

<div class="content">
	<div class="container-fluid">
		<?php
			$i = 0;
			foreach($transportadora as $row):
				++$i;
				if($i == 3):
		?>
			<div class="row">
		<?php endif; ?>
				<div class="col-md-4">
					<div class="card">
						<div class="waves-effect waves-block waves-light"> <!-- card-image  -->
							<a href="<?= base_url().'home/mapa?endereco='.$row->logradouro.','.$row->numero ?>">
								<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=<?= str_replace(" ", "+", $row->logradouro).", ".str_replace(" ", "+", $row->cidade); ?>&zoom=18&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDQjgSKcQEHV6GY-_TL3vxbEwZ6rYG7LVA&format=png&visual_refresh=true&markers=icon:http://i.imgur.com/jRfjvrz.png%7Cshadow:true%7C<?= str_replace(" ", "+", $row->logradouro).", ".str_replace(" ", "+", $row->cidade); ?>" alt="<?= $row->logradouro; ?>, <?= $row->numero ?>">
							</a>
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4">
								<?= $row->nome_fantasia; ?> <i class="material-icons pull-right">more_vert</i>
							</span>
							<p>
								<?php
									$romaneios = $this->Transportadora_model->romaneios($row->codigo);
									if($romaneios == 0) {
										echo "Nenhum Romaneio vinculado";
									} else if($romaneios == 1) {
										echo $romaneios." Romaneio vinculado";
									} else {
										echo $romaneios." Romaneios vinculados";
									}
								?>
							</p>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4">
								<?= $row->nome_fantasia; ?><i class="material-icons pull-right">close</i>
							</span>
							<br>
							<p>CNPJ <?= $row->cnpj; ?></p>
							<p>
								<?= $row->logradouro; ?> <?= $row->complemento; ?>, 
								<?= $row->numero; ?><br>
								<?= $row->bairro; ?> — 
								<?= $row->cidade; ?>,
								<?= $row->uf; ?><br>
								CEP <?= $row->cep; ?>
							</p>
							<?php if($this->session->userdata('perfil') == 'A'): ?>
							<br>
							<div class="line">&nbsp;</div>
								<?php if($romaneios == 0): ?>
									<a href="<?= base_url().'transportadora/excluir/'.$row->codigo; ?>">
										<span class="btn btn-danger btn-round btn-fab btn-entrega btn-fab-mini" rel="tooltip" title="Excluir" data-placement="right">
											<i class="material-icons" style="font-size: 25px;">delete</i>
											<div class="ripple-container"></div>
										</span>
									</a>
								<?php endif; ?>
								<a href="<?= base_url().'transportadora/editar/'.$row->codigo; ?>">
									<span class="btn btn-danger btn-simple f12 upper">Editar</span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
		<?php if($i == 3): ?>
			</div>
		<?php
				endif;
			endforeach;
		?>
	</div>
</div>