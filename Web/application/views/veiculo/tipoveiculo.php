<link rel="stylesheet" href="<?= base_url(); ?>assets/css/pop-up.css" />
<script type="text/javascript">
	function exclusao(codigo) {
		$('.cd-popup').addClass('is-visible');
		$('.btn-confirm-yes').on('click', function(event){
			event.preventDefault();
			window.location.replace("<?= base_url() ?>tipoveiculo/excluir/"+codigo);
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
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> excluir este Tipo de Veículo ?</p>
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
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" data-background-color="blue-left">
						<h4 class="card-title" style="font-size: 18px">Listagem</h4>
					</div>
					<div class="card-content">
						<table class="table table-hover">
							<thead class="text-primary">
								<th class="th-desc">
									Tipo de Veículo 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th class="th-desc">
									Peso Suportado 
									<span style="opacity: 0.7;">
										<i class="fa fa-sort" aria-hidden="true"></i>
									</span>
								</th>
								<th></th>
							</thead>
							<tbody>
								<?php
									if($tipo_veiculo != FALSE):
										foreach($tipo_veiculo as $row):
								?>
									<tr>
										<td><?= $row->descricao; ?></td>
										<td>
											<?= $row->peso; ?> 
											<span class="upper f10">Kg</span>
										</td>
										<td>
											<?php if($this->session->userdata('perfil') == 'A'): ?>
												<a href="<?= base_url().'tipoveiculo/editar/'.$row->codigo; ?>">
													<button type="button" rel="tooltip" data-placement="left" title="Editar" class="btn-pattern">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												<a href="<?= base_url().'tipoveiculo/excluir/'.$row->codigo; ?>" onclick="return exclusao('<?= $row->codigo ?>')" rel="tooltip" data-placement="left" title="Excluir" class="btn-pattern">
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
										<td colspan="3" class="desc f10 upper" style="font-size: 12px">
											Nenhum Tipo de Veículo encontrado :(
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td>
										<span class="desc f12">
											<?php
												if($this->uri->segment(2) == 's') {
													echo count($tipo_veiculo).' Tipo(s) de Veículo(s) — '.$this->input->get('filtro').': '.$this->input->get('procurar');
												} else {
													$count = ($total != FALSE)? $total : '0';
													echo $count.' Tipo(s) de Veículo(s) totais';
												}
											?>
										</span>
									</td>
									<td colspan="2" align="right">
										<?= ($this->uri->segment(2) == 's') ? "<small class='desc'><a href='".base_url()."tipoveiculo'>voltar</a></small> " : $pagination; ?>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>

			<?php if($this->uri->segment(2) == 'editar'): ?>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Tipo de Veículo</h4>
						<p class="category">Editar um Tipo de Veículo</p>
					</div>
					<div class="card-content">
						<form action="<?= base_url().'tipoveiculo/editar' ?>" method="post" autocomplete="off">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group label-floating">
									<label class="control-label">Descrição</label>
									<input type="hidden" name="codigo" value="<?= $tipo_edt[0]->codigo; ?>">
									<input type="text" pattern="[a-zA-Z0-9ÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" name="descricao" id="descricao" value="<?= $tipo_edt[0]->descricao; ?>" class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Peso</label>
									<input type="number" name="peso" id="peso" value="<?= $tipo_edt[0]->peso; ?>" class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="javascript:window.history.go(-1)" class="btn btn-danger btn-simple">Voltar</a>
							</div>
							<div class="col-md-6">
								<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" name="editar">
									Salvar
								</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
			<?php else: ?>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Tipo de Veículo</h4>
						<p class="category">Cadastre um Tipo de Veículo</p>
					</div>
					<div class="card-content">
						<form action="<?= base_url().'tipoveiculo/cadastrar' ?>" method="post" autocomplete="off">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group label-floating">
									<label class="control-label">Descrição</label>
									<input type="text" pattern="[a-zA-Z0-9ÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" name="descricao" id="descricao" ng-model="descricao" class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 lm15">
								<div class="form-group label-floating">
									<label class="control-label">Peso</label>
									<input type="number" name="peso" id="peso" ng-model="peso" class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" ng-disabled="!descricao || !peso">
									Cadastrar
								</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>