<link href="<?= base_url(); ?>assets/css/pop-up.css" rel="stylesheet" />
<script type="text/javascript">
	function exclusao(codigo) {
		$('.excluir').addClass('is-visible');
		$('.btn-confirm-yes').on('click', function(event){
			event.preventDefault();
			window.location.replace("<?= base_url() ?>usuario/excluir/"+codigo);
			return true;
		});
		$('.btn-confirm-no').on('click', function(event){
			event.preventDefault();
			$('.excluir').removeClass('is-visible');
			return false;
		});
		$('.excluir').on('click', function(event){
			if($(event.target).is('.cd-popup-close') || $(event.target).is('.excluir')) {
				event.preventDefault();
				$(this).removeClass('is-visible');
			}
		});
		return false;
	}

	function reativar(codigo) {
		$('.reativar').addClass('is-visible');
		$('.btn-confirm-yes').on('click', function(event){
			event.preventDefault();
			window.location.replace("<?= base_url() ?>usuario/reativar/"+codigo);
			return true;
		});
		$('.btn-confirm-no').on('click', function(event){
			event.preventDefault();
			$('.reativar').removeClass('is-visible');
			return false;
		});
		$('.reativar').on('click', function(event){
			if($(event.target).is('.cd-popup-close') || $(event.target).is('.reativar')) {
				event.preventDefault();
				$(this).removeClass('is-visible');
			}
		});
		return false;
	}

	function senha(card_senha, codigo) {
		$(card_senha).addClass('is-visible');
		
		$('.btn-confirm-no').on('click', function(event){
			event.preventDefault();
			$(card_senha).removeClass('is-visible');
			return false;
		});

		$(card_senha).on('click', function(event){
			if($(event.target).is('.cd-popup-close') || $(event.target).is(card_senha)) {
				event.preventDefault();
				$(this).removeClass('is-visible');
			}
		});
		return false;
	}
</script>

<!-- Card Excluir -->
<div class="cd-popup excluir" role="alert">
	<div class="cd-popup-container">
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> desativar este Usuário ?</p>
		<ul class="cd-buttons">
			<li><a href="#" class="btn-confirm-yes">Sim</a></li>
			<li><a href="#" class="btn-confirm-no">Não</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>

<!-- Card Reativar -->
<div class="cd-popup reativar" role="alert">
	<div class="cd-popup-container">
		<p><?= $this->session->userdata('nome') ?>, tem certeza que quer<br> reativar este Usuário ?</p>
		<ul class="cd-buttons">
			<li><a href="#" class="btn-confirm-yes">Sim</a></li>
			<li><a href="#" class="btn-confirm-no">Não</a></li>
		</ul>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>

<!-- Card Senha - Usuário -->
<?php if(isset($usuario)): ?>
<div class="cd-popup senha" role="alert">
	<div class="cd-popup-container">
		<form action="<?= base_url().'usuario/senha'; ?>" method="post">
			<input type="hidden" name="codigo" value="<?= $usuario[0]->codigo; ?>">
			<div class="row">
				<div class="col-md-12" style="padding: 50px 0 10px 0">
					Alterar Senha de <?= $usuario[0]->nome ?> (<?= ($usuario[0]->perfil == 'A') ? 'Administrador' : 'Funcionário'; ?>)<br>
					Digite a nova senha abaixo:
				</div>
			</div>
			<div class="row" style="padding: 0 30px 25px 30px">
				<div class="col-md-6">
					<div class="form-group label-floating" align="left">
						<label class="control-label">Senha</label>
						<input type="password" name="senha" id="senha" class="form-control" ng-model="senha" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group label-floating" align="left">
						<label class="control-label pull-left">Repetir Senha</label>
						<input type="password" name="senha" id="senha" class="form-control" ng-model="rep_senha" autocomplete="off">
					</div>
				</div>
			</div>
			<ul class="cd-buttons">
				<li style="margin: 0">
					<a href="#">
						<button type="submit" class="btn btn-danger" ng-disabled="!senha || !rep_senha || senha != rep_senha" style="margin-left: -1px !important; margin-top: 0 !important; width: 99.5% !important; height: 100% !important; border-radius: 0 0 0 5px !important; font-size: 14px !important">
							Alterar <!-- #f44336 -->
						</button>
					</a>
				</li>
				<li><a href="#" class="btn-confirm-no">Cancelar</a></li>
			</ul>
		</form>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>
<?php endif; ?>

<!-- Card Senha - Usuário Select -->
<?php if(isset($usuario_select)): ?>
<div class="cd-popup senha_select" role="alert">
	<div class="cd-popup-container">
		<form action="<?= base_url().'usuario/senha'; ?>" method="post">
			<input type="hidden" name="codigo" value="<?= $usuario_select[0]->codigo; ?>">
			<div class="row">
				<div class="col-md-12" style="padding: 50px 0 10px 0">
					Alterar Senha de <?= $usuario_select[0]->nome ?> (<?= ($usuario_select[0]->perfil == 'A') ? 'Administrador' : 'Funcionário'; ?>)<br>
					Digite a nova senha abaixo:
				</div>
			</div>
			<div class="row" style="padding: 0 30px 25px 30px">
				<div class="col-md-6">
					<div class="form-group label-floating" align="left">
						<label class="control-label">Senha</label>
						<input type="password" name="senha" id="senha" class="form-control" ng-model="senha" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group label-floating" align="left">
						<label class="control-label pull-left">Repetir Senha</label>
						<input type="password" name="senha" id="senha" class="form-control" ng-model="rep_senha" autocomplete="off">
					</div>
				</div>
			</div>
			<ul class="cd-buttons">
				<li style="margin: 0">
					<a href="#">
						<button type="submit" class="btn btn-danger" ng-disabled="!senha || !rep_senha || senha != rep_senha" style="margin-left: -1px !important; margin-top: 0 !important; width: 99.5% !important; height: 100% !important; border-radius: 0 0 0 5px !important; font-size: 14px !important">
							Alterar <!-- #f44336 -->
						</button>
					</a>
				</li>
				<li><a href="#" class="btn-confirm-no">Cancelar</a></li>
			</ul>
		</form>
		<a href="#" class="cd-popup-close img-replace"></a>
	</div>
</div>
<?php endif; ?>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card-content">
					<ul class="nav nav-pills nav-pills-danger">
						<li class="<?= (!is_null($this->session->flashdata('usuario'))) ? '' : 'active' ?>">
							<a data-toggle="tab" href="#eu" aria-expanded="false" style="font-weight: normal;">
								<?php
									$nome = explode(" ", $this->session->userdata('nome'));
									echo (count($nome) >= 2)? $nome[0]." ".end($nome) : $nome[0];
								?>
							</a>
						</li>
						<?php if($this->session->userdata('perfil') == 'A'): ?>
							<!-- li class="">
								<a data-toggle="tab" href="#empresa" aria-expanded="false">Empresa</a>
							</li -->
							<li class="<?= (!is_null($this->session->flashdata('usuario'))) ? 'active' : '' ?>">
								<a data-toggle="tab" href="#info" aria-expanded="false">Usuários</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane <?= (!is_null($this->session->flashdata('usuario'))) ? '' : 'active' ?>" id="eu">
						<div class="row">
							<div class="col-md-4">
                                <div class="card card-user" style="margin-top: 100px">
                                    <div class="image">
                                        <!-- img src="http://www.cafecomfilme.com.br/media/k2/items/cache/941dc0befb1d3e5f664ec4b3cde04e0b_Generic.jpg" style="height: 150px; border-radius: 4px 4px 0 0;" -->
                                    </div>
                                    <div class="content">
                                        <div class="author" align="center">
                                        	<?php if(!is_null($this->session->userdata('foto'))): ?>
												<img class="avatar border-gray" src="<?= base_url().'assets/img/foto/'.$this->session->userdata('foto'); ?>" style="border: 5px solid rgba(0,0,0, 0.1); width: 150px; height: 150px; margin-top: -77px;">
											<?php else: ?>
                                            	<img class="avatar border-gray" src="<?= base_url().'assets/img/header_user.png' ?>" style="border: 5px solid rgba(0,0,0, 0.1); width: 150px; height: 150px; margin-top: -77px;">
											<?php endif; ?>
                                        </div>
                                        <div class="row">
                                        	<div class="col-md-12" style="padding: 15px 0 30px 0;" align="center">
                                        		<span class="title" style="font-size: 25px">
                                        			<?= (count($nome) >= 2)? $nome[0]." ".end($nome) : $nome[0]; ?>
                                        		</span><br>
                                        		<?= ($this->session->userdata('perfil') == 'A') ? 'Administrador' : 'Funcionário'; ?>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                            	<div class="card">
                        			<div class="card-header" data-background-color="blue-left">
										<h4 class="title"><?= (count($nome) >= 2)? $nome[0]." ".end($nome) : $nome[0]; ?></h4>
										<p class="category">Informações da sua Conta</p>
									</div>
	                            	<div class="card-content">
	                            		<form action="<?= base_url().'usuario/editar' ?>" method="post">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group label-floating">
													<label class="control-label">Nome</label>
													<input type="text" name="nome" id="nome" value="<?= $usuario[0]->nome; ?>" class="form-control" autocomplete="off" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group label-floating">
													<label class="control-label">E-mail</label>
													<input type="email" name="email" id="email" value="<?= $usuario[0]->email; ?>" class="form-control" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group label-floating">
													<label class="control-label">Telefone</label>
													<input type="text" name="telefone" id="telefone" value="<?= $usuario[0]->telefone; ?>" class="form-control" autocomplete="off">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group label-floating">
													<label class="control-label">CEP</label>
													<input type="text" name="cep" id="cep" value="<?= $usuario[0]->cep ?>" class="form-control" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="row" id="endereco_usuario">
											<div class="col-md-4 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Endereço</label>
													<input type="text" name="logradouro" id="logradouro" value="<?= $usuario[0]->logradouro ?>" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç,.-/\s]+$" autocomplete="off">
												</div>
											</div>
											<div class="col-md-2 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Número</label>
													<input type="text" name="numero" id="numero" value="<?= $usuario[0]->numero ?>" class="form-control" pattern="[0-9]+$" autocomplete="off">
												</div>
											</div>
											<div class="col-md-1 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Compl.</label>
													<input type="text" name="complemento" id="complemento" value="<?= $usuario[0]->complemento ?>" class="form-control" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç0-9./\s]+$" autocomplete="off">
												</div>
											</div>
											<div class="col-md-2 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Bairro</label>
													<input type="text" name="bairro" id="bairro" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" value="<?= $usuario[0]->bairro ?>" class="form-control" autocomplete="off">
												</div>
											</div>
											<div class="col-md-2 lm15">
												<div class="form-group label-floating">
													<label class="control-label">Cidade</label>
													<input type="text" name="cidade" id="cidade" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" value="<?= $usuario[0]->cidade ?>" class="form-control" autocomplete="off">
												</div>
											</div>
											<div class="col-md-1 lm15">
												<div class="form-group label-floating">
													<label class="control-label">UF</label>
													<?php $uf = $usuario[0]->uf; ?>
													<select class="form-control" id="uf">
														<option value="" class="option_none" disabled selected></option>
														<option value="AC" <?= ($uf == 'AC')? 'selected':''; ?>>AC</option>
														<option value="AL" <?= ($uf == 'AL')? 'selected':''; ?>>AL</option>
														<option value="AP" <?= ($uf == 'AP')? 'selected':''; ?>>AP</option>
														<option value="AM" <?= ($uf == 'AM')? 'selected':''; ?>>AM</option>
														<option value="BA" <?= ($uf == 'BA')? 'selected':''; ?>>BA</option>
														<option value="CE" <?= ($uf == 'CE')? 'selected':''; ?>>CE</option>
														<option value="DF" <?= ($uf == 'DF')? 'selected':''; ?>>DF</option>
														<option value="ES" <?= ($uf == 'ES')? 'selected':''; ?>>ES</option>
														<option value="GO" <?= ($uf == 'GO')? 'selected':''; ?>>GO</option>
														<option value="MA" <?= ($uf == 'MA')? 'selected':''; ?>>MA</option>
														<option value="MT" <?= ($uf == 'MT')? 'selected':''; ?>>MT</option>
														<option value="MS" <?= ($uf == 'MS')? 'selected':''; ?>>MS</option>
														<option value="MG" <?= ($uf == 'MG')? 'selected':''; ?>>MG</option>
														<option value="PA" <?= ($uf == 'PA')? 'selected':''; ?>>PA</option>
														<option value="PB" <?= ($uf == 'PB')? 'selected':''; ?>>PB</option>
														<option value="PR" <?= ($uf == 'PR')? 'selected':''; ?>>PR</option>
														<option value="PE" <?= ($uf == 'PE')? 'selected':''; ?>>PE</option>
														<option value="PI" <?= ($uf == 'PI')? 'selected':''; ?>>PI</option>
														<option value="RJ" <?= ($uf == 'RJ')? 'selected':''; ?>>RJ</option>
														<option value="RN" <?= ($uf == 'RN')? 'selected':''; ?>>RN</option>
														<option value="RS" <?= ($uf == 'RS')? 'selected':''; ?>>RS</option>
														<option value="RO" <?= ($uf == 'RO')? 'selected':''; ?>>RO</option>
														<option value="RR" <?= ($uf == 'RR')? 'selected':''; ?>>RR</option>
														<option value="SC" <?= ($uf == 'SC')? 'selected':''; ?>>SC</option>
														<option value="SP" <?= ($uf == 'SP')? 'selected':''; ?>>SP</option>
														<option value="SE" <?= ($uf == 'SE')? 'selected':''; ?>>SE</option>
														<option value="TO" <?= ($uf == 'TO')? 'selected':''; ?>>TO</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<a href="#" onclick="return senha('.senha', '<?= $usuario[0]->codigo; ?>')" class="btn btn-danger btn-simple" id="alterar-senha">
													Alterar Senha
												</a>
											</div>
											<div class="col-md-6">
												<button type="submit" name="editar" class="btn btn-danger btn-fill pull-right f12 upper">
													Salvar
												</button>
											</div>
										</div>
										</form>
									</div>
								</div>
                            </div>
						</div>
					</div>
					<?php if($this->session->userdata('perfil') == 'A'): ?>
					<!-- div class="tab-pane" id="empresa">
						<div class="row">
							Empresa
						</div>
					</div -->
					<div class="tab-pane <?= (!is_null($this->session->flashdata('usuario')) == 'editar') ? 'active' : '' ?>" id="info">
						<div class="row" style="margin-top: 20px;">


							<div class="col-md-6">
								<div class="card">
									<div class="card-header card-header-tabs" data-background-color="blue-left">
										<div class="nav-tabs-navigation">
											<div class="nav-tabs-wrapper">
												<ul class="nav nav-tabs" data-tabs="tabs" style="background: none">
													<li class="active">
														<a data-toggle="tab" href="#ativos" aria-expanded="true">
															Ativos
															<div class="ripple-container"></div>
														</a>
													</li>
													<li class="">
														<a data-toggle="tab" href="#excluidos" aria-expanded="true">
															Desativados
															<div class="ripple-container"></div>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>

									<!-- ATIVOS -->
									<div class="card-content">
										<div class="tab-content">
											<div class="tab-pane active" id="ativos">
												<table class="table table-striped table-hover" id="tables">
													<thead class="text-primary">
														<th class="th-desc">
															Nome
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th class="th-desc">
															E-mail
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th class="th-desc">
															Perfil
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th></th>
													</thead>
													<tbody>
														<?php
															if($ativos != FALSE) {
																foreach($ativos as $row):
														?>
														<tr>
															<td>
																<?php
																	$nome = explode(" ", $row->nome);
																	echo (count($nome) >= 2)?$nome[0]." ".end($nome):$nome[0];
																?>
															</td>
															<td><?= $row->email ?></td>
															<td><?= ($row->perfil == 'A')? 'Administrador' : 'Funcionário'; ?></td>
															<td>
																<a href="<?= base_url().'usuario/editar/'.$row->codigo ?>">
																	<button type="button" rel="tooltip" data-placement="left" title="Editar" class="btn-pattern">
																		<i class="fa fa-edit"></i>
																	</button>
																</a>

																<?php if($row->perfil != 'A'): ?>
																	<button type="button" rel="tooltip" data-placement="left" title="Desativar" class="btn-pattern" onclick="return exclusao('<?= $row->codigo ?>')">
																		<i class="fa fa-times"></i>
																	</button>
																<?php endif; ?>
															</td>
														</tr>
														<?php
																endforeach;
															} else {
														?>
															<tr>
																<td class="f12 upper gray" colspan="4" align="center">
																	Nenhum Usuário :(
																</td>
															</tr>
														<?php } ?>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="4">
																<span class="desc f12">
																	<?= ($ativos != FALSE)? count($ativos) : '0' ?> Usuários ativos.
																</span>
															</td>
														</tr>
													</tfoot>
												</table>
											</div>

											<!-- EXCLUÍDOS -->
											<div class="tab-pane" id="excluidos">
												<table class="table table-striped table-hover" id="tables">
													<thead class="text-primary">
														<th class="th-desc">
															Nome
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th class="th-desc">
															E-mail
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th class="th-desc">
															Perfil
															<span style="opacity: 0.7;">
																<i class="fa fa-sort" aria-hidden="true"></i>
															</span>
														</th>
														<th></th>
													</thead>
													<tbody>
														<?php
															if($excluidos != FALSE) {
																foreach($excluidos as $row):
														?>
														<tr>
															<td>
																<?php
																	$nome = explode(" ", $row->nome);
																	echo (count($nome) >= 2)?$nome[0]." ".end($nome):$nome[0];
																?>
															</td>
															<td><?= $row->email ?></td>
															<td><?= ($row->perfil == 'A')? 'Administrador' : 'Funcionário'; ?></td>
															<td>
																<button type="button" rel="tooltip" data-placement="left" title="Reativar" class="btn-pattern" onclick="return reativar('<?= $row->codigo ?>')">
																	<i class="fa fa-reply"></i>
																</button>
															</td>
														</tr>
														<?php
																endforeach;
															} else {
														?>
															<tr>
																<td class="f12 upper gray" colspan="4" align="center">
																	Nenhum Usuário excluído :(
																</td>
															</tr>
														<?php } ?>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="3">
																<span class="desc f12">
																	<?= ($excluidos != FALSE)? count($excluidos) : '0' ?> Usuários desativados.
																</span>
															</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- EDITAR -->
							<?php if($this->uri->segment(2) == 'editar'): ?>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header" data-background-color="blue-center">
											<h4 class="title">Usuários</h4>
											<p class="category">Editar um Usuário</p>
										</div>
										<form action="<?= base_url().'usuario/editar' ?>" method="post" autocomplete="off">
										<input type="hidden" name="codigo" value="<?= $usuario_select[0]->codigo; ?>">
										<div class="card-content">
											<div class="row">
												<div class="col-md-12 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Nome</label>
														<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" name="nome" id="nome"  class="form-control" value="<?= $usuario_select[0]->nome ?>" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">E-mail</label>
														<input type="email" name="email" value="<?= $usuario_select[0]->email ?>" class="form-control" value="" autocomplete="off">
													</div>
												</div>
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Perfil</label>
														<select class="form-control" name="perfil">
															<option value="" class="option_none" disabled selected></option>
															<option value="A" class="option" <?= ($usuario_select[0]->perfil == 'A')? 'selected' : ''; ?>>Administrador</option>
															<option value="F" class="option" <?= ($usuario_select[0]->perfil == 'F')? 'selected' : ''; ?>>Funcionário</option>
														</select>
													</div>
												</div>
											</div>
											<!-- div class="row">
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Nova Senha</label>
														<input type="password" name="email" class="form-control" value="" autocomplete="off">
													</div>
												</div>
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Repetir Senha</label>
														<input type="password" name="email" class="form-control" value="" autocomplete="off">
													</div>
												</div>
											</div -->
											<div class="row">
												<!-- div class="col-md-6">
													<a href="<?= base_url().'usuario' ?>" class="btn btn-danger btn-simple">
														Voltar
													</a>
												</div -->
												<div class="col-md-12">
													<button type="submit" name="editar_tab" class="btn btn-danger btn-fill pull-right f12 upper">
														Salvar
													</button>
													<a href="#" onclick="return senha('.senha_select', '<?= $usuario_select[0]->codigo; ?>')" class="btn btn-danger btn-simple" id="alterar-senha">
														Alterar Senha
													</a>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							<?php else: ?>
								<!-- CADASTRAR -->
								<div class="col-md-6">
									<div class="card">
										<div class="card-header" data-background-color="blue-center">
											<h4 class="title">Usuários</h4>
											<p class="category">Cadastre um Usuário</p>
										</div>
										<form action="<?= base_url().'usuario/cadastrar' ?>" method="post" autocomplete="off">
										<div class="card-content">
											<div class="row">
												<div class="col-md-12 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Nome</label>
														<input type="text" pattern="[a-zA-ZÁÉÍÓÚáéíóúÃÕãõÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÇç/\s]+$" name="nome" id="nome"  class="form-control" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 lm15">
													<div class="form-group label-floating">
														<label class="control-label">E-mail</label>
														<input type="email" name="email" class="form-control email_cad" value="" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Senha</label>
														<input type="password" name="senha" class="form-control" value="" autocomplete="off">
													</div>
												</div>
												<div class="col-md-6 lm15">
													<div class="form-group label-floating">
														<label class="control-label">Perfil</label>
														<select class="form-control" name="perfil">
															<option value="" class="option_none" disabled selected></option>
															<option value="A" class="option">Administrador</option>
															<option value="F" class="option">Funcionário</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-danger btn-fill pull-right f12 upper">
														Cadastrar
													</button>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cep').mask('00000-000', {reverse: true});
		$('#telefone').mask('00 00000-0000', {reverse: true});

		$('#cep').blur(function() {
			$.ajax({
				url: '<?= base_url() ?>home/cep',
				type: 'POST',
				data: 'cep='+$('#cep').val(),
				dataType: 'json',
				success: function(data) {
					if(data.sucesso == 1) {
						$('#logradouro').val(data.rua);
						$('#bairro').val(data.bairro);
						$('#cidade').val(data.cidade);
						$("#uf option:contains("+data.uf+")").attr('selected', true);
						$('#numero').focus();
					}
				}
			});

			return false;
		});

		$('.email_cad').blur(function(){
			var email = $('.email_cad').val();
			$.ajax({
				url: '<?= base_url() ?>home/verificar_email',
				type: 'POST',
				data: 'email='+email,
				dataType: 'json',
				success: function(data) {
					if(data == false) {
						demo.showNotification('bottom', 'right', 'E-mail já cadastrado, por favor tente outro.');
						$('.email_cad').val("");
						$('.email_cad').focus();
					}
				}
			});

			return true;
		});
	});
</script>