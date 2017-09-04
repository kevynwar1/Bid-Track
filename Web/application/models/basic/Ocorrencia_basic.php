<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_basic extends CI_Model {
	public $cod_ocorrencia;
	public $empresa;
	public $descricao;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');

		$this->empresa = new Empresa_basic();
	}

	public function getCodOcorrencia() { return $this->cod_ocorrencia; }
	public function setCodOcorrencia($cod_ocorrencia) { $this->cod_ocorrencia = $cod_ocorrencia; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>