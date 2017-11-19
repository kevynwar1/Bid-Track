<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoVeiculo_model extends CI_Model {
	public $table = "tipo_veiculo";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoVeiculo_basic');
	}

	public function cadastrar($tipo_veiculo) {
		$data = array(
			'cod_empresa' 	=> $tipo_veiculo->getEmpresa()->getCodigo(),
			'descricao'		=> $tipo_veiculo->getDescricao(),
			'peso'			=> $tipo_veiculo->getPeso(),
			'situacao'		=> $tipo_veiculo->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($tipo_veiculo) {
		$this->db->where($this->table.'.codigo', $tipo_veiculo['codigo']);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $tipo_veiculo);

		return $this->db->affected_rows();
	}

	public function excluir($tipo_veiculo) {
		$this->db->where($this->table.'.codigo', $tipo_veiculo->getCodigo());
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function total() {
		$this->db->select('*')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function listar($limit = null, $offset = null) {
		$this->db->select('
			tipo_veiculo.codigo AS codigo, 
			tipo_veiculo.cod_empresa AS cod_empresa, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso, 
			tipo_veiculo.situacao AS situacao
		')->from($this->table);
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
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

	public function consultar($filtro, $procurar) {
		$this->db->select('
			tipo_veiculo.codigo AS codigo, 
			tipo_veiculo.cod_empresa AS cod_empresa, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso, 
			tipo_veiculo.situacao AS situacao
		')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		if($filtro == "codigo") {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == "descricao") {
			$this->db->like($this->table.'.descricao', $procurar);
		}
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