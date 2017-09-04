<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoVeiculo_basic extends CI_Model {
	public $cod_tipoveiculo;
	public $empresa;
	public $descricao;
	public $peso;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');

		$this->empresa = new Empresa_basic();
	}

	public function getCodTipoVeiculo() { return $this->cod_tipoveiculo; }
	public function setCodTipoVeiculo($cod_tipoveiculo) { $this->cod_tipoveiculo = $cod_tipoveiculo; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getPeso() { return $this->peso; }
	public function setPeso($peso) { $this->peso = $peso; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>