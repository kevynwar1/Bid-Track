<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista_basic extends CI_Model {
	public $codigo;
	public $empresa;
	public $usuario;
	public $nome;
	public $cpf;
	public $pontuacao;
	public $logradouro;
	public $numero;
	public $complemento;
	public $bairro;
	public $cidade;
	public $uf;
	public $cep;
	public $latitude;
	public $longitude;
	public $tipo_carteira;
	public $validade_carteira;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
		$this->load->model('basic/Usuario_basic');

		$this->empresa = new Empresa_basic();
		$this->usuario = new Usuario_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getUsuario() { return $this->usuario; }
	public function setUsuario($usuario) { $this->usuario = $usuario; }

	public function getNome() { return $this->nome; }
	public function setNome($nome) { $this->nome = $nome; }

	public function getCpf() { return $this->cpf; }
	public function setCpf($cpf) { $this->cpf = $cpf; }

	public function getPontuacao() { return $this->pontuacao; }
	public function setPontuacao($pontuacao) { $this->pontuacao = $pontuacao; }

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

	public function getTipoCarteira() { return $this->tipo_carteira; }
	public function setTipoCarteira($tipo_carteira) { $this->tipo_carteira = $tipo_carteira; }

	public function getValidadeCarteira() { return $this->validade_carteira; }
	public function setValidadeCarteira($validade_carteira) { $this->validade_carteira = $validade_carteira; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>