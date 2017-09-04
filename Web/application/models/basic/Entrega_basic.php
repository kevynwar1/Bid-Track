<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrega_basic extends CI_Model {
	public $cod_entrega;
	public $romaneio;
	public $destinatario;
	public $status_entrega;
	public $peso_carga;
	public $imagem;
	public $nota_fiscal;
	public $finalizado;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Romaneio_basic');
		$this->load->model('basic/Destinatario_basic');
		$this->load->model('basic/StatusEntrega_basic');

		$this->romaneio = new Romaneio_basic();
		$this->destinatario = new Destinatario_basic();
		$this->status_entrega = new StatusEntrega_basic();
	}

	public function getCodEntrega() { return $this->cod_entrega; }
	public function setCodEntrega($cod_entrega) { $this->cod_entrega = $cod_entrega; }

	public function getRomaneio() { return $this->romaneio; }
	public function setRomaneio($romaneio) { $this->romaneio = $romaneio; }

	public function getDestinatario() { return $this->destinatario; }
	public function setDestinatario($destinatario) { $this->destinatario = $destinatario; }

	public function getStatusEntrega() { return $this->status_entrega; }
	public function setStatusEntrega($status_entrega) { $this->status_entrega = $status_entrega; }

	public function getPesoCarga() { return $this->peso_carga; }
	public function setPesoCarga($peso_carga) { $this->peso_carga = $peso_carga; }

	public function getImagem() { return $this->imagem; }
	public function setImagem($imagem) { $this->imagem = $imagem; }

	public function getNotaFiscal() { return $this->nota_fiscal; }
	public function setNotaFiscal($nota_fiscal) { $this->nota_fiscal = $nota_fiscal; }

	public function getFinalizado() { return $this->finalizado; }
	public function setFinalizado($finalizado) { $this->finalizado = $finalizado; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>