<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusEntrega_basic extends CI_Model {
	public $codigo;
	public $descricao;
	public $situacao;

	/*function __construct() {
		parent::__construct();
		$this->load->model('basic/Ocorrencia_basic');

		$this->ocorrencia = new Ocorrencia_basic();
	}*/

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>