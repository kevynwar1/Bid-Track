<link rel="stylesheet" href="<?= base_url(); ?>assets/css/pop-up.css" />
<script type="text/javascript">
	function exclusao(codigo) {
		$('.cd-popup').addClass('is-visible');
		$('.btn-confirm-yes').on('click', function(event){
			event.preventDefault();
			window.location.replace("<?= base_url() ?>veiculo/excluir/"+codigo);
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
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> excluir este Veículo ?</p>
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-left">
						<h4 class="card-title" style="font-size: 18px">Listagem</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover">
							<thead class="text-primary">
								<th class="th-desc">
									Modelo 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Placa 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Motorista 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Chassi 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Tipo Veículo 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Capacidade 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th></th>
							</thead>
							<tbody>
								<?php
									if($veiculo != FALSE):
										foreach($veiculo as $row):
								?>
								<tr>
									<td><?= $row->modelo; ?></td>
									<td><?= $row->placa; ?></td>
									<td>
										<a href="<?= base_url().'motorista/editar/'.$row->motorista->codigo; ?>">
											<?= $row->motorista->nome; ?>
										</a>
									</td>
									<td><?= $row->chassi; ?></td>
									<td><?= $row->tipo_veiculo->descricao; ?></td>
									<td><?= $row->capacidade; ?> <span class="upper f10">Kg</span></td>
									<td align="left">
										<?php if($this->session->userdata('perfil') == 'A'): ?>
											<a href="<?= base_url().'veiculo/editar/'.$row->codigo; ?>">
												<button type="button" rel="tooltip" data-placement="left" title="Editar" class="btn-pattern">
													<i class="fa fa-edit"></i>
												</button>
											</a>
											<a href="<?= base_url().'veiculo/excluir/'.$row->codigo; ?>" onclick="return exclusao('<?= $row->codigo ?>')" rel="tooltip" data-placement="left" title="Excluir" class="btn-pattern">
												<i class="fa fa-times"></i>
											</a>
										<?php endif; ?>
									</td>
								</tr>
								<?php
										endforeach;
									else:
								?>
									<tr>
										<td colspan="6" class="desc f10 upper" style="font-size: 12px">
											Nenhum Veículo encontrado :(
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2">
										<span class="desc f12" style="padding: 15px;">
											<?php
												if($this->uri->segment(2) == 's') {
													echo count($veiculo).' Veículo(s) — '.str_replace("_", " ", $this->input->get('filtro')).': '.$this->input->get('procurar');
												} else {
													$count = ($total != FALSE)? $total : '0';
													echo $count.' Veículo(s) totais';
												}
											?>
										</span>
									</td>
									<td colspan="3" align="left">
										<?= ($this->uri->segment(2) == 's') ? "<small class='desc'><a href='".base_url()."veiculo'>voltar</a></small> " : $pagination; ?>
									</td>
									<td colspan="2">
										<?php if($this->session->userdata('perfil') == 'A'): ?>
											<a href="<?= base_url().'veiculo/add' ?>">
												<button type="submit" class="btn btn-simple btn-danger btn-fill pull-right f12 upper">Adicionar</button>
											</a>
										<?php endif; ?>
										<a href="<?= base_url().'tipoveiculo' ?>">
											<button type="submit" class="btn btn-simple btn-danger btn-fill pull-right f12 upper">Tipo Veículo</button>
										</a>
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