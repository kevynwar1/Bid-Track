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
	}

	public function index() {
		$data['romaneios'] = $this->Romaneio_model->listar();
		$data['middle'] = 'romaneio';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$estabelecimento = explode("|", $this->input->post('estabelecimento'));
		$destinatario = explode("|", $this->input->post('destinatario'));

		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo(strip_tags(trim($this->input->post('codigo'))));
		$romaneio->getEstabelecimento()->setCodigo(strip_tags(trim($estabelecimento[0])));
		$romaneio->getTipoVeiculo()->setCodigo(strip_tags(trim($this->input->post('tipoveiculo'))));
		$romaneio->setDataCriacao(date("Y-m-d"));

		if($this->input->post('transportadora') != "0") {
			$romaneio->getTransportadora()->setCodigo(strip_tags(trim($this->input->post('transportadora'))));
		} else {
			$romaneio->getTransportadora()->setCodigo(NULL);
		}

		if($this->input->post('motorista') != "0") {
			$romaneio->getMotorista()->setCodigo(strip_tags(trim($this->input->post('motorista'))));
			$romaneio->getStatusRomaneio()->setCodigo("1"); // Liberado
			$romaneio->setOfertarViagem("0"); // Não Ofertar
		} else {
			$romaneio->getMotorista()->setCodigo(NULL);
			$romaneio->getStatusRomaneio()->setCodigo("2"); // Pendente
			$romaneio->setOfertarViagem("1"); // Ofertar
		}

		if($this->Romaneio_model->verificar($romaneio->getCodigo())) {
			$result = $this->Romaneio_model->cadastrar($romaneio);
			if($result) {
				$entrega = new Entrega_basic();
				$entrega->getRomaneio()->setCodigo(strip_tags(trim($this->input->post('codigo'))));
				$entrega->getDestinatario()->setCodigo(strip_tags(trim($destinatario[0])));
				$entrega->setPesoCarga(trim($this->input->post('peso_carga')).' '.trim($this->input->post('medida')));
				if(empty($this->input->post('nota_fiscal'))) {
					$entrega->setNotaFiscal("0");
					$entrega->getStatusEntrega()->setCodigo("2"); // Pendente
				} else {
					$entrega->setNotaFiscal(trim(strip_tags($this->input->post('nota_fiscal'))));
					$entrega->getStatusEntrega()->setCodigo("1"); // Liberado
				}

				$result = $this->Entrega_model->cadastrar($entrega);
				if($result) {
					$this->session->set_flashdata('success', 'Romaneio e Entrega, Cadastrado com Sucesso.');
					redirect(base_url().'romaneio/visualizar/'.strip_tags(trim($this->input->post('codigo'))));
				} else {
					$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar a Entrega.');
					redirect(base_url().'romaneio');
				}
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Romaneio.');
				redirect(base_url().'romaneio');
			}
		} else {
			$this->session->set_flashdata('error', 'Romaneio já cadastrado, tente outro Código.');
			redirect(base_url().'romaneio/add');
		}
	}

	public function add() {
		$this->load->model('model/Destinatario_model');
		$this->load->model('model/Estabelecimento_model');
		$this->load->model('model/Motorista_model');
		$this->load->model('model/Transportadora_model');
		$this->load->model('model/TipoVeiculo_model');

		$data['destinatario'] = $this->Destinatario_model->listar();
		$data['estabelecimento'] = $this->Estabelecimento_model->listar();
		$data['motorista'] = $this->Motorista_model->listar();
		$data['transportadora'] = $this->Transportadora_model->listar();
		$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();
		$data['middle'] = 'romaneio/cadastrar';
		$this->load->view('pattern/layout', $data);
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

	public function mapa() {
		$address = trim(str_replace(" ", "+", $this->input->get('endereco')));
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$data['coordenadas'] = $coordenadas;
		$data['middle'] = 'mapa';
		$this->load->view('pattern/layout', $data);
	}

	public function visualizar() {
		$data['romaneio'] = $this->Romaneio_model->consultar_romaneio($this->uri->segment(3));
		$data['entrega'] = $this->Entrega_model->listar($this->uri->segment(3));
		$data['middle'] = 'romaneio/visualizar';
		$this->load->view('pattern/layout', $data);
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$estabelecimento = explode("|", $this->input->post('estabelecimento'));
			$data = array(
				'codigo' => strip_tags(trim($this->input->post('codigo'))),
				'cod_status_romaneio' => (($this->input->post('motorista') != "0")? "1" : "2" ),
				'cod_estabelecimento' => (strip_tags(trim($estabelecimento[0]))),
				'cod_tipo_veiculo' => strip_tags(trim($this->input->post('tipoveiculo'))),
				'cod_transportadora' => strip_tags(trim($this->input->post('transportadora'))),
				'cod_motorista' => (($this->input->post('motorista') != "0")? $this->input->post('motorista') : NULL ),
			);

			$result = $this->Romaneio_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Romaneio, Editado com Sucesso.');
				redirect(base_url().'romaneio/editar/'.$data['codigo']);
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Romaneio.');
				redirect(base_url().'romaneio');
			}
		} else {
			$this->load->model('model/Estabelecimento_model');
			$this->load->model('model/Motorista_model');
			$this->load->model('model/Transportadora_model');
			$this->load->model('model/TipoVeiculo_model');

			$data['entrega'] = $this->Entrega_model->listar($this->uri->segment(3));
			$data['estabelecimento'] = $this->Estabelecimento_model->listar();
			$data['motorista'] = $this->Motorista_model->listar();
			$data['transportadora'] = $this->Transportadora_model->listar();
			$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();
			$data['romaneio'] = $this->Romaneio_model->consultar_romaneio($this->uri->segment(3));
			$data['middle'] = 'romaneio/editar';
			$this->load->view('pattern/layout', $data);
		}
	}

	public function excluir() {
		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo($this->uri->segment(3));

		$result = $this->Romaneio_model->excluir($romaneio);
		if($result) {
			if($this->Entrega_model->verificar($romaneio->getCodigo())) {
				$result = $this->Entrega_model->excluir_romaneio($romaneio);
				if($result) {
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
			'allowed_types' => 'txt|csv',
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

		$data['entrega'] = $entrega;
		$data['romaneio'] = $romaneio;
		$data['middle'] = 'romaneio/integracao';
		$this->load->view('pattern/layout', $data);
	}

	public function rr() {
		p($this->Romaneio_model->romaneio_ofertavel(1,1));
	}
}