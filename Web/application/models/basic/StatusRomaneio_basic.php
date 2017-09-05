<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusRomaneio_basic extends CI_Model {
	public $codigo;
	public $descricao;
	public $situacao;

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>