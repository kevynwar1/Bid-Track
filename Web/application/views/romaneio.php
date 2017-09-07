<script type="text/javascript">
$(document).ready(function() {
	<?php if(!is_null($this->session->flashdata('success'))) { ?>
		demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('success') ?>');
	<?php } else if(!is_null($this->session->flashdata('error'))) { ?>
		demo.showNotification('bottom', 'right', '<?= $this->session->flashdata('error') ?>');
	<?php } ?>
});
</script>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-text" data-background-color="blue-left">
						<h4 class="card-title" style="font-size: 18px">Listagem</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover" id="tables">
							<thead class="text-primary">
								<th class="th-desc">
									Romaneio
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Estabelecimento
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Transportador
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th class="th-desc">
									Motorista
									<i class="fa fa-sort" aria-hidden="true"></i>
								</th>
								<th>Carga</th>
								<th>Peso</th>
								<th></th>
							</thead>
							<tbody>
								<?= v($romaneio); ?>
								<!-- tr>
									<td>Dakota Rice</td>
									<td>
										<a href="<?= base_url().'romaneio/mapa?endereco=Rua Serinhaém, 90' ?>">
											Rua Serinhaém, 90
										</a>
									</td>
									<td>Águia de Ouro</td>
									<td>Neymar Jr.</td>
									<td>$36,738</td>
									<td>270 kg</td>
									<td>
										<a href="<?= base_url().'romaneio/visualizar' ?>">
											<button type="button" rel="tooltip" title="Visualizar" class="btn-pattern">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</a>
										<button type="button" rel="tooltip" title="Editar" class="btn-pattern">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" rel="tooltip" title="Excluir" class="btn-pattern">
											<i class="fa fa-times"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Minerva Hooper</td>
									<td>
										<a href="<?= base_url().'romaneio/mapa?endereco=Rua Nogueira de Souza, 88' ?>">
											Rua Nogueira de Souza, 88
										</a>
									</td>
									<td>Autônomo</td>
									<td>Ikaro Sales</td>
									<td>$23,789</td>
									<td>950 kg</td>
									<td>
										<a href="<?= base_url().'romaneio/visualizar' ?>">
											<button type="button" rel="tooltip" title="Visualizar" class="btn-pattern">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</a>
										<button type="button" rel="tooltip" title="Editar" class="btn-pattern">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" rel="tooltip" title="Excluir" class="btn-pattern">
											<i class="fa fa-times"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Sage Rodriguez</td>
									<td>
										<a href="<?= base_url().'romaneio/mapa?endereco=Av. Boa Viagem, 3854' ?>">
											Av. Boa Viagem, 3854
										</a>
									</td>
									<td>Autônomo</td>
									<td>Kevyn Herbet</td>
									<td>$56,142</td>
									<td>245 kg</td>
									<td>
										<a href="<?= base_url().'romaneio/visualizar' ?>">
											<button type="button" rel="tooltip" title="Visualizar" class="btn-pattern">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</a>
										<button type="button" rel="tooltip" title="Editar" class="btn-pattern">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" rel="tooltip" title="Excluir" class="btn-pattern">
											<i class="fa fa-times"></i>
										</button>
									</td>
								</tr -->
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2">
										<span class="desc f12">3 Romaneios Totais</span>
									</td>
									<td colspan="3" align="center"></td>
									<td colspan="2" align="right">
										<a href="<?= base_url().'romaneio/add' ?>">
											<button type="submit" class="btn btn-danger btn-simple btn-fill pull-right f12 upper">Adicionar</button>
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