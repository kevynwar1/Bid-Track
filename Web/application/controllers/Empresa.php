<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
		$this->load->model('model/Empresa_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$empresa = new Empresa_basic();
		$empresas = new Empresa_basic();
        $empresas = $this->Empresa_model->listar();
	}

	public function cadastrar() {
		$empresa = new Empresa_basic();
		$empresa->setCnpj(strip_tags(trim($this->input->post('cnpj'))));
		$empresa->setEmpresa(strip_tags(trim($this->input->post('empresa'))));
		$empresa->setNome(strip_tags(trim($this->input->post('nome'))));
		$empresa->setEndereco(strip_tags(trim($this->input->post('endereco'))));
		$empresa->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$empresa->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$empresa->setEstado(strip_tags(trim($this->input->post('estado'))));
		$empresa->setTelefone(strip_tags(trim($this->input->post('telefone'))));
		$empresa->setEmail(strip_tags(trim($this->input->post('email'))));
		$empresa->setSenha(strip_tags(trim($this->input->post('senha'))));

		p($empresa);
	}

	public function cnpj() {
		$cnpj = $_POST['cnpj'];
		$cnpj = str_replace(".", "", $cnpj);
		$cnpj = str_replace("-", "", $cnpj);
		$cnpj = str_replace("/", "", $cnpj);

		$json_url = "https://www.receitaws.com.br/v1/cnpj/$cnpj";
		$json = file_get_contents($json_url);
		$data = json_decode($json, TRUE);

		if($data['status'] == 'OK') {
			$dados['nome'] 			= (string) $data['nome'];
			$dados['endereco'] 		= (string) $data['logradouro'];
			$dados['numero'] 		= (string) $data['numero'];
			$dados['complemento'] 	= (string) $data['complemento'];
			$dados['bairro'] 		= (string) $data['bairro'];
			$dados['cep']			= (string) $data['cep'];
			$dados['cidade']  		= (string) $data['municipio'];
			$dados['telefone'] 		= (string) $data['telefone'];
			$dados['email'] 		= (string) $data['email'];
		} else {
			return false;
		}

		echo json_encode($dados);
	}
}