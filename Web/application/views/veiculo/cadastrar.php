<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="blue-center">
						<h4 class="title">Veículo</h4>
						<p class="category">Cadastre o Veículo {{modelo}}</p>
					</div>
					<div class="card-content">
						<form action="<?= base_url()."veiculo/cadastrar" ?>" method="post">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label">Motorista</label>
									<select class="form-control motorista" name="motorista" ng-model="motorista">
										<option value="" class="option_none" disabled selected></option>
										<option class="option-undefined undefined" style="display: none" value="0">Indefinido</option>
										<?php
											foreach($motorista as $row):
												$nome = explode(" ", $row->nome);
										?>
											<option class="option" value="<?= $row->codigo ?>">
												<?= (count($nome) > 1)? $nome[0]." ".end($nome) : $nome[0]; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label">Modelo</label>
									<input type="text" pattern="[a-zA-Z0-9ÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç.,-/\s]+$" class="form-control codigo" name="modelo" ng-model="modelo" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label">Tipo do Veículo</label>
									<select class="form-control" name="tipoveiculo" ng-model="tipo_veiculo">
										<option value="" class="option_none" disabled selected></option>
										<?php foreach($tipoveiculo as $row): ?>
											<option class="option" value="<?= $row->codigo ?>">
												<?= $row->descricao; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Placa</label>
									<input type="text" pattern="[a-zA-Z]{3}-\d{4}" class="form-control upper" name="placa" id="placa" ng-model="placa" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label">Chassi</label>
									<input type="text" maxlength="17" minlength="17" class="form-control upper" name="chassi" id="chassi" ng-model="chassi" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Próprio</label>
									<select class="form-control" name="proprio" ng-model="proprio">
										<option value="" class="option_none" disabled selected></option>
										<option value="S">Sim</option>
										<option value="N">Não</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Capacidade</label>
									<input type="number" class="form-control upper" name="capacidade" id="capacidade" ng-model="capacidade" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label">ANTT</label>
									<input type="text" pattern="[a-zA-Z]{3}-\d{8}" class="form-control upper" name="antt" id="antt" ng-model="antt" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="<?= base_url('veiculo'); ?>" class="btn btn-danger btn-simple">
									Voltar
								</a>
							</div>
							<div class="col-md-6">
								<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper" ng-disabled="!motorista || !tipo_veiculo || !modelo || !placa || !chassi || !capacidade">Cadastrar</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#placa').mask('AAA-0000');
		$('#antt').mask('AAA-00000000');
	});
</script>