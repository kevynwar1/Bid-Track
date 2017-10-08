<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="<?= ($this->session->userdata('perfil') == 'A')? 'col-lg-3' : 'col-lg-4'; ?> col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header" data-background-color="red">
						<i class="material-icons">local_shipping</i>
					</div>
					<div class="card-content">
						<p class="category">Entregas</p>
						<h3 class="title">42/50<small></small></h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> Atualizado há 8 horas
						</div>
					</div>
				</div>
			</div>
			<?php if($this->session->userdata('perfil') == 'A'): ?>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header" data-background-color="red">
						<i class="material-icons">attach_money</i>
					</div>
					<div class="card-content">
						<p class="category">Faturamento</p>
						<h3 class="title"><span id="valor"><?= $faturamento[0]->valor ?></span></h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> Mês de Outubro
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<div class="<?= ($this->session->userdata('perfil') == 'A')? 'col-lg-3' : 'col-lg-4'; ?> col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header" data-background-color="red">
						<i class="material-icons">info_outline</i>
					</div>
					<div class="card-content">
						<p class="category"><?= ($ocorrencia <= 1)? 'Ocorrência' : 'Ocorrências'; ?></p>
						<h3 class="title"><?= $ocorrencia; ?></h3>
					</div>
				</div>
			</div>
			<div class="<?= ($this->session->userdata('perfil') == 'A')? 'col-lg-3' : 'col-lg-4'; ?> col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header" data-background-color="blue">
						<i class="fa fa-twitter"></i>
					</div>
					<div class="card-content">
						<p class="category">Seguidores</p>
						<h3 class="title">247</h3>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header card-chart" data-background-color="blue-left">
						<div class="ct-chart" id="dailySalesChart"></div>
					</div>
					<div class="card-content">
						<h4 class="title">Entregas Diárias</h4>
						<p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> 55%  </span> Aumento nas entregas de hoje.</p>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">access_time</i> Atualizado há 4 minutos
						</div>
					</div>
				</div>
			</div>
			<?php if($this->session->userdata('perfil') == 'A'): ?>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header card-chart" data-background-color="blue-center">
							<div class="ct-chart" id="emailsSubscriptionChart"></div>
						</div>
						<div class="card-content">
							<h4 class="title">Faturamento Mensal</h4>
							<p class="category">Desempenho do Faturamento das entregas.</p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>