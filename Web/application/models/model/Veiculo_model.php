<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo_model extends CI_Model {
	public $table = "veiculo";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Veiculo_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$veiculos = array();
			foreach($result as $row) {
				$veiculo = new Veiculo_basic();

				$veiculo->setCodigo($row->codigo);
				$veiculo->getEmpresa()->setCodigo($row->cod_empresa);
				$veiculo->getMotorista()->setCodigo($row->cod_motorista);
				$veiculo->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$veiculo->setPlaca($row->placa);
				$veiculo->setChassi($row->chassi);
				$veiculo->setProprio($row->proprio);
				$veiculo->setCapacidade($row->capacidade);
				$veiculo->setAntt($row->antt);
				$veiculo->setSituacao($row->situacao);

				$veiculos[] = $veiculo;
			}

			return $veiculos;
		} else {
			return false;
		}
	}
}