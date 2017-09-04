<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Romaneio_basic extends CI_Model {
	public $cod_romaneio;
	public $veiculo;
	public $transportadora;
	public $motorista;
	public $finalizado;
	public $oferta_viagem;
	public $integrado;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Veiculo_basic');
		$this->load->model('basic/Transportadora_basic');
		$this->load->model('basic/Motorista_basic');

		$this->veiculo = new Veiculo_basic();
		$this->transportadora = new Transportadora_basic();
		$this->motorista = new Motorista_basic();
	}

	public function getCodRomaneio() { return $this->cod_romaneio; }
	public function setCodRomaneio($cod_romaneio) { $this->cod_romaneio = $cod_romaneio; }

	public function getVeiculo() { return $this->veiculo; }
	public function setVeiculo($veiculo) { $this->veiculo = $veiculo; }

	public function getTransportadora() { return $this->transportadora; }
	public function setTransportadora($transportadora) { $this->transportadora = $transportadora; }

	public function getMotorista() { return $this->motorista; }
	public function setMotorista($motorista) { $this->motorista = $motorista; }

	public function getFinalizado() { return $this->finalizado; }
	public function setFinalizado($finalizado) { $this->finalizado = $finalizado; }

	public function getOfertarViagem() { return $this->oferta_viagem; }
	public function setOfertarViagem($oferta_viagem) { $this->oferta_viagem = $oferta_viagem; }

	public function getIntegrado() { return $this->integrado; }
	public function setIntegrado($integrado) { $this->integrado = $integrado; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>