<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinatario_basic extends CI_Model {
	public $cod_destinatario;
	public $empresa;
	public $razao_social;
	public $nome_fantasia;
	public $tipo_pessoa;
	public $cnpj_cpf;
	public $email;
	public $telefone;
	public $logradouro;
	public $numero;
	public $complemento;
	public $bairro;
	public $cidade;
	public $uf;
	public $cep;
	public $latitude;
	public $longitude;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');

		$this->empresa = new Empresa_basic();
	}

	public function getCodDestinatario() { return $this->cod_destinatario; }
	public function setCodDestinatario($cod_destinatario) { $this->cod_destinatario = $cod_destinatario; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getRazaoSocial() { return $this->razao_social; }
	public function setRazaoSocial($razao_social) { $this->razao_social = $razao_social; }

	public function getNomeFantasia() { return $this->nome_fantasia; }
	public function setNomeFantasia($nome_fantasia) { $this->nome_fantasia = $nome_fantasia; }

	public function getTipoPessoa() { return $this->tipo_pessoa; }
	public function setTipoPessoa($tipo_pessoa) { $this->tipo_pessoa = $tipo_pessoa; }

	public function getCnpjCpf() { return $this->cnpj_cpf; }
	public function setCnpjCpf($cnpj_cpf) { $this->cnpj_cpf = $cnpj_cpf; }

	public function getEmail() { return $this->email; }
	public function setEmail($email) { $this->email = $email; }

	public function getTelefone() { return $this->telefone; }
	public function setTelefone($telefone) { $this->telefone = $telefone; }

	public function getLogradouro() { return $this->logradouro; }
	public function setLogradouro($logradouro) { $this->logradouro = $logradouro; }

	public function getNumero() { return $this->numero; }
	public function setNumero($numero) { $this->numero = $numero; }

	public function getComplemento() { return $this->complemento; }
	public function setComplemento($complemento) { $this->complemento = $complemento; }

	public function getBairro() { return $this->bairro; }
	public function setBairro($bairro) { $this->bairro = $bairro; }

	public function getCidade() { return $this->cidade; }
	public function setCidade($cidade) { $this->cidade = $cidade; }

	public function getUf() { return $this->uf; }
	public function setUf($uf) { $this->uf = $uf; }

	public function getCep() { return $this->cep; }
	public function setCep($cep) { $this->cep = $cep; }

	public function getLatitude() { return $this->latitude; }
	public function setLatitude($latitude) { $this->latitude = $latitude; }

	public function getLongitude() { return $this->longitude; }
	public function setLongitude($longitude) { $this->longitude = $longitude; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}