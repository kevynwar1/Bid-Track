<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_basic extends CI_Model {
	public $codigo;
	public $empresa;
	public $entrega;
	public $romaneio;
	public $tipo_ocorrencia;
	public $descricao;
	public $foto;
	public $data;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
		$this->load->model('basic/Entrega_basic');
		$this->load->model('basic/Romaneio_basic');
		$this->load->model('basic/TipoOcorrencia_basic');

		$this->empresa = new Empresa_basic();
		$this->entrega = new Entrega_basic();
		$this->romaneio = new Romaneio_basic();
		$this->tipo_ocorrencia = new TipoOcorrencia_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getEntrega() { return $this->entrega; }
	public function setEntrega($entrega) { $this->entrega = $entrega; }

	public function getRomaneio() { return $this->romaneio; }
	public function setRomaneio($romaneio) { $this->romaneio = $romaneio; }

	public function getTipoOcorrencia() { return $this->tipo_ocorrencia; }
	public function setTipoOcorrencia($tipo_ocorrencia) { $this->tipo_ocorrencia = $tipo_ocorrencia; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao) { $this->descricao = $descricao; }

	public function getFoto() { return $this->foto; }
	public function setFoto($foto) { $this->foto = $foto; }

	public function getData() { return $this->data; }
	public function setData($data) { $this->data = $data; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>