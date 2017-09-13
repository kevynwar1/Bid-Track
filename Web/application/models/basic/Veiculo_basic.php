<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo_basic extends CI_Model {
	public $codigo;
	public $empresa;
	public $motorista;
	public $tipo_veiculo;
	public $modelo;
	public $placa;
	public $chassi;
	public $proprio;
	public $capacidade;
	public $antt;
	public $situacao;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
		$this->load->model('basic/Motorista_basic');
		$this->load->model('basic/TipoVeiculo_basic');

		$this->empresa = new Empresa_basic();
		$this->motorista = new Motorista_basic();
		$this->tipo_veiculo = new TipoVeiculo_basic();
	}

	public function getCodigo() { return $this->codigo; }
	public function setCodigo($codigo) { $this->codigo = $codigo; }

	public function getEmpresa() { return $this->empresa; }
	public function setEmpresa($empresa) { $this->empresa = $empresa; }

	public function getMotorista() { return $this->motorista; }
	public function setMotorista($motorista) { $this->motorista = $motorista; }
	
	public function getTipoVeiculo() { return $this->tipo_veiculo; }
	public function setTipoVeiculo($tipo_veiculo) { $this->tipo_veiculo = $tipo_veiculo; }

	public function getModelo() { return $this->modelo; }
	public function setModelo($modelo) { $this->modelo = $modelo; }

	public function getPlaca() { return $this->placa; }
	public function setPlaca($placa) { $this->placa = $placa; }

	public function getChassi() { return $this->chassi; }
	public function setChassi($chassi) { $this->chassi = $chassi; }

	public function getProprio() { return $this->proprio; }
	public function setProprio($proprio) { $this->proprio = $proprio; }

	public function getCapacidade() { return $this->capacidade; }
	public function setCapacidade($capacidade) { $this->capacidade = $capacidade; }

	public function getAntt() { return $this->antt; }
	public function setAntt($antt) { $this->antt = $antt; }

	public function getSituacao() { return $this->situacao; }
	public function setSituacao($situacao) { $this->situacao = $situacao; }
}
?>