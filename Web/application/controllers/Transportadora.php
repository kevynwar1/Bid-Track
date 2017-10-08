<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadora extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Transportadora_basic');
		$this->load->model('model/Transportadora_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$data['transportadora'] = $this->Transportadora_model->listar();
		$data['middle'] = 'transportadora';
		
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$transportadora->getLogradouro().", ".$transportadora->getNumero()."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$transportadora = new Transportadora_basic();
		$transportadora->getEmpresa()->setCodigo(strip_tags(trim($this->input->post('empresa'))));
		$transportadora->setRazaoSocial(strip_tags(trim($this->input->post('razao_social'))));
		$transportadora->setNomeFantasia(strip_tags(trim($this->input->post('empresa'))));
		$transportadora->setCnpj(strip_tags(trim($this->input->post('cnpj'))));
		$transportadora->setLogradouro(strip_tags(trim($this->input->post('logradouro'))));
		$transportadora->setNumero(strip_tags(trim($this->input->post('numero'))));
		$transportadora->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$transportadora->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$transportadora->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$transportadora->setUf(strip_tags(trim($this->input->post('uf'))));
		$transportadora->setCep(strip_tags(trim($this->input->post('cep'))));
		$transportadora->setLatitude($coordenadas['results'][0]['geometry']['location']['lat']);
		$transportadora->setLongitude($coordenadas['results'][0]['geometry']['location']['lng']);

		$result = $this->Transportadora_model->cadastrar($transportadora);
		if($result) {
			$this->session->set_flashdata('success', 'Transportadora, cadastrada com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar a Transportadora.');
		}

		redirect(base_url().'transportadora');
	}

	public function excluir() {
		$transportadora = new Transportadora_basic();
		$transportadora->setCodigo($this->uri->segment(3));

		$result = $this->Transportadora_model->excluir($transportadora);
		if($result) {
			$this->session->set_flashdata('success', 'Transportadora, Excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir a Transportadora.');
		}

		redirect(base_url().'transportadora');
	}
}
?>