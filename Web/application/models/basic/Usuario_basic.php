<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_basic extends CI_Model {
	public $codigo;
	public $empresa;
	public $nome;
	public $email;
	public $telefone;
	public $cep;
	public $logradouro;
	public $numero;
	public $complemento;
	public $bairro;
	public $cidade;
	public $uf;
	public $senha;
	public $perfil;
	public $situacao;
	
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');

		$this->empresa = new Empresa_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getNome() { return $this->nome; }
	public function setNome($nome) { $this->nome = $nome; }

	public function getEmail() { return $this->email; }
	public function setEmail($email) { $this->email = $email; }

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

	public function getTelefone() { return $this->telefone; }
	public function setTelefone($telefone) { $this->telefone = $telefone; }

	public function getSenha() { return $this->senha; }
	public function setSenha($senha) { $this->senha = $senha; }

	public function getPerfil() { return $this->perfil; }
	public function setPerfil($perfil) { $this->perfil = $perfil; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}