<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoOcorrencia_basic extends CI_Model {
	public $codigo;
	public $empresa;
	public $descricao;
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

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>