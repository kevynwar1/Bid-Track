<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_basic extends CI_Model {
	public $codigo;
	public $razao_social;
	public $cnpj;
	public $logradouro;
	public $numero;
	public $nome_fantasia;
	public $complemento;
	public $bairro;
	public $cidade;
	public $uf;
	public $cep;
	public $latitude;
	public $longitude;
	public $foto;
	public $situacao;
	
	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getRazaoSocial() { return $this->razao_social; }
	public function setRazaoSocial($razao_social) { $this->razao_social = $razao_social; }

	public function getCnpj() { return $this->cnpj; }
	public function setCnpj($cnpj) { $this->cnpj = $cnpj; }

	public function getLogradouro() { return $this->logradouro; }
	public function setLogradouro($logradouro) { $this->logradouro = $logradouro; }

	public function getNumero() { return $this->numero; }
	public function setNumero($numero) { $this->numero = $numero; }

	public function getNomeFantasia() { return $this->nome_fantasia; }
	public function setNomeFantasia($nome_fantasia) { $this->nome_fantasia = $nome_fantasia; }

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

	public function getFoto() { return $this->foto; }
	public function setFoto($foto) { $this->foto = $foto; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}