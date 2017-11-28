<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Romaneio extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Romaneio_basic');
		$this->load->model('model/Romaneio_model');

		$this->load->model('basic/Entrega_basic');
		$this->load->model('model/Entrega_model');
		
		date_default_timezone_set('America/Sao_Paulo');
		setlocale(LC_ALL, 'pt_BR');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('romaneio/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Romaneio_model->total(), 
			'prev_link' 	=> '<small class="desc bt">
									<i class="fa fa-angle-left" aria-hidden="true"></i> Anterior
								</small>', 
			'next_link' 	=> '<small class="desc bt">
									Próximo <i class="fa fa-angle-right" aria-hidden="true"></i>
								</small>', 
			'cur_tag_open'	=> '<li class="num">', 
			'cur_tag_close'	=> '</li>', 
			'num_tag_open'	=> '<li class="num">', 
			'num_tag_close'	=> '</li>' 
		);
		$this->pagination->initialize($config);

		$data['middle'] = 'romaneio';
		$data['pagination'] = $this->pagination->create_links();
		$data['total'] = $this->Romaneio_model->total();
		$data['romaneios'] = $this->Romaneio_model->listar($config['per_page'], $offset);
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$valor = strip_tags(trim(str_replace(".", "", $this->input->post('valor'))));
		$valor = str_replace(",", ".", $valor);

		$estabelecimento = explode("|", $this->input->post('estabelecimento'));

		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo(strip_tags(trim($this->input->post('codigo'))));
		$romaneio->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$romaneio->getEstabelecimento()->setCodigo(strip_tags(trim($estabelecimento[0])));
		$romaneio->getTipoVeiculo()->setCodigo(strip_tags(trim($this->input->post('tipoveiculo'))));
		$romaneio->setValor($valor);
		$romaneio->setDataCriacao(date("Y-m-d H:i:s"));

		if($this->input->post('transportadora') != "0" && $this->input->post('motorista') != "0") {
			$romaneio->getTransportadora()->setCodigo(strip_tags(trim($this->input->post('transportadora'))));
			$romaneio->getMotorista()->setCodigo(strip_tags(trim($this->input->post('motorista'))));
			$romaneio->getStatusRomaneio()->setCodigo("1"); // Liberado
			// $romaneio->setOfertarViagem("0"); // Não Ofertar
		} else if($this->input->post('transportadora') == "0" && $this->input->post('motorista') == "0") {
			$romaneio->getTransportadora()->setCodigo(NULL);
			$romaneio->getMotorista()->setCodigo(NULL);
			$romaneio->getStatusRomaneio()->setCodigo("2"); // Pendente
			// $romaneio->setOfertarViagem("1"); // Ofertar
		} else if($this->input->post('transportadora') == "0" && $this->input->post('motorista') != "0") {
			$romaneio->getTransportadora()->setCodigo(NULL);
			$romaneio->getMotorista()->setCodigo(strip_tags(trim($this->input->post('motorista'))));
			$romaneio->getStatusRomaneio()->setCodigo("1"); // Liberado
			// $romaneio->setOfertarViagem("0"); // Não Ofertar
		} else if($this->input->post('motorista') == "0") {
			$romaneio->getMotorista()->setCodigo(NULL);
			$romaneio->getStatusRomaneio()->setCodigo("2"); // Pendente
			// $romaneio->setOfertarViagem("1"); // Ofertar
		}

		if($this->Romaneio_model->verificar_romaneio($romaneio->getCodigo())) {
			$result = $this->Romaneio_model->cadastrar($romaneio);
			if($result) {
				$this->load->model('model/Motorista_model');
				$this->Motorista_model->disponibilidade(FALSE, $romaneio->getMotorista()->getCodigo());
				
				$i = 1;
				do {
					$destinatario = explode("|", $this->input->post('destinatario'.$i));

					$entrega = new Entrega_basic();
					$entrega->setSeqEntrega($i);
					$entrega->getEmpresa()->setCodigo($this->session->userdata('empresa'));
					$entrega->getRomaneio()->setCodigo(strip_tags(trim($this->input->post('codigo'))));
					$entrega->getDestinatario()->setCodigo(strip_tags(trim($destinatario[0])));
					$entrega->setPesoCarga($this->input->post('peso_carga'.$i).' '.trim($this->input->post('medida'.$i)));
					if(empty($this->input->post('nota_fiscal'.$i))) {
						$entrega->setNotaFiscal("0");
						$entrega->getStatusEntrega()->setCodigo("2"); // Pendente
					} else {
						$entrega->setNotaFiscal(trim(strip_tags($this->input->post('nota_fiscal'.$i))));
						$entrega->getStatusEntrega()->setCodigo("1"); // Liberado
					}

					$result = $this->Entrega_model->cadastrar($entrega);
					$i++;
				} while(!is_null($this->input->post("entrega".$i)));

				if($result) {
					$this->session->set_flashdata('success', 'Romaneio e Entrega(s), Cadastrado com Sucesso.');
					redirect(base_url().'romaneio/visualizar/'.strip_tags(trim($this->input->post('codigo'))));
				} else {
					$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar a(s) Entrega(s).');
					redirect(base_url().'romaneio');
				}
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Romaneio.');
				redirect(base_url().'romaneio');
			}
		} else {
			$this->session->set_flashdata('estabelecimento', $romaneio->getEstabelecimento()->getCodigo());
			$this->session->set_flashdata('transportadora', $romaneio->getTransportadora()->getCodigo());
			$this->session->set_flashdata('motorista', $romaneio->getMotorista()->getCodigo());
			$this->session->set_flashdata('tipoveiculo', $romaneio->getTipoVeiculo()->getCodigo());

			$this->session->set_flashdata('error', 'Romaneio já cadastrado, tente outro Código.');
			redirect(base_url().'romaneio/add');
		}
	}

	public function add() {
		if($this->session->userdata('perfil') == 'A') {
			$this->load->model('model/Destinatario_model');
			$this->load->model('model/Estabelecimento_model');
			$this->load->model('model/Motorista_model');
			$this->load->model('model/Transportadora_model');
			$this->load->model('model/TipoVeiculo_model');

			$data['destinatario'] = $this->Destinatario_model->listar();
			$data['estabelecimento'] = $this->Estabelecimento_model->listar();
			$data['motorista'] = $this->Motorista_model->motorista_disponivel();
			$data['transportadora'] = $this->Transportadora_model->listar();
			$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();
			$data['middle'] = 'romaneio/cadastrar';
			$this->load->view('pattern/layout', $data);
		} else {
			$this->session->set_flashdata('error', 'Desculpe, você não tem permissão.');
			redirect(base_url().'romaneio');
		}
	}

	public function integracao() {
		$data['middle'] = 'romaneio/integracao';
		$this->load->view('pattern/layout', $data);
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['romaneios'] = $this->Romaneio_model->consultar($filtro, $procurar);
		$data['middle'] = 'romaneio';
		$this->load->view('pattern/layout', $data);
	}

	public function visualizar() {
		$this->load->model('model/Ocorrencia_model');
		
		$data['ocorrencia'] = $this->Ocorrencia_model->listar($this->uri->segment(3));
		$data['entrega'] = $this->Entrega_model->listar($this->uri->segment(3));
		$data['romaneio'] = $this->Romaneio_model->consultar_romaneio($this->uri->segment(3));
		$data['total_romaneio'] = $this->Romaneio_model->total();
		$data['middle'] = 'romaneio/visualizar';
		$this->load->view('pattern/layout', $data);
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {			
			$valor = strip_tags(trim(str_replace(".", "", $this->input->post('valor'))));
			$valor = str_replace(",", ".", $valor);

			$cod_status_romaneio = 0;
			if($this->input->post('status_romaneio') == "6") {
				$cod_status_romaneio = 6;
			} else if($this->input->post('motorista') != "0") {
				$cod_status_romaneio = 1;
			} else {
				$cod_status_romaneio = 2;
			}

			$estabelecimento = explode("|", $this->input->post('estabelecimento'));
			$motorista = $this->input->post('codigo_motorista');
			$data = array(
				'codigo' => strip_tags(trim($this->input->post('codigo'))),
				'cod_status_romaneio' => $cod_status_romaneio,
				'cod_estabelecimento' => strip_tags(trim($estabelecimento[0])),
				'cod_tipo_veiculo' => strip_tags(trim($this->input->post('tipoveiculo'))),
				'cod_transportadora' => strip_tags(trim($this->input->post('transportadora'))),
				'cod_motorista' => (($this->input->post('motorista') != "0")? $this->input->post('motorista') : NULL ),
				'valor' => $valor
			);

			$result = $this->Romaneio_model->editar($data);
			if($result) {
				$this->load->model('model/Motorista_model');
				if($motorista != "0" && $motorista != $data['cod_motorista']) {
					$this->Motorista_model->disponibilidade(TRUE, $motorista);
					$this->Motorista_model->disponibilidade(FALSE, $data['cod_motorista']);
				} else {
					$this->Motorista_model->disponibilidade(FALSE, $data['cod_motorista']);
				}

				$this->session->set_flashdata('success', 'Romaneio, Editado com Sucesso.');
				redirect(base_url().'romaneio/editar/'.$data['codigo']);
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Romaneio.');
				redirect(base_url().'romaneio');
			}
		} else {
			if($this->session->userdata('perfil') == 'A') {
				$this->load->model('model/Destinatario_model');
				$this->load->model('model/Estabelecimento_model');
				$this->load->model('model/Motorista_model');
				$this->load->model('model/Transportadora_model');
				$this->load->model('model/TipoVeiculo_model');
				$this->load->model('model/Ocorrencia_model');

				$data['destinatario'] = $this->Destinatario_model->listar();
				$data['entrega'] = $this->Entrega_model->listar($this->uri->segment(3));
				$data['estabelecimento'] = $this->Estabelecimento_model->listar();
				$data['motorista'] = $this->Motorista_model->listar($this->uri->segment(3));
				$data['motorista_disponivel'] = $this->Motorista_model->motorista_disponivel();
				$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();
				$data['transportadora'] = $this->Transportadora_model->listar();
				$data['romaneio'] = $this->Romaneio_model->consultar_romaneio($this->uri->segment(3));
				$data['ocorrencia'] = $this->Ocorrencia_model->listar($this->uri->segment(3));
				$data['middle'] = 'romaneio/editar';
				$this->load->view('pattern/layout', $data);
			} else {
				$this->session->set_flashdata('error', 'Desculpe, você não tem permissão.');
				redirect(base_url().'romaneio');
			}
		}
	}

	public function excluir() {
		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo($this->uri->segment(3));
		$romaneio->getMotorista()->setCodigo($this->uri->segment(4));

		$result = $this->Romaneio_model->excluir($romaneio);
		if($result) {
			if($this->Entrega_model->verificar($romaneio->getCodigo())) {
				$result = $this->Entrega_model->excluir($romaneio);
				if($result) {
					if(!is_null($romaneio->getMotorista()->getCodigo())) {
						$this->load->model('model/Motorista_model');
						$this->load->model('model/Ocorrencia_model');
						$this->Motorista_model->disponibilidade(TRUE, $romaneio->getMotorista()->getCodigo());
						$this->Ocorrencia_model->excluir($romaneio);
					}

					$this->session->set_flashdata('success', 'Romaneio e Entrega(s), Excluído(s) com Sucesso.');
				} else {
					$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Romaneio e a Entrega(s).');
				}
			} else {
				$this->session->set_flashdata('success', 'Romaneio, Excluído(s) com Sucesso.');
			}
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Romaneio.');
		}
		
		redirect(base_url().'romaneio');
	}

	public function integrar(){
		$nome = 'bidtrack-'.rand(0, 500000);
		$arquivo = $_FILES['arquivo'];
		$configuracao = array(
			'upload_path' => './assets/romaneios/',
			'allowed_types' => 'txt',
			'file_name' => $nome.'.csv',
			'max_size' => '5000'
		);

		$this->load->library('upload');
		$this->upload->initialize($configuracao);
		if(!$this->upload->do_upload('arquivo')) {
			$data['info'] = $this->upload->display_errors();
		} else {
			$data['info'] = 'Arquivo salvo com sucesso.';
		}

		$handle = fopen("./assets/romaneios/".$nome.".csv", "r");
		$entrega = array();
		while(!feof($handle)) {
			$linha = trim(fgets($handle, 4096));
			$column = explode(";", $linha);
			
			$entrega[] = $column;
		}
		fclose($handle);

		$romaneio = array_shift($entrega);

		if($this->validar_romaneio($romaneio) != FALSE && $this->validar_entrega($entrega) != FALSE) {
			$data['entrega'] = $this->validar_entrega($entrega);
			$data['romaneio'] = $this->validar_romaneio($romaneio);
			
			$peso_total = $data['romaneio'][5]->peso;
			$peso_entregas = end($data['entrega']);
			if($this->validar_carga($peso_total, $peso_entregas[3])) {
				$data['middle'] = 'romaneio/integracao';
				$this->load->view('pattern/layout', $data);
			} else {
				redirect(base_url().'romaneio/integracao');
			}
		} else {
			redirect(base_url().'romaneio/integracao');
		}
	}

	private function validar_romaneio($romaneio) {
		$this->load->model('model/Integracao_model');

		for($i = 0; $i < count($romaneio); $i++) {
			$romaneio[$i] = strip_tags(trim($romaneio[$i]));
		}

		if(count($romaneio) == 6) { // Quantidade de Campos
			if($romaneio[0] == 0000 || strlen($romaneio[0]) != 4 || !is_numeric($romaneio[0])) { // Cód. do Romaneio
				$this->session->set_flashdata('error', 'Desculpe, Código do Romaneio inválido.');
				return false;
			} else if($this->Romaneio_model->verificar_romaneio($romaneio[0]) == FALSE) { // Existir Cód. Romaneio
				$this->session->set_flashdata('error', 'Romaneio já cadastrado, tente outro Código.');
				return false;
			} else if(cnpj(trim($romaneio[1])) == FALSE) { // Verificar CNPJ do Estabelecimento
				$this->session->set_flashdata('error', 'Desculpe, CNPJ do Estabelecimento está inválido.');
				return false;
			} else if($this->Integracao_model->verificar_estabelecimento($romaneio[1])) { // Inexistir Estabelecimento
				$this->session->set_flashdata('error', 'Estabelecimento do Romaneio não cadastrado.');
				return false;
			} else if(!is_numeric($romaneio[2])) { // Verificar se Valor é numérico
				$this->session->set_flashdata('error', 'Desculpe, Valor do Romaneio inválido.');
				return false;
			} else if(cnpj(trim($romaneio[3])) == FALSE) { // Verificar CNPJ da Transportadora
				$this->session->set_flashdata('error', 'Desculpe, CNPJ da Transportadora está inválido.');
				return false;
			} else if($this->Integracao_model->verificar_transportadora($romaneio[3])) { // Inexistir Transportadora
				$this->session->set_flashdata('error', 'Transportadora do Romaneio não cadastrado.');
				return false;
			} else if(cpf(trim($romaneio[4])) == FALSE) { // Verificar CPF do Motorista
				$this->session->set_flashdata('error', 'Desculpe, CPF do Motorista está inválido.');
				return false;
			} else if($this->Integracao_model->verificar_motorista($romaneio[4])) { // Inexistir Motorista
				$this->session->set_flashdata('error', 'Motorista do Romaneio não cadastrado.');
				return false;
			} else if($this->Integracao_model->verificar_motorista_disponibilidade($romaneio[4]) == FALSE) {
				$this->session->set_flashdata('error', 'Motorista do Romaneio não está Disponível.');
				return false;
			} else if(strlen($romaneio[5]) < 4) { // Tipo de Veículo, minímo de 4 caracteres 
				$this->session->set_flashdata('error', 'Preencha o Tipo do Veículo com mais de 4 caracteres.');
				return false;
			} else if($this->Integracao_model->verificar_tipoveiculo($romaneio[5])) { // Inexistir Tipo de Veículo
				$this->session->set_flashdata('error', 'Tipo de Veículo do Romaneio não cadastrado.');
				return false;
			} else {
				$romaneio[1] = $this->Integracao_model->estabelecimento($romaneio[1]);
				$romaneio[3] = (trim($romaneio[3]) == 0)? NULL : $this->Integracao_model->transportadora($romaneio[3]);
				$romaneio[4] = (trim($romaneio[4]) == 0)? NULL : $this->Integracao_model->motorista($romaneio[4]);
				$romaneio[5] = $this->Integracao_model->tipo_veiculo($romaneio[5]);
				
				return $romaneio;
			}
		} else {
			$this->session->set_flashdata('error', 'Dados da Importação incompleto(s)/incorreto(s).');
			return false;
		}
	}

	private function validar_entrega($entrega) {
		$this->load->model('model/Entrega_model');

		$peso_total = 0; // Peso Total da Carga
		for($i = 0; $i < count($entrega); $i++) {
			if(count($entrega[$i]) == 2 || count($entrega[$i]) == 3) {
				if(cnpj(trim($entrega[$i][0])) == FALSE ) { // Verificar CNPJ do Destinatário
					$this->session->set_flashdata('error', 'Desculpe, CNPJ da Destinatário '.++$i.' está inválido.');
					return false;
				} else if($this->Integracao_model->verificar_destinatario($entrega[$i][0])) { // Inexistir Destinatário
					$this->session->set_flashdata('error', 'Destinatário da Entrega '.++$i.' não cadastrado.');
					return false;
				} else if(!is_numeric($entrega[$i][1])) {
					$this->session->set_flashdata('error', 'Peso da Carga da Entrega '.++$i.' está invalido.');
					return false;
				} else if($this->Entrega_model->verificar_notafiscal($entrega[$i][2]) == FALSE) { // Existir NFS
					$this->session->set_flashdata('error', 'Nota Fiscal da Entrega '.++$i.' já cadastrada.');
					return false;
				} else if(strlen(trim($entrega[$i][2])) != 7 && !is_numeric($entrega[$i][2])) { // Tamanho NFS
					$this->session->set_flashdata('error', 'Nota Fiscal da Entrega '.++$i.' está inválido.');
					return false;
				} else {
					$this->load->model('model/Integracao_model');

					$entrega[$i][0] = $this->Integracao_model->destinatario($entrega[$i][0]);
					$peso_total += $entrega[$i][1];
					$entrega[$i][3] = $peso_total;
				}
			} else {
				$this->session->set_flashdata('error', 'Dados da Entrega '.++$i.' incompleto(s)/incorreto(s).');
				return false;
			}
		}

		return $entrega;
	}

	private function validar_carga($peso_total, $peso_carga) {
		if($peso_total > $peso_carga) {
			return true;
		} else {
			$this->session->set_flashdata('error', 'Peso da Carga ultrapassou os limites do veículo.');
			return false;
		}
	}

	public function imprimir() {
		$data['romaneio'] = $this->Romaneio_model->consultar_romaneio($this->uri->segment(3));
		$data['entrega'] = $this->Entrega_model->listar($this->uri->segment(3));
		$data['middle'] = 'romaneio/imprimir';
		$this->load->view('pattern/layout', $data);
	}

	public function verificar() {
		$romaneio = $this->input->post('codigo');

		echo json_encode($this->Romaneio_model->verificar_romaneio($romaneio));
	}

	public function iniciar() { // Iniciar Viagem
		$this->load->model('model/Entrega_model');
		$romaneio = $this->uri->segment(3);
		$entrega = $this->Entrega_model->primeira_entrega($romaneio);
		if($entrega[0]->cod_status_entrega == 1) { // Liberado
			$result = $this->Romaneio_model->status('3', $romaneio);
			if($result == 1) {
				$this->Entrega_model->entrega_status(3, $entrega[0]->primeira_entrega, $romaneio); // Em Viagem
				$this->session->set_flashdata('success', 'Transporte do Romaneio '.$romaneio.' iniciado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao Iniciar o Romaneio '.$romaneio.'.');
			}
		} else {
			$this->session->set_flashdata('error', 'Desculpe, Romaneio '.$romaneio.' contém entrega(s) Pendente(s).');
		}

		redirect(base_url().'romaneio');
	}

	public function ofertar() {
		$romaneio = $this->uri->segment(3);
		$data = date("Y-m-d H:i:s");
		$result = $this->Romaneio_model->ofertar('6', $romaneio, $data);
		if($result == 1) {
			$this->session->set_flashdata('success', 'Romaneio '.$romaneio.', Ofertado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao ofertar o Romaneio '.$romaneio.'.');
		}

		redirect(base_url().'romaneio');
	}

	public function cancelar_ofertar() {
		$romaneio = $this->uri->segment(3);
		$result = $this->Romaneio_model->status('2', $romaneio);
		if($result == 1) {
			$this->session->set_flashdata('success', 'Ofertar Romaneio, cancelado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cancelar o ofertar do Romaneio '.$romaneio.'.');
		}

		redirect(base_url().'romaneio');
	}

	public function nota() {
		$total = 0;
		$notas = $this->Romaneio_model->consultar_nota($this->input->post('motorista'));
		foreach ($notas as $row) {
			$total += $row->nota;
		}

		$media = substr(($total + $this->input->post('nota'))/(count($notas)+1), 0, 4);
		$result = $this->Romaneio_model->nota($this->input->post('romaneio'), $this->input->post('motorista'), $this->input->post('nota'));
		if($result == 1) {
			$this->load->model('model/Motorista_model');
			$motorista = $this->Motorista_model->nota($this->input->post('motorista'), $media);
			$status = $this->Romaneio_model->status('7', $this->input->post('romaneio'));
			$this->session->set_flashdata('success', 'Nota, registrada com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao Registrar a nota do Romaneio '.$this->input->post('romaneio').'.');
		}

		redirect(base_url().'romaneio');
	}
}