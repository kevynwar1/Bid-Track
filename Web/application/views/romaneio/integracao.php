<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/materialize.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/input-field.css">

<div class="content">
	<div class="container-fluid">
	<?php if(!isset($romaneio)) { ?>
	<div class="row">
		<div class="col-md-8">
                <div class="nav-center">
                    <ul class="nav nav-pills nav-pills-danger nav-pills-icons" role="tablist">
                        <li class="active">
                            <a data-toggle="tab" href="#description-1" role="tab" aria-expanded="false">
                                <i class="material-icons">book</i> Integração
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#schedule-1" role="tab" aria-expanded="false">
                                <i class="material-icons">code</i> Exemplo
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content"><br>
                    <div class="tab-pane active" id="description-1">
                        <div class="card">
                            <div class="card-content">
                            	<h3>Documentação</h3>
                            	<h4>Romaneio</h4>
                                Na primeira linha, será especificado o Romaneio.
								Para isso, é necessário separar os itens do Romaneio utilizando o ponto e virgula ( ; ), fazendo na
								seguinte ordem que é demonstrada abaixo.<br><br>
								<code>Romaneio; CNPJ Estabelecimento; Valor; CNPJ Transportadora; CPF Motorista; Tipo Veículo</code><br><br>
								Sendo que o Valor, Transportadora e o Motorista são valores opcionais para o Romaneio, quando não quiser preenchê-los basta colocar o valor zero ( 0 ).<br><br>
								<h5>CNPJ e/ou CPF</h5>
                                É importante que a pontuação correta para o(s) campo(s) do CNPJ (##.###.###/####-##) e/ou CPF (###.###.###-##) dos registros, precisam estar corretos para que haja a validação dos dados.<br><small>Essas informações também são válidas para o CNPJ do(s) Destinatário(s) na(s) Entrega(s).</small><br><br>
								<hr>
								<h4>Entrega(s)</h4>
								Na segunda linha em diante, será especificado a(s) Entrega(s).
								Para isso, também será necessário a utilização do ponto e virgula ( ; ) para separar os registros, fazendo na
								seguinte ordem que é demonstrada abaixo.<br><br>
								<code>CNPJ Destinatário; Peso da Carga; Nota Fiscal</code><br><br>
								Sendo que a Nota Fiscal é um valor opcional para a(s) Entrega(s), quando não quiser preenchê-lo basta colocar o valor zero ( 0 ) e para realizar um novo registro de entrega, basta quebra a linha (Enter).<br><br>
                                <h5>Peso da Carga</h5>
                                O Valor do Peso da Carga tem como base de medida o Kg (Kilograma).<br><br>
                                <h5>Nota Fiscal</h5>
                                O Valor da Nota Fiscal (NFS) deve atender ao padrão da Secretaria de Estado da Fazenda (SEFAZ) e deve conter 7 caracteres. 
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="schedule-1">
                        <div class="card">
                            <div class="card-content">
                            	<h3>Exemplo</h3>
                                A Integração realizada em nosso sistema é compatível com os arquivo no formato <code>.txt</code>, segue abaixo um exemplo da integração baseada nas regras vista na aba anterior.<br>
                                <br><pre>0705; 81.002.942/0001-00; 15000; 82.244.921/0001-64; 338.331.600-98; Bitrem</pre>
                                <pre>10.822.821/0001-67; 450; 7901600<br>76.779.632/0001-67; 270; 1212120<br>62.651.272/0001-09; 11530; 7803321</pre>
                                <a href="https://www.dropbox.com/s/aza3e258urggj5v/bidtrack.txt?dl=0" target="_blank" class="btn btn-danger">
                                	Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<div class="col-md-4" align="center">
			<form action="<?= base_url().'romaneio/integrar' ?>" method="post" enctype="multipart/form-data">
				<div class="box">
					<input type="file" name="arquivo" accept=".txt" id="file-6" class="inputfile inputfile-5" style="display: none;" required />
					<label for="file-6">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg>
						</figure>
						<span></span>
					</label>
				</div>
				<button type="submit" class="btn btn-danger">
					Enviar
				</button>
			</form>
		</div>
	</div>
	<?php } else { ?>
	<form action="<?= base_url().'romaneio/cadastrar' ?>" method="post">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" data-background-color="blue-center">
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
								<td><?= $romaneio[1]->razao_social; ?> — <?= $romaneio[1]->bairro; ?></td>
								<td><span id="valor"><?= $romaneio[2] ?></span> R$</td>
								<td><?= ($romaneio[3] == NULL)? 'Estabelecimento' : $romaneio[3]->nome_fantasia; ?></td>
								<td><?= ($romaneio[4] == NULL)? 'Indefinido' : $romaneio[4]->nome; ?></td>
								<td><?= $romaneio[5]->descricao; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<input type="hidden" name="codigo" value="<?= $romaneio[0]; ?>">
			<input type="hidden" name="estabelecimento" value="<?= $romaneio[1]->codigo; ?>">
			<input type="hidden" name="valor" value="<?= $romaneio[2] ?>" id="preco">
			<input type="hidden" name="transportadora" value="<?= ($romaneio[3] == NULL)? '0':$romaneio[3]->codigo; ?>">
			<input type="hidden" name="motorista" value="<?= ($romaneio[4] == NULL)? '0':$romaneio[4]->codigo; ?>">
			<input type="hidden" name="tipoveiculo" value="<?= $romaneio[5]->codigo; ?>">
		</div>
	</div>

	<?php
		for($i = 0; $i < count($entrega); $i++):
			if($i == 3):
	?>
	<div class="row">
	<?php endif; ?>
		<div class="col-md-4">
			<div class="card">
				<div class="waves-effect waves-block waves-light"> <!-- card-image  -->
					<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=<?= str_replace(" ", "+", $entrega[$i][0]->logradouro).", ".str_replace(" ", "+", $entrega[$i][0]->cidade); ?>&zoom=18&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDQjgSKcQEHV6GY-_TL3vxbEwZ6rYG7LVA&format=png&visual_refresh=true&markers=icon:http://i.imgur.com/jRfjvrz.png%7Cshadow:true%7C<?= str_replace(" ", "+", $entrega[$i][0]->logradouro).", ".str_replace(" ", "+", $entrega[$i][0]->cidade); ?>">
				</div>
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">
						<?= $entrega[$i][0]->razao_social; ?> <i class="material-icons pull-right">more_vert</i>
					</span>
					<p>Entrega <?= $i+1; ?> — Peso da Carga <?= $entrega[$i][1]; ?> Kg.</p>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4">
						<?= $entrega[$i][0]->razao_social; ?> <i class="material-icons pull-right">close</i>
					</span>
					<br>
					<p>
						<?= $entrega[$i][0]->logradouro; ?> <?= $entrega[$i][0]->complemento; ?>, 
						<?= $entrega[$i][0]->numero; ?><br>
						<?= $entrega[$i][0]->bairro; ?> — 
						<?= $entrega[$i][0]->cidade; ?>,
						<?= $entrega[$i][0]->uf; ?><br>
						CEP <?= $entrega[$i][0]->cep; ?>
					</p><br>
					<table width="100%">
						<tr>
							<td>CNPJ/CPF</td>
							<td><?= $entrega[$i][0]->cnpj_cpf ?></td>
						</tr>
						<tr>
							<td>Peso da Carga</td>
							<td><?= $entrega[$i][1]; ?> Kg.</td>
						</tr>
						<tr>
							<td>NFS</td>
							<td><?= $entrega[$i][2]; ?></td>
						</tr>
					</table>
				</div>
				<!-- div class="card-action">
					<a href="#">Mapa</a>
				</div -->
			</div>
		</div>
		<input type="hidden" name="entrega<?= $i+1 ?>" value="entrega<?= $i+1 ?>">
		<input type="hidden" name="destinatario<?= $i+1 ?>" value="<?= trim($entrega[$i][0]->codigo); ?>|a">
		<input type="hidden" name="peso_carga<?= $i+1 ?>" value="<?= trim($entrega[$i][1]); ?>">
		<input type="hidden" name="medida<?= $i+1 ?>" value="kg">
		<input type="hidden" name="nota_fiscal<?= $i+1 ?>" value="<?= (trim($entrega[$i][2]) == FALSE)? '0':trim($entrega[$i][2]); ?>">
	<?php if($i == 3): ?>
	</div>
	<?php
			endif;
		endfor;
	?>
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-danger pull-right">
				Cadastrar
			</button>
			<a href="<?= base_url().'romaneio/integracao' ?>" class="btn btn-danger btn-simple pull-right">
				Voltar
			</a>
		</div>
	</div>
	</form>
	<?php } ?>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#valor').mask('000.000.000.000.000,00', {reverse: true});
		$('#preco').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>