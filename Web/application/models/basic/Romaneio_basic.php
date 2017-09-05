<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Romaneio_basic extends CI_Model {
	public $codigo;
	public $status_romaneio;
	public $estabelecimento;
	public $veiculo;
	public $transportadora;
	public $motorista;
	public $data_criacao;
	public $data_finalizacao;
	public $ofertar_viagem;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/StatusRomaneio_basic');
		$this->load->model('basic/Estabelecimento_basic');
		$this->load->model('basic/Veiculo_basic');
		$this->load->model('basic/Transportadora_basic');
		$this->load->model('basic/Motorista_basic');

		$this->status_romaneio = new StatusRomaneio_basic();
		$this->estabelecimento = new Estabelecimento_basic();
		$this->veiculo = new Veiculo_basic();
		$this->transportadora = new Transportadora_basic();
		$this->motorista = new Motorista_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getStatusRomaneio() { return $this->status_romaneio; }
	public function setStatusRomaneio($status_romaneio) { $this->status_romaneio = $status_romaneio; }

	public function getEstabelecimento() { return $this->estabelecimento; }
	public function setEstabelecimento($estabelecimento) { $this->estabelecimento = $estabelecimento; }

	public function getVeiculo() { return $this->veiculo; }
	public function setVeiculo($veiculo) { $this->veiculo = $veiculo; }

	public function getTransportadora() { return $this->transportadora; }
	public function setTransportadora($transportadora) { $this->transportadora = $transportadora; }

	public function getMotorista() { return $this->motorista; }
	public function setMotorista($motorista) { $this->motorista = $motorista; }

	public function getDataCriacao() { return $this->data_criacao; }
	public function setDataCriacao($data_criacao) { $this->data_criacao = $data_criacao; }

	public function getDataFinalizacao() { return $this->data_finalizacao; }
	public function setDataFinalizacao($data_finalizacao) { $this->data_finalizacao = $data_finalizacao; }

	public function getOfertarViagem() { return $this->ofertar_viagem; }
	public function setOfertarViagem($ofertar_viagem) { $this->ofertar_viagem = $ofertar_viagem; }
}
?>