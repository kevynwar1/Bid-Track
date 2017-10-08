<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoVeiculo_model extends CI_Model {
	public $table = "tipo_veiculo";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoVeiculo_basic');
	}

	public function listar() {
		$this->db->select('
			tipo_veiculo.codigo AS codigo, 
			tipo_veiculo.cod_empresa AS cod_empresa, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso, 
			tipo_veiculo.situacao AS situacao
		')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->order_by($this->table.".descricao", "ASC");
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$tipoveiculos = array();
			foreach($result as $row) {
				$tipoveiculo = new TipoVeiculo_basic();

				$tipoveiculo->setCodigo($row->codigo);
				$tipoveiculo->getEmpresa()->setCodigo($row->cod_empresa);
				$tipoveiculo->setDescricao($row->descricao);
				$tipoveiculo->setPeso($row->peso);
				$tipoveiculo->setSituacao($row->situacao);

				$tipoveiculos[] = $tipoveiculo;
			}

			return $tipoveiculos;
		} else {
			return false;
		}
	}
}