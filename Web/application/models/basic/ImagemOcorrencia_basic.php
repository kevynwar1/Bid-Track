<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ImagemOcorrencia_basic extends CI_Model {
	public $codigo;
	public $ocorrencia;
	public $foto;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Ocorrencia_basic');

		$this->ocorrencia = new Ocorrencia_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getOcorrencia() { return $this->ocorrencia; }
	public function setOcorrencia($ocorrencia) { $this->ocorrencia = $ocorrencia; }

	public function getFoto() { return $this->foto; }
	public function setFoto($foto) { $this->foto = $foto; }
}
?>