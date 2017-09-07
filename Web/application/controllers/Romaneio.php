<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Romaneio extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Romaneio_basic');
		$this->load->model('model/Romaneio_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$data['middle'] = 'romaneio';
		$data['romaneio'] = $this->Romaneio_model->listar();
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo(strip_tags(trim($this->input->post('codigo'))));
		$romaneio->getStatusRomaneio()->setCodigo(strip_tags(trim($this->input->post('statusromaneio'))));
		$romaneio->getEstabelecimento()->setCodigo(strip_tags(trim($this->input->post('estabelecimento'))));
		$romaneio->getVeiculo()->setCodigo(strip_tags(trim($this->input->post('veiculo'))));
		$romaneio->getTransportadora()->setCodigo(strip_tags(trim($this->input->post('transportadora'))));
		$romaneio->getMotorista()->setCodigo(strip_tags(trim($this->input->post('motorista'))));
		$romaneio->setDataCriacao(date("Y-m-d"));
		$romaneio->setOfertarViagem(strip_tags(trim($this->input->post('ofertar_viagem'))));

		$result = $this->Romaneio_model->cadastrar($romaneio);
		if($result) {
			$this->session->set_flashdata('success', 'Romaneio, Cadastrado com Sucesso.');
			redirect(base_url().'romaneio');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Romaneio.');
			redirect(base_url().'romaneio');
		}
	}

	public function add() {
		$this->load->model('model/Estabelecimento_model');
		$this->load->model('model/Motorista_model');
		$this->load->model('model/Transportadora_model');
		$this->load->model('model/Veiculo_model');

		$data['estabelecimento'] = $this->Estabelecimento_model->listar();
		$data['motorista'] = $this->Motorista_model->listar();
		$data['transportadora'] = $this->Transportadora_model->listar();
		$data['veiculo'] = $this->Veiculo_model->listar();
		$data['middle'] = 'romaneio/cadastrar';
		$this->load->view('pattern/layout', $data);
	}

	public function integracao() {
		$data['middle'] = 'romaneio/integracao';
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
		$data['middle'] = 'romaneio/visualizar';
		$this->load->view('pattern/layout', $data);
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
}